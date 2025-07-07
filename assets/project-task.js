const task = {
    modalId: "#task-modal",
    modalEditId: "#task-modal-edit",
    formId: "#task-form",
    formEditId: "#task-form-edit",
    tableId: "#task-table",
    utilityUrl: "utilities/project-task/",
    projectId: $("#project-id").val()
}

let taskTable = initDataTable({
    tableId: task.tableId,
    ajaxUrl: task.utilityUrl + "get-all.php?pid=" + task.projectId,
    columns: [
        {data: "id"},
        {data: "task_name"},
        {data: "assigned_to"},
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
                name: "task", 
                view: true, 
                href: "view-task.php?id=" + data.id
            });
        }, className: "text-center"}
    ]
});