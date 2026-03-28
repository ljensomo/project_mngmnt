let taskId = $("#task-id").val();
let lastNoteId = 0;

const utilityUrl = "utilities/project-task/";

function loadNotes() {
    alert(lastNoteId)
    $.ajax({
        url: "utilities/task-history/get-all.php",
        method: "GET",
        data: {
            tid: taskId
        },
        dataType: "json",
    }).done(function(response) {    
        let history = response.data;
        let loopCount = 0;
        history.forEach(function(entry) {
            if (loopCount == 0) {
                lastNoteId = entry.id;
            }

            let record = `<div class="border-start border-4 border-success ms-3 ps-4 mb-4 position-relative">
                                <div class="position-absolute translate-middle-x" style="left: -12px; top: 0;">
                                    <i class="fas fa-note-sticky text-success bg-white px-1"></i>
                                </div>
                                <p class="mb-0 fw-bold">${entry.user}: <span class="fw-normal">${entry.title}</span></p>
                                <p class="text-secondary mb-1" style="font-size: 0.95rem;">
                                    "${entry.description}"
                                </p>
                                <small class="text-muted"><i class="far fa-clock me-1"></i>${entry.date_created}</small>
                            </div>`;

            $("#history-div").append(record);
            loopCount++;
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
});

loadNotes();

createFrmSubmitHandler([
    {
        formId: "#task-form",
        utilityURL: utilityUrl + "update.php",
        modalId: task.modalEditId,
        noReset: true,
    },
    {
        formId: "#note-form",
        utilityURL: "utilities/task-note/add.php",
        callback: loadNotes,
    }
]);