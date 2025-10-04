const project = {
    modalId: "#project-modal",
    modalEditId: "#project-edit-modal",
    formId: "#project-form",
    formEditId: "#project-edit-form",
    tableId: "#project-table",
    utilityUrl: "utilities/project/",
}

let projectTable = initDataTable({
    tableId: project.tableId,
    ajaxUrl: project.utilityUrl + "get-all.php",
    columns: [
        {data: "id", visible: false},
        {data: "project_name", className: "no-wrap-column"},
        {data: "description"},
        {data: "phase", className: "no-wrap-column"},
        {data: "date_created", className: "text-center no-wrap-column"},
        {data: "created_by_name", className: "text-center"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true, 
                delete: true, 
                data: data.id, 
                name: "project", 
                view: true, 
                href: "view-project.php?id=" + data.id
            });
        }, className: "text-center no-wrap-column"}
    ],
});

createFrmSubmitHandler([
    {
        formId: project.formId,
        utilityURL: project.utilityUrl + "add.php",
        dataTable: projectTable,
        modalId: project.modalId
    },
    {
        formId: project.formEditId,
        utilityURL: project.utilityUrl + "update.php",
        dataTable: projectTable,
        modalId: project.modalEditId
    }
]);

createEdtRecordHandler({
    btnClass: ".btn-edit-project",
    utilityURL: project.utilityUrl + "get.php",
    callback: function(data) {
        $("#project-id").val(data.id);
        $("#project-name").val(data.project_name);
        $("#description").val(data.description);
        $("#phase").val(data.phase_id);
        $(project.modalEditId).modal("toggle");
    }
});

createDltRecordHandler({
    btnClass: ".btn-delete-project",
    utilityURL: project.utilityUrl + "delete.php",
    dataTable: projectTable,
});