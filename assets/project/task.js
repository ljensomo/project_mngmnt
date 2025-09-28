const task = {
    modalId: "#task-modal",
    modalEditId: "#task-edit-modal",
    formId: "#task-form",
    formEditId: "#task-edit-form",
    tableId: "#task-table",
    utilityUrl: "utilities/project-task/",
}

populateSelect([
    {
        url: "utilities/task-type/get-all.php",
        selectId: ["#task-type-1", "#task-type-2"],
        text: "task_type",
        value: "id",
    },
    {
        url: "utilities/task-status/get-all.php",
        selectId: "#status",
        text: "status",
        value: "id",
    },
]);

let taskTable = initDataTable({
    tableId: task.tableId,
    ajaxUrl: task.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id"},
        {data: "task_type_name"},
        {data: "task"},
        {data: "description", visible: false},
        {data: function(data){
            return data.assigned_to ? data.first_name+" "+data.last_name : "(Unassigned)";
        }},
        {data: function(data){
           let badgeClass = '';
            switch (data.status) {
                case 1:
                    badgeClass = 'bg-secondary'; // Backlog
                    break;
                case 2:
                    badgeClass = 'bg-primary'; // To Do
                    break;
                case 3:
                    badgeClass = 'bg-warning text-dark'; // In Progress
                    break;
                case 4:
                    badgeClass = 'bg-info text-dark'; // In Review
                    break;
                case 5:
                    badgeClass = 'bg-danger'; // Blocked
                    break;
                case 7:
                    badgeClass = 'bg-success'; // Completed
                    break;
                default:
                    badgeClass = 'bg-light text-dark'; // Fallback
            }
            return `<span class='badge ${badgeClass}'>${data.status_name}</span>`;
        }},
        {data: "date_created", className: "text-center no-wrap-column"},
        {data: "date_completed", className: "text-center no-wrap-column"},
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
        $("#task-type-2").val(data.task_type ? data.task_type : "");
        $("#task").val(data.task);
        $("#description").val(data.description);
        $("#e-task-assign-to").val(data.assigned_to ? data.assigned_to : "");
        $("#status").val(data.status);
        $(task.modalEditId).modal("toggle");
    }
});