<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

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
                        <strong><i class="fas fa-users me-2"></i>Users</strong>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#user-modal">
                            <i class="fas fa-plus"></i> Add User
                        </button>
                        <hr>
                        <table id="user-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
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
        include 'modals/user-modals.html';
        include 'includes/js-assets.html'; 
    ?>

    <!-- custom scripts -->
    <script src="assets/utilities.js"></script>
    <script src="assets/user.js"></script>
</body>
</html>