<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task | PMS</title>
    <?php include 'includes/css-assets.html'; ?>
</head>
<style>
    /* Add this to your custom CSS if not already there */
    .flex-grow-1 {
        padding-top: 60px; /* Adjust based on your topbar height */
    }
</style>

<body>
    <?php include 'includes/topbar.php'; ?>
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-grow-1">
            <div class="container-fluid pt-4 px-4">
                <nav aria-label="breadcrumb" class="mb-4" style="display: block !important; visibility: visible !important;">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>" class="text-decoration-none text-primary fw-bold" style="color: #0d6efd !important;">
                                <i class="fas fa-chevron-left me-1"></i> Back
                            </a>
                        </li>
                        </ol>
                </nav>

                <div class="row g-4">
                    <div class="col-sm-5">
                        <div class="card border-0 shadow-sm mb-4 rounded-4">
                            <div class="card-header bg-white border-0 pt-4 px-4">
                                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-tasks me-2 text-primary"></i>Task Details</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="#" id="task-form">
                                    <input type="hidden" name="task_id" id="task-id" value="<?php echo isset($_GET['tid']) ? intval($_GET['tid']) : 0; ?>">
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small text-muted text-uppercase">Type</label>
                                            <select name="type" class="form-select bg-light border-0 shadow-none rounded-3" id="task-type" required>
                                                <option value="" disabled selected>-- Select Type</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                                            <select name="status" id="status" class="form-select bg-light border-0 shadow-none rounded-3" required>
                                                <option value="" disabled>-- Choose Status</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold small text-muted text-uppercase">Task Name</label>
                                            <input class="form-control bg-light border-0 shadow-none rounded-3" type="text" name="task" id="task" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold small text-muted text-uppercase">Description</label>
                                            <textarea class="form-control bg-light border-0 shadow-none rounded-3" name="description" id="description" rows="3" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold small text-muted text-uppercase">Assignee</label>
                                            <select name="assignee" id="assign-to" class="form-select bg-light border-0 shadow-none rounded-3">
                                                <option value="" disabled selected>-- Choose Assignee</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                        <button type="button" class="btn btn-light px-4 rounded-pill">Cancel</button>
                                        <button type="submit" class="btn btn-primary px-4 ms-2 rounded-pill shadow-sm">
                                            <i class="fa fa-check-circle me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                                <h6 class="fw-bold text-dark"><i class="fas fa-comments me-2 text-primary"></i>Notes</h6>
                            </div>
                            <div class="card-body p-4">
                                <form id="note-form">
                                    <textarea name="note" class="form-control bg-light border-0 shadow-none rounded-4 mb-2" id="notes" placeholder="Add a comment..." style="min-height: 80px;"></textarea>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3"><i class="fas fa-paper-plane me-2"></i>Post</button>
                                    </div>
                                </form>
                                <div id="notes-list" class="mt-3"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-7">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-white border-0 pt-4 px-4">
                                <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-history me-2 text-primary"></i>Task History</h6>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="timeline-container">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/js-assets.html'; ?>
    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/task-view.js"></script>
</body>
</html>