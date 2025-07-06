const user = {
    modalId: "#user-modal",
    modalEditId: "#user-edit-modal",
    formId: "#user-form",
    tableId: "#user-table",
    utilityURL: "utilities/user/",
}

let userTable = initDataTable({
    tableId: user.tableId,
    ajaxUrl: user.utilityURL + "get-all.php",
    columns: [
        {data: "id"},
        {data: function(data) {
            return data.first_name + " " + data.last_name;
        }},
        {data: "username"},
        {data: function(data) {
            return data.is_active ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Inactive</span>";
        }, className: "text-center"},
        {data: "date_created", className: "text-center"},
        {data: function(data) {
            return createDataTableBtns({edit: true, delete: true, data: data.id});
        }, className: "text-center"}
    ]
});

createEdtRecordHandler({
    btnClass: ".btn-edit-user",
    utilityURL: user.utilityUrl + "get.php",
    callback: function(data) {
        $("#user-id").val(data.id);
        $("#first-name").val(data.first_name);
        $("#last-name").val(data.last_name);
        $(user.modalEditId).modal("toggle");
    }
});

createDltRecordHandler({
    btnClass: ".btn-delete-user",
    utilityURL: user.utilityUrl + "delete.php",
    dataTable: userTable,
});

createFrmSubmitHandler([
    {
        formId: user.formId,
        utilityURL: user.utilityUrl + "add.php",
        dataTable: userTable,
        modalId: user.modalId
    },
    {
        formId: "#user-edit-form",
        utilityURL: user.utilityUrl + "update.php",
        dataTable: userTable,
        modalId: user.modalEditId
    }
 ]);