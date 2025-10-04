const module = {
    modalId: "#module-modal",
    modalEditId: "#module-edit-modal",
    formId: "#module-form",
    formEditId: "#module-edit-form",
    tableId: "#module-table",
    utilityUrl: "utilities/project-module/",
}

populateSelect([
    {
        url: "utilities/module-status/get-all.php",
        selectId: "#module-status",
        text: "status",
        value: "id",
    },
]);

let moduleTable = initDataTable({
    tableId: module.tableId,
    ajaxUrl: module.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        {data: "id", visible: false},
        {data: "module"},
        {data: "description"},
        {data: function(data){
            let badgeClass = '';
            switch(data.status) {
                case 1:
                    badgeClass = 'bg-secondary'; // Planned
                    break;
                case 2:
                    badgeClass = 'bg-primary'; // Active
                    break;
                case 3:
                    badgeClass = 'bg-success'; // Stable
                    break;
                case 4:
                    badgeClass = 'bg-dark'; // Deprecated
                    break;
            }
            return `<span class="badge ${badgeClass}">${data.status_name}</span>`;
        }},
        {data: "version_number"},
        {data: "date_created", className: "text-center"},
        {data: "date_completed", className: "text-center", visible: false},
        {data: function(data) {
            return createDataTableBtns({
                edit: true,
                delete: true,
                data: data.id, 
                name: "module",
            });
        }, className: "text-center"}
    ],
});

createFrmSubmitHandler([
    {
        formId: module.formId,
        utilityURL: module.utilityUrl + "add.php",
        dataTable: moduleTable,
        modalId: module.modalId
    },
    {
        formId: module.formEditId,
        utilityURL: module.utilityUrl + "update.php",
        dataTable: moduleTable,
        modalId: module.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-module",
    utilityURL: module.utilityUrl + "delete.php",
    dataTable: moduleTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-module",
    utilityURL: module.utilityUrl + "get.php",
    callback: function(data){
        $("#module-id").val(data.id);
        $("#module").val(data.module);
        $("#module-description").val(data.description);
        $("#module-status").val(data.status);
        $("#module-edit-version").val(data.version_id);
        $(module.modalEditId).modal("toggle");
    }
});