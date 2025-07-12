<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>

    <?php include 'includes/css-assets.html'; ?>
</head>

<body>
    <?php include 'includes/topbar.php'; ?>
    <div class="container-fluid">
        <br>
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#project-modal">
                    <i class="fas fa-plus"></i> New Project
                </button>
                <hr>
                <table id="project-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'modals/project-modals.html'; ?>

    <?php include 'includes/js-assets.html'; ?>

    <!-- custom scripts -->
    <script src="assets/utilities.js"></script>
    <script src="assets/project.js"></script>
</body>

</html>