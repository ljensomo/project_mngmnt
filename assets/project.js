const project = {
    modalId: "#project-modal",
    modalEditId: "#project-edit-modal",
    formId: "#project-form",
    formEditId: "#project-edit-form",
    tableId: "#project-table",
    utilityUrl: "utilities/project/",
}

let projectTable = initDataTable({
    tableId: project.tableId,
    ajaxUrl: project.utilityUrl + "get-all.php",
    columns: [
        {data: "id"},
        {data: "project_name"},
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
        {data: "created_by_name", className: "text-center"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true, 
                delete: true, 
                data: data.id, 
                name: "project", 
                view: true, 
                href: "view-project.php?id=" + data.id
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
        $("#status").val(data.status);
        $(project.modalEditId).modal("toggle");
    }
});

createDltRecordHandler({
    btnClass: ".btn-delete-project",
    utilityURL: project.utilityUrl + "delete.php",
    dataTable: projectTable,
});