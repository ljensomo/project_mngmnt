const task = {
    modalId: "#task-modal",
    modalEditId: "#task-edit-modal",
    formId: "#task-form",
    formEditId: "#task-edit-form",
    tableId: "#task-table",
    utilityUrl: "utilities/project-task/",
}

function getTaskTypeBadge(taskType) {
    // Normalize the string just in case of spaces or casing issues
    const type = taskType ? taskType.trim() : "Feature";

    // Configuration map for icons and color themes
    const typeConfig = {
        "Feature":       { icon: "fa-rocket",        bg: "#e3f2fd", text: "#0d47a1", border: "#bbdefb" }, // Blue
        "Bug":           { icon: "fa-bug",           bg: "#ffebee", text: "#c62828", border: "#ffcdd2" }, // Red
        "Improvement":   { icon: "fa-chart-line",    bg: "#e8f5e9", text: "#2e7d32", border: "#c8e6c9" }, // Green
        "Research":      { icon: "fa-search",        bg: "#f3e5f5", text: "#6a1b9a", border: "#e1bee7" }, // Purple
        "Documentation": { icon: "fa-book",          bg: "#efebe9", text: "#4e342e", border: "#d7ccc8" }, // Brown
        "Designing":     { icon: "fa-palette",       bg: "#fce4ec", text: "#c2185b", border: "#f8bbd0" }, // Pink
        "Testing":       { icon: "fa-flask",         bg: "#e0f7fa", text: "#00838f", border: "#b2ebf2" }, // Cyan
        "Deployment":    { icon: "fa-cloud-upload-alt", bg: "#e8eaf6", text: "#283593", border: "#c5cae9" }, // Indigo
        "Meeting":       { icon: "fa-users",         bg: "#fff3e0", text: "#ef6c00", border: "#ffe0b2" }, // Orange
        "Review":        { icon: "fa-clipboard-check", bg: "#f1f8e9", text: "#558b2f", border: "#dcedc8" }, // Light Green
        "Training":      { icon: "fa-graduation-cap", bg: "#faf1e6", text: "#8d6e63", border: "#f5e6d3" }, // Sepia
        "Maintenance":   { icon: "fa-tools",         bg: "#eceff1", text: "#37474f", border: "#cfd8dc" }, // Blue Gray
        "Support":       { icon: "fa-headset",       bg: "#fffde7", text: "#f57f17", border: "#fff9c4" }, // Yellow
        "Approval":      { icon: "fa-check-circle",  bg: "#e0f2f1", text: "#00695c", border: "#b2dfdb" }  // Teal
    };

    // Fallback if the type doesn't match anything in your DB list
    const config = typeConfig[type] || { icon: "fa-tasks", bg: "#f8f9fa", text: "#212529", border: "#dee2e6" };

    return `
        <span class="badge d-inline-flex align-items-center px-2 py-1 fw-semibold rounded-pill" 
              style="background-color: ${config.bg}; color: ${config.text}; border: 1px solid ${config.border}; font-size: 0.78rem; letter-spacing: 0.3px;">
            <i class="fas ${config.icon} me-1" style="font-size: 0.85em; opacity: 0.85;"></i>
            ${type}
        </span>`;
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
    ajaxUrl: task.utilityUrl + "get-open-tasks.php?pid=" + projectId,
    columns: [
        {data: "id"},
        {data: function(data){
            return getTaskTypeBadge(data.task_type_name);
        }},
        {data: function(data){
            let description = data.description ? data.description : "No description provided.";
        
            if (description.length > 75) {
                description = description.substring(0, 75) + "...";
            }

            return `
                <div>
                    <span class="fw-semibold text-dark d-block mb-0" style="font-size: 0.95rem;">
                        ${data.task}
                    </span>
                    <small class="text-muted d-block opacity-75" style="font-size: 0.8rem; line-height: 1.3;">
                        ${description}
                    </small>
                </div>
            `;
        }},
        {data: function(data){
            return data.assigned_to ? getAvatar(data.first_name+" "+data.last_name): getAvatar("Unassigned");
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
            return `<span class='badge ${badgeClass}'> ${data.status_name}</span>`;
        }},
        {data: "date_created", className: "text-center no-wrap-column"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                deleteIcon: "fa-xmark",
                data: data.id, 
                name: "task",
                view: true,
                href: "task-view.php?tid="+data.id
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

function getIcon(taskType) {
    switch (taskType) {
        case 'Bug':
            return 'fa-bug';
        case 'Feature':
            return 'fa-star';
        case 'Improvement':
            return 'fa-layer-group';
        case 'Research':
            return 'fa-magnifying-glass';
        case 'Documentation':
            return 'fa-file-lines';
        case 'Designing':
            return 'fa-pencil-ruler';
        case 'Testing':
            return 'fa-vial';
        case 'Deployment':
            return 'fa-rocket';
        case 'Meeting':
            return 'fa-handshake';
        case 'Review':
            return 'fa-check-double';
        case 'Training':
            return 'fa-graduation-cap';
        case 'Maintenance':
            return 'fa-tools';
        case 'Support':
            return 'fa-headset';
        case 'Approval':
            return 'fa-thumbs-up';
    }
}