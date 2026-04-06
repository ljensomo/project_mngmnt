let taskId = $("#task-id").val();
let lastNoteId = 0;
let noteLoadCount = 0;

const utilityUrl = "utilities/project-task/";

function loadNotes() {
    $.ajax({
        url: "utilities/task-history/get-all.php",
        method: "GET",
        data: {
            tid: taskId,
            last_id: lastNoteId
        },
        dataType: "json",
    }).done(function(response) {    
        let history = response.data;
        history.forEach(function(entry) {
            let icon, bg = '';
            if (noteLoadCount == 0) {
                lastNoteId = entry.id;
            }

            switch(entry.type) {
                case 1:
                    icon = "fa-comment-dots";
                    color = "success";
                    break;
                case 2:
                    icon = "fa-user-edit";
                    color = "warning";
                    break;
            }
            
            let timelineItem = `<div class="timeline-item">
                        <div class="timeline-icon bg-${color} text-white">
                            <i class="fas ${icon}"></i>
                        </div>
                        <div class="ps-3">
                            <p class="mb-1 fw-bold text-dark">${entry.user} <span class="fw-normal text-muted">${entry.title}</span></p>
                            <div class="p-2 bg-light rounded-3 mb-2 border-start border-${color} border-4" style="font-size: 0.9rem;">
                                <span class="text-secondary">${entry.description}</span>
                            </div>
                            <small class="text-muted"><i class="far fa-clock me-1"></i>${entry.date_created}</small>
                        </div>
                    </div>`;

            $(".timeline-container").prepend(timelineItem);
            noteLoadCount++;
        });
    });
}

// pupulate select options
populateSelect([
    {
        url: "utilities/task-type/get-all.php",
        selectId: ["#task-type"],
        text: "task_type",
        value: "id",
    },
    {
        url: "utilities/task-status/get-all.php",
        selectId: "#status",
        text: "status",
        value: "id",
    },
    {
        url: "utilities/user/get-all.php",
        selectId: ["#assign-to"],
        text: ["first_name", "last_name"],
        value: "id",
    },
]);

// fill up fields with data
$.ajax({
    url: utilityUrl + "get.php",
    method: "GET",
    data: {
        id: taskId
    },
    dataType: "json",
}).done(function(response) {
        // Populate the form fields with the task data
        $("#task").val(response.data.task);
        $("#description").val(response.data.description);
        $("#task-type").val(response.data.task_type);
        $("#status").val(response.data.status);
        $("#assign-to").val(response.data.assigned_to);
});

loadNotes();

createFrmSubmitHandler([
    {
        formId: "#task-form",
        utilityURL: utilityUrl + "update.php",
        modalId: task.modalEditId,
        noReset: true,
        callback: function() {
            loadNotes();
        },
    },
    {
        formId: "#note-form",
        utilityURL: "utilities/task-note/add.php",
        callback: function(){
            loadNotes();
        },
    }
]);