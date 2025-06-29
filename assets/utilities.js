function createButton(parameters = null){
    let button = $("<button>");

    let type = parameters && parameters.type ? parameters.type : "primary";
    button.addClass("btn btn-sm btn-"+type);

    if(parameters && parameters.text) {
        button.text(parameters.text);
    }

    if(parameters && parameters.icon) {
        let icon = $("<i>");
        icon.addClass("fas "+parameters.icon);
        button.html(icon);
    }

    return button[0].outerHTML;
}

function createDataTableButtons(parameters = null){
    let buttons;
    if(parameters && parameters.edit){
        
        buttons += createButton({
            type: "warning",
            icon: "fa-user-pen",
            id: "edit-user",
            data: parameters.data
        });
    }

    if(parameters && parameters.delete){
        
        buttons += " "; // Add space between buttons
        buttons += createButton({
            type: "danger",
            icon: "fa-trash",
            id: "delete-user",
            data: parameters.data
        });
    }

    return buttons;
}