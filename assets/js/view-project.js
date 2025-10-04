let projectId = $("#project-id").val()

$("#a-task-project-id, #e-task-project-id").val(projectId);
$("#a-module-project-id, #e-module-project-id").val(projectId);
$("#a-feature-project-id, #e-feature-project-id").val(projectId);

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
        $("#project-created-by").text(data.created_by_name);
    }else{
        Swal.fire('ERROR!', 'Error fetching project details.', 'error');
    }
});

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
        url: "utilities/project-version/get-all.php?pid="+projectId,
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
        let tab_name = $(this).html().toLowerCase()+"-tab";
        $("#"+tab_name).hide();
    });

    $(this).addClass('active').attr("aria-current", "page");

    let tab_name = $(this).html().toLowerCase()+"-tab";
    $("#"+tab_name).show();
    
});

// load dashboard data
// $.ajax({
//     url: "utilities/project/get-dashboard.php?pid="+projectId,
//     type: "GET",
//     dataType: "json",
//     success: function(data) {
//         $("#task-1").text(data.tasks.open);
//         $("#module-1").text(data.modules.open);
//         $("#feature-1").text(data.features.open);

//         $("#task-2").text(data.tasks.in_progress);
//         $("#module-2").text(data.modules.in_progress);
//         $("#feature-2").text(data.features.in_progress);

//         $("#task-3").text(data.tasks.completed);
//         $("#module-3").text(data.modules.completed);
//         $("#feature-3").text(data.features.completed);

//         $("#task-4").text(data.tasks.on_hold);
//         $("#module-4").text(data.modules.on_hold);
//         $("#feature-4").text(data.features.on_hold);
//     },
//     error: function(xhr, status, error) {
//         console.error("Error fetching dashboard data:", error);
//     }
// });