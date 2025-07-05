// Function to create a button with specified parameters
function createButton(parameter){
    let button = $("<button>");

    let type = parameter && parameter.type ? parameter.type : "primary";
    button.addClass("btn btn-sm btn-"+type);
    button.addClass("btn-"+parameter.id);

    if(parameter.text) {
        button.text(parameter.text);
    }

    if(parameter.icon) {
        let icon = $("<i>");
        icon.addClass("fas "+parameter.icon);
        button.html(icon);
    }

    if(parameter.data) {
        button.attr("row-data", parameter.data);
    }

    return button[0].outerHTML;
}

// Function to initialize DataTable
// Parameters should include tableId, ajaxUrl, and columns
function initDataTable(parameter){
    let table = new DataTable(parameter.tableId,{
        ajax: {
            url: parameter.ajaxUrl,
            dataSrc: "data",
        },
        processing: true,
        columns: parameter.columns
    });

    return table;
}

function reloadDataTable(table){
    table.ajax.reload(null, false); // Reload the DataTable without resetting pagination
}

// Function to create buttons for DataTable actions
function createDataTableBtns(parameter){
    let buttons = "";

    if(parameter.edit){
        
        buttons += createButton({
            type: "warning",
            icon: "fa-user-pen",
            id: "edit-user",
            data: parameter.data
        });
    }

    if(parameter.delete){
        
        buttons += " "; // Add space between buttons
        buttons += createButton({
            type: "danger",
            icon: "fa-trash",
            id: "delete-user",
            data: parameter.data
        });
    }

    return buttons;
}

// Function to create a form submission handler
// Parameters should include formId, utilityURL, dataTable, and modalId
function createFrmSubmitHandler(parameter){

    if(Array.isArray(parameter)){
        parameter.forEach(function(param, index) {
            frmSubmitHandler(param);
        });
    }else{
        frmSubmitHandler(parameter);
    }
}

function frmSubmitHandler(parameter){
    $(document).on("submit", parameter.formId, function(event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: parameter.utilityURL,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: "json"
        }).done(function(response) {
            if (response.success) {
                Swal.fire({
                    title: 'COMPLETE!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        reloadDataTable(parameter.dataTable);
                        $(parameter.formId)[0].reset();
                        $(parameter.modalId).modal("hide");
                    }
                });
            } else {
                Swal.fire("ERROR!", "Error encountered processing data.", "error");
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Form Submit Error:", textStatus, errorThrown);
            Swal.fire("ERROR!", "Failed to submit form.", "error");
        });
    });
}

// Function to create a delete record handler
function createDltRecordHandler(parameter){
    $(document).on("click", parameter.btnClass, function() {
        let userId = $(this).attr("row-data");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: parameter.utilityURL,
                    method: "POST",
                    data: {id: userId},
                    dataType: "json",
                }).done(function(response){
                    if (response.success) {
                        Swal.fire('DELETED!', response.message, 'success');
                        reloadDataTable(parameter.dataTable);
                    } else {
                        Swal.fire('ERROR!', response.message, 'error');
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("Delete Request Error:", textStatus, errorThrown);
                    Swal.fire('ERROR!', 'Failed to delete selected record.', 'error');
                });
            }
        });
    });
}

function createEdtRecordHandler(parameter){
    $(document).on("click", parameter.btnClass, function() {
        let userId = $(this).attr("row-data");
        $.ajax({
            url: parameter.utilityURL,
            type: "POST",
            data: {id: userId},
            dataType: "json"
        }).done(function(response) {
            if (response.success) {
                let user = response.data;
                parameter.callback(user);
            } else {
                Swal.fire('ERROR', response.message, 'error');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error fetching selected record:", textStatus, errorThrown);
            Swal.fire('ERROR!', 'Failed to fetch selected record.', 'error');
        });
    });
}