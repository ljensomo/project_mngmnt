const feature = {
    modalId: "#feature-modal",
    modalEditId: "#feature-edit-modal",
    formId: "#feature-form",
    formEditId: "#feature-edit-form",
    tableId: "#feature-table",
    utilityUrl: "utilities/project-feature/",
}

populateSelect([
    {
        url: "utilities/feature-status/get-all.php",
        selectId: "#feature-status",
        text: "status",
        value: "id",
    },
]);

let featureTable = initDataTable({
    tableId: feature.tableId,
    ajaxUrl: feature.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id", visible: false},
        
        // 1. Module Parent Anchor Name (td only)
        {
            data: "module_name",
            createdCell: function (td) {
                $(td).addClass('text-secondary small fw-medium');
            }
        },
        
        // 2. Feature Title (td only)
        {
            data: "feature",
            createdCell: function (td) {
                $(td).addClass('fw-bold text-dark-emphasis');
            }
        },
        
        // 3. Description (td only)
        {
            data: "description",
            createdCell: function (td) {
                $(td).addClass('text-secondary small fw-normal');
            }
        },
        
        // 4. Uniform Semantic Status Badges
        {data: function(data){
            const statusStyles = {
                1: { icon: 'fa-clock',          classes: 'bg-secondary-subtle text-secondary border-secondary-subtle' }, // Planned
                2: { icon: 'fa-gears',          classes: 'bg-primary-subtle text-primary border-primary-subtle' },       // In Development
                3: { icon: 'fa-flask',          classes: 'bg-warning-subtle text-warning border-warning-subtle' },       // Testing
                4: { icon: 'fa-circle-check',   classes: 'bg-success-subtle text-success border-success-subtle' },       // Released
                5: { icon: 'fa-ban',            classes: 'bg-danger-subtle text-danger border-danger-subtle' }           // Deprecated
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
        
        // 5. Monospaced Birth Version Token
        {data: "version_number", render: function(data) {
            return data 
                ? `<span class="badge bg-light text-secondary border border-light-subtle rounded-3 font-monospace px-2 py-1 fw-bold" style="font-size: 0.7rem;">v${data}</span>`
                : `<span class="badge bg-light text-muted border border-light-subtle rounded-3 font-monospace px-2 py-1 fw-normal" style="font-size: 0.7rem;">None</span>`;
        }},
        
        // 6. Date Created (td only)
        {
            data: "date_created", 
            className: "text-center no-wrap-column", // Keeps your native configuration classes intact
            createdCell: function (td) {
                $(td).addClass('text-secondary small text-nowrap font-monospace');
            }
        },
        
        // 7. Date Completed
        {data: "date_completed", className: "text-center no-wrap-column", visible: false},
        
        // 8. Actions Group (td only)
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                data: data.id, 
                name: "feature",
            });
        }, className: "text-center"}
    ],
});

createFrmSubmitHandler([
    {
        formId: feature.formId,
        utilityURL: feature.utilityUrl + "add.php",
        dataTable: featureTable,
        modalId: feature.modalId
    },
    {
        formId: feature.formEditId,
        utilityURL: feature.utilityUrl + "update.php",
        dataTable: featureTable,
        modalId: feature.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-feature",
    utilityURL: feature.utilityUrl + "delete.php",
    dataTable: featureTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-feature",
    utilityURL: feature.utilityUrl + "get.php",
    callback: function(data){
        $("#feature-id").val(data.id);
        $("#feature").val(data.feature);
        $("#feature-description").val(data.description);
        $("#feature-status").val(data.status);
        $("#feature-edit-version").val(data.version_id);
        $(feature.modalEditId).modal("toggle");
    }
});