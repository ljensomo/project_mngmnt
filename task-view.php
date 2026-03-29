<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task | PMS</title>

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
                <nav aria-label="breadcrumb" class="bg-light rounded px-3 py-2 mb-3 shadow-sm" style="--bs-breadcrumb-divider: '>';">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="text-decoration-none text-primary fw-semibold">
                                <i class="fas fa-arrow-left me-1"></i> Back to Project
                            </a>
                        </li>
                        <li class="breadcrumb-item active fw-semibold text-dark" aria-current="page">
                            Task #<?= $_GET['tid'] ?>
                        </li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="card mb-3">
                            <div class="card-header"><i class="fas fa-tasks me-1"></i><strong>Task Details</strong></div>
                            <div class="card-body">
                                <form action="#" id="task-form">
                                    <input type="hidden" name="task_id" id="task-id" value="<?php echo isset($_GET['tid']) ? intval($_GET['tid']) : 0; ?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <select name="type" class="form-control" id="task-type" required>
                                                <option value="" disabled>-- Select Type</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control" type="text" name="task" placeholder="Task Name" id="task" aria-label="Project Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" name="description" placeholder="Task Description" id="description" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <select name="assign_to" id="assign-to" class="form-control">
                                                <option value="" disabled>-- Choose Assignee</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="" disabled>-- Choose Status</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save Changes</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header"><i class="fas fa-note-sticky me-1"></i><strong>Notes</strong></div>
                            <div class="card-body">
                                <form class="row g-2" id="note-form">
                                    <input type="hidden" name="task_id" value="<?php echo isset($_GET['tid']) ? intval($_GET['tid']) : 0; ?>">
                                    <div class="col-md-10">
                                        <textarea name="note" class="form-control" id="notes" placeholder="Add a note..." required></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-paper-plane me-1"></i>Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-history me-1"></i><strong>Task History</strong>
                            </div>
                            <div class="card-body">
                                <div class="container py-4" id="history-div">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'includes/js-assets.html';
    ?>

    <!-- custom scripts -->
    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/task-view.js"></script>
</body>

</html>