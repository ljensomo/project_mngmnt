<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Status | PMS</title>

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
                        <strong><i class="fas fa-folder-open me-2"></i>Project Statuses</strong>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#project-status-modal">
                            <i class="fas fa-plus"></i> New Project Status
                        </button>
                        <hr>
                        <table id="project-status-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Status</th>
                                    <th>Description</th>
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
        include 'modals/project-status-modals.html';
        include 'includes/js-assets.html'; 
    ?>

    <!-- custom scripts -->
    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/project-status.js"></script>
</body>

</html>