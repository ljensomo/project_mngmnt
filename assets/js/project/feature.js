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
        {data: "module_name"},
        {data: "feature"},
        {data: "description"},
        {data: function(data){
            let badgeClass = '';
            switch (data.status) {
                case 1:
                    badgeClass = 'bg-secondary'; // Planned
                    break;
                case 2:
                    badgeClass = 'bg-primary'; // In Development
                    break;
                case 3:
                    badgeClass = 'bg-warning text-dark'; // Testing
                    break;
                case 4:
                    badgeClass = 'bg-success'; // Released
                    break;
                case 5:
                    badgeClass = 'bg-dark'; // Deprecated
                    break;
            }
            return `<span class="badge ${badgeClass}">${data.status_name}</span>`;
        }},
        {data: "version_number"},
        {data: "date_created", className: "text-center no-wrap-column"},
        {data: "date_completed", className: "text-center no-wrap-column", visible: false},
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