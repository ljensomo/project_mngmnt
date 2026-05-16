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
            if (noteLoadCount == 0) {
                lastNoteId = entry.id;
            }
            
            // Determine icons and theme colors based on title
            let iconClass = "fa-edit"; 
            let themeColor = "primary"; 

            const titleLower = entry.title.toLowerCase();

            if (titleLower.includes("note") || titleLower.includes("comment")) {
                iconClass = "fa-comment-alt";
                themeColor = "success"; 
            } else if (titleLower.includes("assigned")) {
                iconClass = "fa-user-tag";
                themeColor = "info"; 
            } else if (titleLower.includes("status")) {
                iconClass = "fa-tasks";
                themeColor = "warning"; 
            }

            const isComment = titleLower.includes("note") || titleLower.includes("comment");

            // Unified Box Layout Container
            let timelineItem = `
                <div class="timeline-item position-relative" style="padding-bottom: 12px;">
                    <div class="timeline-line position-absolute h-100 border-start border-2 border-light-subtle" style="left: 11px; top: 24px; z-index: 0;"></div>
                    
                    <div class="d-flex align-items-start position-relative" style="z-index: 1;">
                        
                        <div class="timeline-icon flex-shrink-0 d-flex align-items-center justify-content-center bg-${themeColor}-subtle text-${themeColor} rounded-circle border border-${themeColor}-subtle" 
                            style="width: 24px; height: 24px; font-size: 0.7rem; margin-top: 1px;">
                            <i class="fas ${iconClass}"></i>
                        </div>

                        <div class="timeline-content flex-grow-1" style="padding-left: 10px; min-width: 0;">
                            
                            <div class="p-2 bg-light border border-light-subtle rounded-3 shadow-sm border-start ${isComment ? 'border-' + themeColor : 'border-secondary-subtle'} border-3" 
                                style="padding-left: 10px !important;">
                                
                                <div class="d-flex align-items-center flex-wrap justify-content-between mb-1">
                                    <span class="text-dark" style="font-size: 0.85rem; line-height: 1.2;">
                                        <strong class="fw-bold text-dark">${entry.user}</strong> 
                                        <span class="text-secondary ms-1">${entry.title}</span>
                                    </span>
                                    <small class="text-muted flex-shrink-0 ms-2" style="font-size: 0.7rem; opacity: 0.75; white-space: nowrap;">
                                        <i class="far fa-clock me-1"></i>${entry.date_created}
                                    </small>
                                </div>
                                
                                <div class="${isComment ? 'text-dark' : 'text-muted'}" 
                                    style="font-size: 0.84rem; line-height: 1.35; word-wrap: break-word;">
                                    ${entry.description}
                                </div>

                            </div>

                        </div>
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