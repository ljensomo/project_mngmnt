let projectId = $("#project-id").val()

$("#a-task-project-id, #e-task-project-id").val(projectId);
$("#a-module-project-id, #e-module-project-id").val(projectId);
$("#a-feature-project-id, #e-feature-project-id").val(projectId);
$("#milestone-project-id").val(projectId);

// retrieve project details for task view
$.ajax({
    url: "utilities/project/get.php",
    type: "GET",
    data: {id: projectId},
    dataType: "json",
}).done(function(response){
    let data = response.data;
    if(data){
        $("#project-name").text(data.project_name);
        $("#project-description").text(data.description);
        $("#project-date-created").text(data.date_created);
        let statusText, statusClass;
        switch(data.phase_id){
            case 1:
                statusText = "Planning";
                break;
            case 2:
                statusText = "Design";
                break;
            case 3:
                statusText = "Development";
                break;
            case 4:
                statusText = "Testing";
                break;
            case 5:
                statusText = "Deployment";
                break;
            case 6:
                statusText = "Maintenance";
                break;
            case 7:
                statusText = "Closed";
                break;
        }
        $("#project-status")
            .text(statusText)
            .removeClass("table-info table-warning table-success table-secondary")
            .addClass(statusClass);
        $("#project-created-by").html(getAvatar(data.created_by_name));
    }else{
        Swal.fire('ERROR!', 'Error fetching project details.', 'error');
    }
});
function generateMilestoneTable(){
    let milestonesTable = $("#project-milestones-body");
    milestonesTable.empty(); 

    // Display project milestones in table
    getMilestone(projectId, function(data){
        let milestones = data;
        
        // Safety check if no milestones are returned
        if (!milestones || milestones.length === 0) {
            milestonesTable.html(`
                <tr class="animate-fade-in">
                    <td colspan="2" class="text-center text-muted py-3 small">
                        <i class="fas fa-folder-open me-1"></i> No milestones found for this project.
                    </td>
                </tr>
            `);
            return;
        }

        milestones.forEach(element => {
            const rawDate = element.due_date ? String(element.due_date).trim() : '';

            const isInvalid = !rawDate || 
                    rawDate === 'null' || 
                    rawDate === 'undefined' || 
                    rawDate.startsWith('0000-00-00');

            const dueDateDisplay = isInvalid 
                ? `<span class="badge bg-secondary-subtle text-secondary px-2 py-1 border border-light">
                    <i class="fas fa-ban me-1 small"></i> Not Set
                   </span>`
                : `<span class="text-primary fw-bold">
                    <i class="far fa-calendar-alt me-1"></i> ${rawDate}
                   </span>`;
            
            const isDone = element.is_completed == 1;
            
            const iconClass = element.icon ? element.icon : 'fa-flag';
            const statusIcon = isDone ? 'fa-check-circle text-success' : `${iconClass} text-muted`;
            const textStyle = isDone ? 'text-decoration-line-through text-muted' : '';

            milestonesTable.append(`
                <tr class="hover-highlight ${isDone ? 'bg-light' : ''} animate-fade-in">
                    <td class="small fw-medium py-2 ${textStyle}">
                        <i class="fas ${statusIcon} me-2" style="width: 15px;"></i>
                        ${element.phase}
                    </td>
                    <td class="text-end small">
                        ${isDone 
                            ? '<span class="badge bg-success-subtle text-success border border-success-subtle">Completed</span>' 
                            : dueDateDisplay
                        }
                    </td>
                </tr>
            `);
        });
    });
}

function getMilestone(projectId, callback){
    let milestones = [];
    $.ajax({
    url: "utilities/project-milestones/get-all.php",
    type: "GET",
    data: {pid: projectId},
    dataType: "json"
    }).done(function(response){
        if (typeof callback === "function") {
            callback(response.data);
        }
    }).fail(function(){});
    return milestones;
}

generateMilestoneTable();

populateSelect([
    {
        url: "utilities/user/get-all.php",
        selectId: ["#a-task-assign-to", "#e-task-assign-to"],
        text: ["first_name", "last_name"],
        value: "id",
    },
    {
        url: "utilities/project-module/get-all.php?pid="+projectId,
        selectId: ["#module-options", "#module-edit-options"],
        text: "module",
        value: "id",
    },
    {
        url: "utilities/project-version/get-dev-versions.php?pid="+projectId,
        selectId: ["#module-version", "#module-edit-version", "#feature-version", "#feature-edit-version"],
        text: "version_number",
        value: "id",
    }
]);

// navigation tabs handler
$(document).on("click", ".project-nav-link", function(e){
    e.preventDefault();

    $(".project-nav-link").each(function(i, obj){
        $(this).removeClass("active").removeAttr("aria-current");
        // let tab_name = $(this).find("a").text().toLowerCase().trim() + "-tab";
        let tab_name = $(this).text().toLowerCase().trim() + "-tab";
        $("#"+tab_name).hide();
    });

    $(this).addClass('active').attr("aria-current", "page");

    let tab_name = $(this).text().toLowerCase().trim() + "-tab";
    $("#"+tab_name).show();
    
});

// update milestones button handler
$(document).on("click", "#btn-milestone-update", function(e){
    e.preventDefault();

    getMilestone(projectId, function(data){
        let milestones = data;
        milestones.forEach(element => {
            $("#milestone"+element.phase_id).val(element.due_date);
        });

        $("#milestones-modal").modal("show");
    });
});

// load dashboard data
$.ajax({
    url: "utilities/project/get-dashboard.php?pid="+projectId,
    type: "GET",
    dataType: "json",
    success: function(data) {
        $("#tasks-count").text(data.tasks);
        $("#modules-count").text(data.modules);
        $("#features-count").text(data.features);
    },
    error: function(xhr, status, error) {
        console.error("Error fetching dashboard data:", error);
    }
});

// form handlers
createFrmSubmitHandler([
    {
        formId: "#form-update-milestones",
        utilityURL: "utilities/project-milestones/update.php",
        modalId: "#milestones-modal",
        callback: function(){
            generateMilestoneTable();
        }
    },
]);