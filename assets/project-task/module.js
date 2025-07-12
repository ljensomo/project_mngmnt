const module = {
    modalId: "#module-modal",
    modalEditId: "#module-edit-modal",
    formId: "#module-form",
    formEditId: "#module-edit-form",
    tableId: "#module-table",
    utilityUrl: "utilities/project-module/",
}

let moduleTable = initDataTable({
    tableId: module.tableId,
    ajaxUrl: module.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id"},
        {data: "module"},
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
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                data: data.id, 
                name: "module",
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
        $(module.modalEditId).modal("toggle");
    }
});