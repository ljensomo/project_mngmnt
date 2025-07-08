const task = {
    modalId: "#task-modal",
    modalEditId: "#task-edit-modal",
    formId: "#task-form",
    formEditId: "#task-edit-form",
    tableId: "#task-table",
    utilityUrl: "utilities/project-task/",
    projectId: $("#project-id").val()
}

$("#project-id2, #project-id3").val(task.projectId);

let taskTable = initDataTable({
    tableId: task.tableId,
    ajaxUrl: task.utilityUrl + "get-all.php?pid=" + task.projectId,
    columns: [
        {data: "id"},
        {data: "task"},
        {data: function(data){
            return data.assigned_to ? data.assigned_to : "(Unassigned)";
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
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                deleteIcon: "fa-xmark",
                custom:[
                    {
                        type: "success",
                        icon: "fa-check",
                    }
                ],
                data: data.id, 
                name: "task",
            });
        }, className: "text-center"}
    ]
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
        $("#task-name").val(data.task);
        $("#description").val(data.description);
        $("#assigned-to").val(data.assigned_to ? data.assigned_to : "");
        $("#status").val(data.status);
        $(task.modalEditId).modal("toggle");
    }
});