const module = {
    modalId: "#module-modal",
    modalEditId: "#module-edit-modal",
    formId: "#module-form",
    formEditId: "#module-edit-form",
    tableId: "#module-table",
    utilityUrl: "utilities/project-module/",
}

populateSelect([
    {
        url: "utilities/module-status/get-all.php",
        selectId: "#module-status",
        text: "status",
        value: "id",
    },
]);

let moduleTable = initDataTable({
    tableId: module.tableId,
    ajaxUrl: module.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id", visible: false},
        
        // 1. Module Title (td only)
        {
            data: "module",
            createdCell: function (td) {
                $(td).addClass('fw-bold text-dark-emphasis');
            }
        },
        
        // 2. Description (td only)
        {
            data: "description",
            createdCell: function (td) {
                $(td).addClass('text-secondary small fw-normal');
            }
        },
        
        {data: function(data){
            const statusStyles = {
                1: { icon: 'fa-clock',          classes: 'bg-secondary-subtle text-secondary border-secondary-subtle' }, // Planned
                2: { icon: 'fa-gears',          classes: 'bg-primary-subtle text-primary border-primary-subtle' },       // Active
                3: { icon: 'fa-circle-check',   classes: 'bg-success-subtle text-success border-success-subtle' },       // Stable
                4: { icon: 'fa-ban',            classes: 'bg-danger-subtle text-danger border-danger-subtle' }           // Deprecated
            };

            const currentStatus = statusStyles[data.status] || { 
                icon: 'fa-circle-question', 
                classes: 'bg-light text-muted border-light-subtle' 
            };

            return `
                <span class="badge border rounded-3 d-inline-flex align-items-center fw-bold px-2 py-1 text-uppercase font-monospace" 
                      style="letter-spacing: 0.5px; font-size: 0.7rem;">
                    <i class="fa-solid ${currentStatus.icon} me-2" style="width: 12px; text-align: center;"></i> 
                    ${data.status_name}
                </span>`.replace('class="badge border', `class="badge border ${currentStatus.classes}`);
        }},
        
        {data: "version_number", render: function(data) {
            return data 
                ? `<span class="badge bg-light text-secondary border border-light-subtle rounded-3 font-monospace px-2 py-1 fw-bold" style="font-size: 0.7rem;">v${data}</span>`
                : `<span class="badge bg-light text-muted border border-light-subtle rounded-3 font-monospace px-2 py-1 fw-normal" style="font-size: 0.7rem;">None</span>`;
        }},
        
        // 3. Date Created (td only)
        {
            data: "date_created", 
            className: "text-center", // Keeps your original header alignment intact
            createdCell: function (td) {
                $(td).addClass('text-secondary small text-nowrap font-monospace');
            }
        },
        
        {data: "date_completed", className: "text-center", visible: false},
        
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                data: data.id, 
                name: "module",
            });
        }, className: "text-center"}
    ],
});

createFrmSubmitHandler([
    {
        formId: module.formId,
        utilityURL: module.utilityUrl + "add.php",
        dataTable: moduleTable,
        modalId: module.modalId
    },
    {
        formId: module.formEditId,
        utilityURL: module.utilityUrl + "update.php",
        dataTable: moduleTable,
        modalId: module.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-module",
    utilityURL: module.utilityUrl + "delete.php",
    dataTable: moduleTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-module",
    utilityURL: module.utilityUrl + "get.php",
    callback: function(data){
        $("#module-id").val(data.id);
        $("#module").val(data.module);
        $("#module-description").val(data.description);
        $("#module-status").val(data.status);
        $("#module-edit-version").val(data.version_id);
        $(module.modalEditId).modal("toggle");
    }
});