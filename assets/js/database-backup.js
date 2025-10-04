const dbBackup = {
    tableId: "#db-backup-table",
    utilityUrl: "utilities/database-backup/",
}

let dbBackupTable = initDataTable({
    tableId: dbBackup.tableId,
    ajaxUrl: dbBackup.utilityUrl + "get-all.php",
    columns: [
        {data: "id", visible: false},
        {data: "file_name", className: "no-wrap-column"},
        {data: "file_size", className: "no-wrap-column"},
        {data: "date_created", className: "text-center no-wrap-column"},
        {data: function(data) {
            return createDataTableBtns({
                custom: [
                    {type: 'primary', icon: 'fa-download', id: 'btn-download', anchor: true, href: data.file_path}
                ],
                data: data.id, 
                name: "db-backup", 
            });
        }, className: "text-center no-wrap-column"}
    ],
});

$("#btn-generate-backup").on("click", function() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Generate a new database backup?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, generate it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "utilities/database-backup/generate.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire('GENERATED!', response.message, 'success');
                        dbBackupTable.ajax.reload();
                    } else {
                        Swal.fire('ERROR!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('ERROR!', 'An error occurred while generating the backup.', 'error');
                }
            });
        }
    });
});