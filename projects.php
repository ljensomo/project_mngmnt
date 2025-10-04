<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects | PMS</title>

    <?php include 'includes/css-assets.html'; ?>
</head>

<body>
    <?php include 'includes/topbar.php'; ?>
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="container-fluid pt-3">
                <br>
                <div class="card">
                    <div class="card-header">
                        <strong><i class="fas fa-folder-open me-2"></i>Projects</strong>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#project-modal">
                            <i class="fas fa-plus"></i> New Project
                        </button>
                        <hr>
                        <table id="project-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date Added</th>
                                    <th class="no-wrap-column">Created By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        include 'modals/project-modals.html';
        include 'includes/js-assets.html'; 
    ?>

    <!-- custom scripts -->
    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/project.js"></script>
</body>

</html>