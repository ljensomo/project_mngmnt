const project = {
    modalId: "#project-status-modal",
    modalEditId: "#project-status-edit-modal",
    formId: "#project-status-form",
    formEditId: "#project-status-edit-form",
    tableId: "#project-status-table",
    utilityUrl: "utilities/project-status/",
}

let projectTable = initDataTable({
    tableId: project.tableId,
    ajaxUrl: project.utilityUrl + "get-all.php",
    columns: [
        {data: "id", visible: false},
        {data: "phase", className: "no-wrap-column"},
        {data: "description"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true, 
                delete: true, 
                data: data.id, 
                name: "project-status", 
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
    btnClass: ".btn-edit-project-status",
    utilityURL: project.utilityUrl + "get.php",
    callback: function(data) {
        $("#project-status-id").val(data.id);
        $("#project-phase").val(data.phase);
        $("#description").val(data.description);
        $(project.modalEditId).modal("toggle");
    }
});

createDltRecordHandler({
    btnClass: ".btn-delete-project-status",
    utilityURL: project.utilityUrl + "delete.php",
    dataTable: projectTable,
});