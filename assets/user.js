var userTable = new DataTable("#user-table",{
    ajax:{
        url: "process/user/get-all.php",
        dataSrc: "data",
    },
    processing: true,
    // serverSide: true,
    columns:[
        {data: "id"},
        {data: function(data){
            return data.first_name + " " + data.last_name;
        }},
        {data: "username"},
        {data: function(data){
            return data.is_active ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Inactive</span>";
        }, className: "text-center"},
        {data: "date_created", className: "text-center"},
        {data: function(data){
            return createDataTableButtons({edit: true, delete: true, data: data.id});
        }, className: "text-center"}

    ]
});

$(document).on("submit", "#user-form", function(event) {
    event.preventDefault(); // Prevent the default form submission

    $.ajax({
        url: "process/user/add.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: "json"
    }).done(function(response) {
        if (response.success) {
            Swal.fire({
                title: 'Complete!',
                text: response.message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    userTable.ajax.reload(null, false); // Reload the DataTable
                    $("#user-form")[0].reset(); // Reset the form
                    $("#user-modal").modal("hide"); // Hide the modal
                }
            });
        } else {
            alert("Error: " + response.message);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        alert("Request failed: " + textStatus + ", " + errorThrown);
    });
});