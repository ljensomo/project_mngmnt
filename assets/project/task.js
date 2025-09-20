const task = {
    modalId: "#task-modal",
    modalEditId: "#task-edit-modal",
    formId: "#task-form",
    formEditId: "#task-edit-form",
    tableId: "#task-table",
    utilityUrl: "utilities/project-task/",
}

let taskTable = initDataTable({
    tableId: task.tableId,
    ajaxUrl: task.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id"},
        {data: function(data) {
            switch(data.task_type) {
                case 1:
                    return "Enhancement";
                case 2:
                    return "Bug";
                default:
                    return "Unknown";
            }
        }},
        {data: "task"},
        {data: "description"},
        {data: function(data){
            return data.assigned_to ? data.first_name+" "+data.last_name : "(Unassigned)";
        }},
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
                deleteIcon: "fa-xmark",
                data: data.id, 
                name: "task",
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
        formId: task.formId,
        utilityURL: task.utilityUrl + "add.php",
        dataTable: taskTable,
        modalId: task.modalId
    },
    {
        formId: task.formEditId,
        utilityURL: task.utilityUrl + "update.php",
        dataTable: taskTable,
        modalId: task.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-task",
    utilityURL: task.utilityUrl + "delete.php",
    dataTable: taskTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-task",
    utilityURL: task.utilityUrl + "get.php",
    callback: function(data){
        $("#task-id").val(data.id);
        $("#task-type").val(data.task_type ? data.task_type : "");
        $("#task").val(data.task);
        $("#description").val(data.description);
        $("#e-task-assign-to").val(data.assigned_to ? data.assigned_to : "");
        $("#status").val(data.status);
        $(task.modalEditId).modal("toggle");
    }
});