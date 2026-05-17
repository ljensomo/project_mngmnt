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

// Function to create a form submission handler
function createDataTableBtns(buttonConfig) {
    const buttons = [];

    // Unified layout styling: Sleek, borderless light-gray buttons by default
    // They shift to their targeted brand color instantly on hover
    const standardButtons = {
        view: { 
            hoverClass: "hover-primary", 
            icon: "fa-regular fa-eye", // Swapped to modern regular/line style
            id: "view-",
            title: "View Details"
        },
        edit: { 
            hoverClass: "hover-warning", 
            icon: "fa-regular fa-pen-to-square", 
            id: "edit-",
            title: "Edit Record"
        },
        delete: { 
            hoverClass: "hover-danger", 
            icon: "fa-regular fa-trash-can", 
            id: "delete-",
            title: "Delete Record"
        }
    };

    ['view', 'edit', 'delete'].forEach(action => {
        if (buttonConfig[action]) {
            buttons.push(createButton({
                anchor: action === 'view' ? true : false,
                href: buttonConfig.href || "#",
                
                // Purely utility-driven classes
                type: `btn btn-action-card rounded-3 d-inline-flex align-items-center justify-content-center transition-all ${standardButtons[action].hoverClass}`,
                icon: standardButtons[action].icon,
                id: standardButtons[action].id + buttonConfig.name,
                data: buttonConfig.data,
                
                // 32px forms an elegant modern micro-square
                style: "width: 32px; height: 32px; font-size: 0.85rem;",
                title: standardButtons[action].title
            }));
        }
    });

    if (buttonConfig.custom && Array.isArray(buttonConfig.custom)) {
        buttonConfig.custom.forEach(cBtn => {
            buttons.push(createButton({
                anchor: cBtn.anchor ?? false,
                href: cBtn.href ?? "#",
                type: `btn btn-action-card rounded-3 d-inline-flex align-items-center justify-content-center transition-all hover-secondary`,
                icon: cBtn.icon ?? "fa-regular fa-gear",
                id: cBtn.id ?? "custom-" + buttonConfig.name,
                data: buttonConfig.data,
                style: "width: 32px; height: 32px; font-size: 0.85rem;",
                title: cBtn.title ?? "Action"
            }));
        });
    }

    return `<div class="d-inline-flex align-items-center">${buttons.join('')}</div>`;
}

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
                    title: response.title || 'Action Completed!',
                    text: response.message || 'Your changes have been saved successfully.',
                    icon: 'success',
                    confirmButtonText: 'Continue',
                    confirmButtonColor: '#0d6efd',
                    customClass: {
                        popup: 'rounded-4 shadow p-3'
                    }
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
            showLoaderOnConfirm: true, // Show loading spinner inside the button
            preConfirm: () => {
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
                    Swal.fire('Action Completed!', response.message, 'success');
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

function getAvatar(name, size = 35) {
    const displayName = name && name.trim() !== "" ? name : "Unassigned";
    
    // 1. Extract Initials
    const initials = displayName
        .split(' ')
        .filter(part => part.length > 0)
        .map(part => part[0])
        .join('')
        .toUpperCase()
        .substring(0, 2);

    // 2. Generate a Pastel Color based on the name string
    let hash = 0;
    for (let i = 0; i < displayName.length; i++) {
        hash = displayName.charCodeAt(i) + ((hash << 5) - hash);
    }

    // HSL: Hue (0-360), Saturation (low for pastel: 40-50%), Lightness (high for pastel: 85-90%)
    const hue = Math.abs(hash) % 360;
    const bgPastel = `hsl(${hue}, 45%, 88%)`;
    const textDark = `hsl(${hue}, 60%, 30%)`; // Darker version of the same hue for contrast

    // Handle "Unassigned" specifically for a neutral look
    const finalBg = displayName === "Unassigned" ? "#f1f3f5" : bgPastel;
    const finalText = displayName === "Unassigned" ? "#6c757d" : textDark;

    return `
        <div class="d-inline-flex align-items-center">
            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                 style="width: ${size}px; height: ${size}px; min-width: ${size}px; 
                        background-color: ${finalBg}; color: ${finalText}; 
                        font-size: ${size * 0.4}px; border: 1px solid rgba(0,0,0,0.05);"
                 title="${displayName}">
                ${initials}
            </div>
            <span class="ms-2 fw-semibold text-dark" style="font-size: 0.9rem;">${displayName}</span>
        </div>`;
}