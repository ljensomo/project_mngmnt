const version = {
    modalId: "#version-modal",
    modalEditId: "#version-edit-modal",
    formId: "#version-form",
    formEditId: "#version-edit-form",
    tableId: "#version-table",
    utilityUrl: "utilities/project-version/",
}

$("#a-version-project-id, #e-version-project-id").val(projectId);

let versionTable = initDataTable({
    tableId: version.tableId,
    ajaxUrl: version.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id", visible: false},
        {data: "version_number"},
        {data: "remarks"},
        {data: function(data){
            switch(data.status) {
                case 1:
                    return "Development";
                case 2:
                    return "Published";
                case 3:
                    return "Active";
                case 4:
                    return "Archived";
                case 5:
                    return "Withdrawn";
                default:
                    return "Unknown";
            }
        }},
        {data: "target_date_release"},
        {data: "date_released"},
        {data: "date_created"},
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                deleteIcon: "fa-xmark",
                data: data.id, 
                name: "version",
            });
        }, className: "text-center"}
    ],
});

createFrmSubmitHandler([
    {
        formId: version.formId,
        utilityURL: version.utilityUrl + "add.php",
        dataTable: versionTable,
        modalId: version.modalId
    },
    {
        formId: version.formEditId,
        utilityURL: version.utilityUrl + "update.php",
        dataTable: versionTable,
        modalId: version.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-version",
    utilityURL: version.utilityUrl + "delete.php",
    dataTable: versionTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-version",
    utilityURL: version.utilityUrl + "get.php",
    callback: function(data){
        $("#version-id").val(data.id);
        $("#version-number").val(data.version_number);
        $("#version-remarks").val(data.remarks);
        $("#version-status").val(data.status);
        $("#version-target-date-release").val(data.target_date_release);
        $("#version-release-date").val(data.date_released);
        $(version.modalEditId).modal("toggle");
    }
});