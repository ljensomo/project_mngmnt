// Function to create a button with specified parameters
function createButton(parameter){
    let button = "";

    if(parameter.anchor){
        button = $("<a>");
        button.attr("href", parameter.href ? parameter.href : "#");
        button.attr("role", "button");
    }else{
        button = $("<button>");
    }

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
        button.attr("row-id", parameter.data);
    }

    return button[0].outerHTML;
}

// Function to initialize DataTable
// Parameters should include tableId, ajaxUrl, and columns
/**
 * Initializes a DataTables instance with standard configurations.
 * @param {Object} p - Configuration object
 */
function initDataTable(p) {
    // 1. Destroy existing instance to prevent "Cannot reinitialise" errors
    if ($.fn.DataTable.isDataTable(p.tableId)) {
        $(p.tableId).DataTable().destroy();
    }

    return new DataTable(p.tableId, {
        ajax: {
            url: p.ajaxUrl,
            dataSrc: p.dataSrc || "data", // Default to "data" if not provided
            error: function(xhr, error, thrown) {
                console.error("DataTables Error: ", error);
                // Optional: Trigger a toast notification or alert here
            }
        },
        processing: true,
        serverSide: p.serverSide || false, // Toggle server-side processing
        responsive: true,                 // Highly recommended for your card UI
        columns: p.columns,
        columnDefs: p.columnDefs || [],     // Allow custom column definitions
        createdRow: p.createdRow,
        order: p.order || [[0, "desc"]],
        // 2. Add language support/defaults
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        },
        // 3. Performance & UI adjustments
        drawCallback: function(settings) {
            // 1. Destroy any existing tooltips to prevent memory leaks/doubling
            const oldTooltips = document.querySelectorAll('.tooltip');
            oldTooltips.forEach(t => t.remove());

            // 2. Re-initialize all tooltips in the table
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover',
                    container: 'body'
                });
            });
        }
    });
}

function reloadDataTable(table){
    table.ajax.reload(null, false); // Reload the DataTable without resetting pagination
}

// Function to create buttons for DataTable actions
function createDataTableBtns(buttonConfig) {
    const buttons = [];

    // Map of standard buttons configuration
    const standardButtons = {
        view: { type: "info", icon: "fa-eye", id: "view-" },
        edit: { type: buttonConfig.editType ?? "warning", icon: buttonConfig.editIcon ?? "fa-pen-to-square", id: "edit-" },
        delete: { type: "danger", icon: buttonConfig.deleteIcon ?? "fa-trash", id: "delete-" }
    };

    // 1. Process Standard Buttons
    ['view', 'edit', 'delete'].forEach(action => {
        if (buttonConfig[action]) {
            buttons.push(createButton({
                anchor: action === 'view' ? true : false, // Assuming only view is an anchor
                href: buttonConfig.href || "#",
                type: standardButtons[action].type,
                icon: standardButtons[action].icon,
                id: standardButtons[action].id + buttonConfig.name,
                data: buttonConfig.data
            }));
        }
    });

    // 2. Process Custom Buttons
    if (buttonConfig.custom && Array.isArray(buttonConfig.custom)) {
        buttonConfig.custom.forEach(cBtn => {
            buttons.push(createButton({
                anchor: cBtn.anchor ?? false,
                href: cBtn.href ?? "#",
                type: cBtn.type ?? "secondary",
                icon: cBtn.icon ?? "fa-cog",
                id: cBtn.id ?? "custom-" + buttonConfig.name,
                data: buttonConfig.data
            }));
        });
    }

    return buttons.join(' ');
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
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    if (parameter.dataTable) reloadDataTable(parameter.dataTable);
                    if (parameter.modalId) $(parameter.modalId).modal("hide");
                    if (parameter.noReset !== true) $(parameter.formId)[0].reset();
                    if (parameter.callback) parameter.callback(response); // Pass response to callback
                });
            } else {
                // Display server-side error messages
                Swal.fire("Attention!", response.message || "Failed to process request.", "warning");
            }
        }).fail(function(jqXHR) {
            // Detailed network/server error handling
            let errorMessage = "An unexpected error occurred.";
            if (jqXHR.status === 422) {
                errorMessage = "Validation failed. Please check your inputs.";
            } else if (jqXHR.status === 500) {
                errorMessage = "Server error. Please try again later.";
            }
            
            Swal.fire("System Error!", errorMessage, "error");
        });
    });
}

// Function to create a delete record handler
function createDltRecordHandler(parameter) {
    // Use 'off' then 'on' to prevent multiple event bindings if this function is called repeatedly
    $(document).off("click", parameter.btnClass).on("click", parameter.btnClass, function() {
        const recordId = $(this).attr("row-id");
        
        Swal.fire({
            title: 'Delete Record?',
            text: "This action is permanent and cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33', // Red for delete
            cancelButtonColor: '#6c757d', // Neutral for cancel
            confirmButtonText: 'Yes, permanently delete',
            showLoaderOnConfirm: true, // 2. Show loading spinner inside the button
            preConfirm: () => {
                // 3. Encapsulate the AJAX in preConfirm for better UX
                return $.ajax({
                    url: parameter.utilityURL,
                    method: "POST",
                    data: { id: recordId },
                    dataType: "json"
                }).catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error.statusText}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                const response = result.value;
                if (response.success) {
                    Swal.fire('Deleted!', response.message, 'success');
                    if (parameter.dataTable) reloadDataTable(parameter.dataTable);
                    if (parameter.callback) parameter.callback(response);
                } else {
                    Swal.fire('Failed', response.message || 'Unable to delete.', 'error');
                }
            }
        });
    });
}

function createEdtRecordHandler(parameter){
    $(document).on("click", parameter.btnClass, function() {
        let userId = $(this).attr("row-id");
        $.ajax({
            url: parameter.utilityURL,
            type: "GET",
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

function populateSelect(options){
    options.forEach(function(option){
        $.ajax({
            url: option.url,
            type: "GET",
            dataType: "json"
        }).done(function(response){
            $.each(response.data, function(index, data) {
                let opt = $("<option>");
                opt.val(data[option.value]);
                let text = "";

                if(Array.isArray(option.text)){
                    for(let column of option.text){
                        text += data[column]+" ";
                    }
                }else{
                    text = data[option.text];
                }

                opt.text(text);

                if(Array.isArray(option.selectId)){
                    option.selectId.forEach(function(selectId) {
                        $(selectId).append(opt.clone());
                    });
                }else{
                    $(option.selectId).append(opt);
                }
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error populating select:", textStatus, errorThrown);
            Swal.fire('ERROR!', 'Failed to populate select options.', 'error');
        });
    });
}