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
                // Return fallback text if remarks column field is empty or null
                return data ? data : `<span class="text-muted opacity-50 small"><em>No remarks</em></span>`;
            }
        },
        {
            data: "status",
            render: function(data, type, row) {
                // High-visibility, modern semantic tag matrix matching the main system design
                const statusStyles = {
                    1: { icon: 'fa-code',               style: 'background-color: #eff6ff; color: #1d4ed8; border-color: #dbeafe;' }, // Development
                    2: { icon: 'fa-paper-plane',        style: 'background-color: #faf5ff; color: #9333ea; border-color: #f3e8ff;' }, // Published
                    3: { icon: 'fa-circle-check',       style: 'background-color: #f0fdf4; color: #15803d; border-color: #dcfce7;' }, // Active
                    4: { icon: 'fa-archive',            style: 'background-color: #f1f5f9; color: #475569; border-color: #e2e8f0;' }, // Archived
                    5: { icon: 'fa-ban',                style: 'background-color: #fef2f2; color: #dc2626; border-color: #fecaca;' }  // Withdrawn
                };

                const currentStatus = statusStyles[data] || { 
                    icon: 'fa-question-circle', 
                    style: 'background-color: #f8fafc; color: #64748b; border-color: #e2e8f0;' 
                };

                return `
                    <span class="badge border rounded-pill d-inline-flex align-items-center fw-bold px-2.5 py-1 text-uppercase" 
                          style="font-size: 0.72rem; letter-spacing: 0.5px; ${currentStatus.style}">
                        <i class="fa-solid ${currentStatus.icon} me-1" style="font-size: 0.7rem; width: 12px; text-align: center;"></i> 
                        ${row.status_name}
                    </span>`;
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
                return data ? data : `<span class="badge bg-light text-muted border border-light-subtle rounded-3 font-monospace">PENDING</span>`;
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

    let major = parts[0];
    let minor = parts[1];
    let patch = parts[2];

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