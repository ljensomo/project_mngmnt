const project = {
    modalId: "#project-modal",
    modalEditId: "#project-edit-modal",
    formId: "#project-form",
    formEditId: "#project-edit-form",
    tableId: "#project-table",
    utilityUrl: "utilities/project/",
}

function getStatusBadge(phaseId) {
    const statusMap = {
        1: { label: 'Planning', class: 'bg-secondary', icon: 'fa-clipboard' },
        2: { label: 'Design', class: 'bg-info text-dark', icon: 'fa-pen-ruler' },
        3: { label: 'Development', class: 'bg-primary', icon: 'fa-code' },
        4: { label: 'Testing', class: 'bg-warning text-dark', icon: 'fa-bug' },
        5: { label: 'Deployment', class: 'bg-purple', icon: 'fa-rocket' },
        6: { label: 'Maintenance', class: 'bg-dark', icon: 'fa-screwdriver-wrench' },
        7: { label: 'Closed', class: 'bg-success', icon: 'fa-check-circle' }
    };

    const status = statusMap[phaseId] || { label: 'Unknown', class: 'bg-light text-dark', icon: 'fa-question' };
    
    return `<span class="badge ${status.class} rounded-pill px-2 py-1 small fw-bold">
                <i class="fas ${status.icon} me-1"></i> ${status.label}
            </span>`;
}

let projectTable = initDataTable({
    tableId: project.tableId,
    ajaxUrl: project.utilityUrl + "get-all.php",
    columns: [
        { data: "id", visible: false },
        { data: "project_name", className: "fw-semibold text-dark no-wrap-column" },
        { data: "description", className: "text-muted small" }, // Removed render here
        { data: "phase_id", className: "no-wrap-column" },      // Use raw ID here
        { data: "date_created", className: "text-center no-wrap-column" },
        { data: "created_by_name", className: "text-center" },
        { data: null, className: "text-center no-wrap-column" }  // Actions
    ],
    columnDefs: [
        {
            // 1. Status Badge Rendering
            targets: 3, 
            render: (data, type, row) => getStatusBadge(row.phase_id)
        },
        {
            // 2. Description Truncation
            targets: 2,
            render: (data) => `<div class="text-truncate" style="max-width: 250px;">${data}</div>`
        },
        {
            // 3. Actions Button Rendering
            targets: -1, 
            render: (data, type, row) => createDataTableBtns({
                edit: true, 
                delete: true, 
                view: true, 
                data: `${row.id}`, // Pass as attribute string
                name: "project", 
                href: "view-project.php?id=" + row.id
            })
        },
        {
            targets: 5, // The "Created By" column index
            render: function(data, type, row) {
                    const initials = data.split(' ').map(n => n[0]).join(''); // Get "LJ" from "LJ Ensomon"
                    return `
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center me-2" 
                                style="width: 28px; height: 28px; font-size: 0.75rem; font-weight: bold; border: 1px solid #dee2e6;">
                                ${initials}
                            </div>
                            <span class="fw-medium">${data}</span>
                        </div>`;
                }
        }
    ]
});

createFrmSubmitHandler([
    {
        formId: project.formId,
        utilityURL: project.utilityUrl + "add.php",
        dataTable: projectTable,
        modalId: project.modalId
    },
    {
        formId: project.formEditId,
        utilityURL: project.utilityUrl + "update.php",
        dataTable: projectTable,
        modalId: project.modalEditId
    }
]);

createEdtRecordHandler({
    btnClass: ".btn-edit-project",
    utilityURL: project.utilityUrl + "get.php",
    callback: function(data) {
        $("#project-id").val(data.id);
        $("#project-name").val(data.project_name);
        $("#description").val(data.description);
        $("#phase").val(data.phase_id);
        $(project.modalEditId).modal("toggle");
    }
});

createDltRecordHandler({
    btnClass: ".btn-delete-project",
    utilityURL: project.utilityUrl + "delete.php",
    dataTable: projectTable,
});