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
        // 1. Planning: A crisp, deep slate/blue instead of dark gray
        1: { 
            label: 'Planning', 
            icon: 'fa-clipboard',
            style: 'background-color: #e0f2fe; color: #0369a1; border-color: #bae6fd;' 
        },
        // 2. Design: High-contrast electric cyan
        2: { 
            label: 'Design', 
            icon: 'fa-pen-ruler',
            style: 'background-color: #ecfeff; color: #0891b2; border-color: #cffafe;' 
        },
        // 3. Development: Royal vibrant blue
        3: { 
            label: 'Development', 
            icon: 'fa-code',
            style: 'background-color: #eff6ff; color: #1d4ed8; border-color: #dbeafe;' 
        },
        // 4. Testing: High-visibility sunset orange/amber
        4: { 
            label: 'Testing', 
            icon: 'fa-bug',
            style: 'background-color: #fff7ed; color: #ea580c; border-color: #ffedd5;' 
        },
        // 5. Deployment: Electric neon purple
        5: { 
            label: 'Deployment', 
            icon: 'fa-rocket',
            style: 'background-color: #faf5ff; color: #9333ea; border-color: #f3e8ff;' 
        },
        // 6. Maintenance: Sharp dark indigo steel
        6: { 
            label: 'Maintenance', 
            icon: 'fa-screwdriver-wrench',
            style: 'background-color: #e0e7ff; color: #4338ca; border-color: #c7d2fe;' 
        },
        // 7. Closed: Emerald green pulse
        7: { 
            label: 'Closed', 
            icon: 'fa-check-circle',
            style: 'background-color: #f0fdf4; color: #15803d; border-color: #dcfce7;' 
        }
    };

    // Dynamic, vibrant fallback for safety
    const status = statusMap[phaseId] || { 
        label: 'Unknown', 
        icon: 'fa-question-circle',
        style: 'background-color: #f8fafc; color: #64748b; border-color: #e2e8f0;'
    };

    return `
        <span class="badge border rounded-pill d-inline-flex align-items-center fw-bold px-2.5 py-1" 
              style="font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase; ${status.style}">
            <i class="fas ${status.icon} me-2" style="font-size: 0.72rem; width: 12px; text-align: center; opacity: 0.9;"></i> 
            ${status.label}
        </span>`;
}

let projectTable = initDataTable({
    tableId: project.tableId,
    ajaxUrl: project.utilityUrl + "get-all.php",
    columns: [
        { data: "id", visible: false },
        { data: function(data){
                // Fallback for empty descriptions
                let description = data.description ? data.description : "No description provided.";
                
                // Truncate description at 90 chars so it stays tight and clean
                if (description.length > 90) {
                    description = description.substring(0, 90) + "...";
                }

                // Generate initials for an icon placeholder (e.g., "Expense Logger" -> "EL")
                let project_name = data.project_name ? data.project_name : "Project";
                let initials = project_name
                    .split(' ')
                    .map(word => word.charAt(0))
                    .join('')
                    .toUpperCase()
                    .substring(0, 2);

                // Generate a stable color index based on the name length or hash
                const colors = ['primary', 'indigo', 'purple', 'success', 'info', 'dark'];
                const colorClass = colors[data.length % colors.length];

                return `
                    <div class="d-flex align-items-center py-1">
                        <div class="rounded-3 bg-${colorClass}-subtle text-${colorClass} d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm border border-${colorClass}-subtle" 
                            style="width: 40px; height: 40px; min-width: 40px; font-size: 0.9rem; letter-spacing: 0.5px;">
                            ${initials}
                        </div>
                        
                        <div>
                            <h6 class="fw-bold text-dark mb-0 style="font-size: 0.95rem; line-height: 1.2;">
                                ${project_name}
                            </h6>
                            <span class="text-muted d-block mt-1" style="font-size: 0.82rem; line-height: 1.3; font-weight: 400;">
                                ${description}
                            </span>
                        </div>
                    </div>
                `;
            } 
        },
        { data: "status"},
        { data: "date_created", className: "text-center no-wrap-column" },
        { data: function(data){
            return getAvatar(data.created_by_name);
        }},
        { data: null, className: "text-center no-wrap-column" }  // Actions
    ],
    columnDefs: [
        {
            targets: 2, 
            render: (data, type, row) => getStatusBadge(row.phase_id)
        },
        {
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
                    return getAvatar(data);
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