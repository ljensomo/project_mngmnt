const tech = {
    modalId: "#tech-modal",
    modalEditId: "#tech-edit-modal",
    formId: "#tech-form",
    formEditId: "#tech-edit-form",
    tableId: "#tech-table",
    utilityUrl: "utilities/project-tech/",
}

$("#a-tech-project-id, #e-tech-project-id").val(projectId);

let techTable = initDataTable({
    tableId: tech.tableId,
    ajaxUrl: tech.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id", visible: false},
        {data: "technology"},
        {data: "description"},
        {data: "type"},
        {data: "date_created"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                deleteIcon: "fa-xmark",
                data: data.id, 
                name: "tech",
            });
        }, className: "text-center"}
    ],
});

createFrmSubmitHandler([
    {
        formId: tech.formId,
        utilityURL: tech.utilityUrl + "add.php",
        dataTable: techTable,
        modalId: tech.modalId
    },
    {
        formId: tech.formEditId,
        utilityURL: tech.utilityUrl + "update.php",
        dataTable: techTable,
        modalId: tech.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-tech",
    utilityURL: tech.utilityUrl + "delete.php",
    dataTable: techTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-tech",
    utilityURL: tech.utilityUrl + "get.php",
    callback: function(data){
        $("#tech-id").val(data.id);
        $("#tech-name").val(data.technology);
        $("#tech-description").val(data.description);
        $("#tech-type").val(data.type);
        $(tech.modalEditId).modal("toggle");
    }
});