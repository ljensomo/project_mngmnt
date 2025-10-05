$("#login-form").on("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    $.ajax({
        url: "utilities/login.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: "json",
    }).done(function(response) {
        if(response.success){
            window.location.href = "projects.php";
        }else{
            Swal.fire("LOGIN ERROR!", response.message, "error");
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error: " + textStatus + " - " + errorThrown);
        Swal.fire("ERROR!", "Error while logging in.", "error");
    });
});