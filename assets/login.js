if(!jQuery){
    alert("jQuery is not loaded!");
}

$(document).on("submit", "#login-form", function(event) {
    event.preventDefault(); // Prevent the default form submission

    alert("I am triggered")
});