<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects | PMS</title>
    <?php include 'includes/css-assets.html'; ?>
</head>
<style>
    .nav-tabs .nav-link { border: none; font-weight: 600; color: #6c757d; }
    .nav-tabs .nav-link.active { color: var(--bs-primary); border-bottom: 2px solid var(--bs-primary); }
    .table thead th { border-bottom: none; padding: 16px; }
</style>
<body>
    <?php include 'includes/topbar.php'; ?>

    <div class="sidebar-wrapper">
        <?php include 'includes/sidebar.php'; ?>
    </div>

    <main class="main-content">
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold">Phase Requirements</h4>
                    <p class="text-muted small">Configure the global workflow for project lifecycle stages.</p>
                </div>
                <button class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-save me-1"></i> Save Configuration
                </button>
            </div>

            <ul class="nav nav-tabs border-0 mb-3" id="phaseTabs">
                <li class="nav-item"><button class="nav-link active" data-bs-target="#tab-planning">Planning</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-target="#tab-design">Design</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-target="#tab-dev">Development</button></li>
                </ul>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase small text-muted">
                            <tr>
                                <th class="ps-4">Task Type</th>
                                <th class="text-center">Enabled</th>
                                <th class="text-center">Mandatory</th>
                                <th class="text-end pe-4">Ordering</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold">Meeting</td>
                                <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                <td class="text-center"><input type="checkbox" class="form-check-input" checked></td>
                                <td class="text-end pe-4"><i class="fas fa-grip-vertical text-muted"></i></td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php 
        include 'modals/project-modals.html';
        include 'includes/js-assets.html'; 
    ?>

    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/project.js"></script>
</body>
</html>