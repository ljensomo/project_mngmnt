const version = {
    modalId: "#version-modal",
    modalEditId: "#version-edit-modal",
    formId: "#version-form",
    formEditId: "#version-edit-form",
    tableId: "#version-table",
    utilityUrl: "utilities/project-version/",
}

$("#a-version-project-id, #e-version-project-id").val(projectId);

let versionTable = initDataTable({
    tableId: version.tableId,
    ajaxUrl: version.utilityUrl + "get-all.php?pid=" + projectId,
    columns: [
        { data: "id", visible: false },
        { 
            data: "version_number", 
            createdCell: function (td, cellData, rowData, row, col) {
                $(td).addClass("fw-bold text-dark font-monospace");
            }
        },
        { 
            data: "remarks",
            render: function(data) {
                return data ? data : `<span class="text-muted opacity-50 small"><em>No remarks</em></span>`;
            }
        },
        {
            data: "status",
            render: function(data, type, row) {
                const statusConfig = {
                    1: { icon: 'fa-code',           classes: 'bg-warning-subtle text-warning border-warning-subtle' }, // DEVELOPMENT
                    2: { icon: 'fa-paper-plane',    classes: 'bg-info-subtle text-info border-info-subtle' },          // PUBLISHED
                    3: { icon: 'fa-circle-check',   classes: 'bg-success-subtle text-success border-success-subtle' }, // ACTIVE
                    4: { icon: 'fa-box-archive',     classes: 'bg-secondary-subtle text-secondary border-secondary-subtle' }, // ARCHIVED
                    5: { icon: 'fa-ban',             classes: 'bg-danger-subtle text-danger border-danger-subtle' }     // WITHDRAWN
                };

                const currentStatus = statusConfig[data] || { 
                    icon: 'fa-circle-question', 
                    classes: 'bg-light text-muted border-light-subtle' 
                };

                return `
                    <span class="badge border rounded-3 d-inline-flex align-items-center fw-bold px-2 py-1 text-uppercase font-monospace fs-7" 
                        style="letter-spacing: 0.5px; font-size: 0.7rem;">
                        <i class="fa-solid ${currentStatus.icon} me-2" style="width: 12px; text-align: center;"></i> 
                        ${row.status_name}
                    </span>`.replace('class="badge border', `class="badge border ${currentStatus.classes}`);
            }
        },
        { 
            data: "target_date_release",
            className: "text-secondary small"
        },
        { 
            data: "date_released",
            className: "text-secondary small",
            render: function(data) {
                return (data && data !== '0000-00-00') ? data : `<span class="badge bg-light text-muted border border-light-subtle rounded-3 font-monospace">PENDING</span>`;
            }
        },
        { 
            data: "date_created",
            className: "text-secondary small"
        },
        {
            data: function(data) {
                return createDataTableBtns({
                    edit: true,
                    delete: true,
                    data: data.id, 
                    name: "version",
                });
            }, 
            className: "text-end pe-3" // Aligns perfectly under the text-end table header
        }
    ],
});

// Example data state fetched from your backend data-attributes or latest record row
const currentLatestVersion = "v0.0.0"; 

document.getElementById('version_bump_type').addEventListener('change', function() {
    const bumpType = this.value;
    const previewBadge = document.getElementById('version-preview');
    
    // Clean string characters and extract components: [1, 0, 0]
    let parts = currentLatestVersion.replace('v', '').split('.').map(Number);
    
    if(parts.length !== 3) parts = [1, 0, 0]; // Safe recovery fallback
    let minor = parts[1];
    let patch = parts[2]
    // Semantic Calculation Calculations
    if (bumpType === 'major') {
        major += 1;
        minor = 0;
        patch = 0;
    } else if (bumpType === 'minor') {
        minor += 1;
        patch = 0;
    } else if (bumpType === 'patch') {
        patch += 1;
    }

    const calculatedVersion = `v${major}.${minor}.${patch}`;
    
    previewBadge.textContent = calculatedVersion;
});

createFrmSubmitHandler([
    {
        formId: version.formId,
        utilityURL: version.utilityUrl + "add.php",
        dataTable: versionTable,
        modalId: version.modalId
    },
    {
        formId: version.formEditId,
        utilityURL: version.utilityUrl + "update.php",
        dataTable: versionTable,
        modalId: version.modalEditId
    }
]);

createDltRecordHandler({
    btnClass: ".btn-delete-version",
    utilityURL: version.utilityUrl + "delete.php",
    dataTable: versionTable, 
});

createEdtRecordHandler({
    btnClass: ".btn-edit-version",
    utilityURL: version.utilityUrl + "get.php",
    callback: function(data){
        $("#version-id").val(data.id);
        $("#version-number").val(data.version_number);
        $("#version-remarks").val(data.remarks);
        $("#version-status").val(data.status);
        $("#version-target-date-release").val(data.target_date_release);
        $("#version-release-date").val(data.date_released);
        $(version.modalEditId).modal("toggle");
    }
});