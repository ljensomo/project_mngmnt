<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects | PMS</title>
    <?php include 'includes/css-assets.html'; ?>
</head>

<body>
    <?php include 'includes/topbar.php'; ?>

    <div class="sidebar-wrapper">
        <?php include 'includes/sidebar.php'; ?>
    </div>

    <main class="main-content">
        <div class="container-fluid">
            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-folder-open me-2 text-primary"></i>Projects
                        </h5>
                        <button type="button" class="btn btn-primary shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#project-modal" style="border-radius: 8px;">
                            <i class="fas fa-plus me-1"></i> New Project
                        </button>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="project-table" class="table table-hover align-middle mb-0">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th class="border-0">ID</th>
                                    <th class="border-0">Project</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Date Added</th>
                                    <th class="border-0 text-nowrap">Created By</th>
                                    <th class="border-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
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