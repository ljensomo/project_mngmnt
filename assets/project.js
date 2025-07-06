const project = {
    modalId: "#project-modal",
    modalEditId: "#project-edit-modal",
    formId: "#project-form",
    tableId: "#project-table",
    utilityUrl: "utilities/project/",
}

let projectTable = initDataTable({
    tableId: project.tableId,
    ajaxUrl: project.utilityUrl + "get-all.php",
    columns: [
        {data: "id"},
        {data: "project_name"},
        {data: "description"},
        {data: "status"},
        {data: "date_created", className: "text-center"},
        {data: "created_by", className: "text-center"},
        {data: function(data) {
            return createDataTableBtns({edit: true, delete: true, data: data.id});
        }, className: "text-center"}
    ]
});

createFrmSubmitHandler({
    formId: project.formId,
    utilityURL: project.utilityUrl + "add.php",
    dataTable: projectTable,
    modalId: project.modalId
});