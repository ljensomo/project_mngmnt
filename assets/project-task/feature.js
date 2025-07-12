const feature = {
    modalId: "#feature-modal",
    modalEditId: "#feature-edit-modal",
    formId: "#feature-form",
    formEditId: "#feature-edit-form",
    tableId: "#feature-table",
    utilityUrl: "utilities/project-feature/",
}

let featureTable = initDataTable({
    tableId: feature.tableId,
    ajaxUrl: feature.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id"},
        {data: "module_name"},
        {data: "feature"},
        {data: "description"},
        {data: function(data){
            switch(data.status) {
                case 1:
                    return "Open";
                case 2:
                    return "In Progress";
                case 3:
                    return "Completed";
                case 4:
                    return "On Hold";
            }
        }},
        {data: "date_created", className: "text-center"},
        {data: "date_completed", className: "text-center"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                data: data.id, 
                name: "feature",
            });
        }, className: "text-center"}
    ],
    createdRow: function(row, data, dataIndex) {
        switch(data["status"]) {
            case 1:
                $(row).addClass("table-info");
                break;
            case 2:
                $(row).addClass("table-warning");
                break;
            case 3:
                $(row).addClass("table-success");
                break;
            case 4:
                $(row).addClass("table-secondary");
                break;
        }
    }
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
        $(feature.modalEditId).modal("toggle");
    }
});