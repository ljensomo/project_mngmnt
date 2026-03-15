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
            <input type="hidden" id="project-id" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : 0; ?>">
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
                                <form action="" id="task-form">
                                    <input type="hidden" name="task_id" id="task-id">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <select name="type" class="form-control" id="task-type-2" required>
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
                                            <select name="assign_to" id="e-task-assign-to" class="form-control">
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
                                <form class="row g-2">
                                    <div class="col-md-10">
                                        <label for="inputPassword2" class="visually-hidden">Password</label>
                                        <textarea name="" class="form-control" id="notes" placeholder="Add a note..."></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-paper-plane me-1"></i>Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-history me-1"></i><strong>Task History</strong>
                            </div>
                            <div class="card-body">
                                <div class="container py-4">
                                    <div class="border-start border-4 border-success ms-3 ps-4 mb-4 position-relative">
                                        <div class="position-absolute translate-middle-x" style="left: -12px; top: 0;">
                                            <i class="fas fa-circle-plus text-success bg-white px-1"></i>
                                        </div>
                                        <p class="mb-0 fw-bold">User 1 <span class="fw-normal">added a note</span></p>
                                        <p class="text-secondary mb-1" style="font-size: 0.95rem;">
                                            "Checked the server logs; everything seems stable for the migration."
                                        </p>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i>2 minutes ago</small>
                                    </div>

                                    <div class="border-start border-4 border-primary ms-3 ps-4 mb-4 position-relative">
                                        <div class="position-absolute translate-middle-x" style="left: -12px; top: 0;">
                                            <i class="fas fa-arrows-rotate text-primary bg-white px-1"></i>
                                        </div>
                                        <p class="mb-0 fw-bold">User 2 <span class="fw-normal">changed status to</span> <span class="badge bg-primary">In Progress</span></p>
                                        <p class="text-secondary mb-1" style="font-size: 0.95rem;">
                                            Moving this task to the development sprint.
                                        </p>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i>15 minutes ago</small>
                                    </div>

                                    <div class="border-start border-4 border-info ms-3 ps-4 position-relative">
                                        <div class="position-absolute translate-middle-x" style="left: -12px; top: 0;">
                                            <i class="fas fa-paperclip text-info bg-white px-1"></i>
                                        </div>
                                        <p class="mb-0 fw-bold">System <span class="fw-normal">attached a file</span></p>
                                        <p class="text-secondary mb-1" style="font-size: 0.95rem;">
                                            <a href="#" class="text-decoration-none"><i class="fas fa-file-pdf me-1"></i>migration_report.pdf</a>
                                        </p>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i>1 hour ago</small>
                                    </div>
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
</body>

</html>