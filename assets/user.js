const userUtility = "utilities/user/";
const element = {
    modalId: "#user-modal",
    modalEditId: "#user-edit-modal",
    formId: "#user-form",
    tableId: "#user-table"
}

let userTable = initDataTable({
    tableId: element.tableId,
    ajaxUrl: userUtility + "get-all.php",
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
    utilityURL: userUtility + "get.php",
    callback: function(data) {
        $("#user-id").val(data.id);
        $("#first-name").val(data.first_name);
        $("#last-name").val(data.last_name);
        $(element.modalEditId).modal("toggle");
    }
});

createDltRecordHandler({
    btnClass: ".btn-delete-user",
    utilityURL: userUtility + "delete.php",
    dataTable: userTable,
});

createFrmSubmitHandler([
    {
        formId: element.formId,
        utilityURL: userUtility + "add.php",
        dataTable: userTable,
        modalId: element.modalId
    },
    {
        formId: "#user-edit-form",
        utilityURL: userUtility + "update.php",
        dataTable: userTable,
        modalId: element.modalEditId
    }
 ]);