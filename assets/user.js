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
            alert("User data submitted successfully!");
        } else {
            alert("Error: " + response.message);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        alert("Request failed: " + textStatus + ", " + errorThrown);
    });
});