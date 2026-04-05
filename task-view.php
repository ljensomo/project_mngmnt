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
                        <div class="card border-1 shadow-sm mb-3" >
                            <div class="card-header bg-white py-3 border-bottom-0">
                                <h5 class="mb-0 fw-bold"><span class="me-2">📝</span>Task Details</h5>
                            </div>
                            <div class="card-body p-4">
                                <form action="#" id="task-form">
                                    <input type="hidden" name="task_id" id="task-id" value="<?php echo isset($_GET['tid']) ? intval($_GET['tid']) : 0; ?>">
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small text-muted text-uppercase" for="task-type">Type</label>
                                            <select name="type" class="form-select shadow-none" id="task-type" required style="border-radius: 8px;">
                                                <option value="" disabled selected>-- Select Type</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small text-muted text-uppercase" for="status">Status</label>
                                            <select name="status" id="status" class="form-select shadow-none" required style="border-radius: 8px;">
                                                <option value="" disabled>-- Choose Status</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold small text-muted text-uppercase" for="task">Task Name</label>
                                            <input class="form-control shadow-none" type="text" name="task" placeholder="What needs to be done?" id="task" required style="border-radius: 8px; padding: 0.6rem 1rem;">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold small text-muted text-uppercase" for="description">Description</label>
                                            <textarea class="form-control shadow-none" name="description" placeholder="Provide some context..." id="description" rows="3" required style="border-radius: 8px;"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold small text-muted text-uppercase" for="assign-to">Assignee</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0 text-muted" style="border-radius: 8px 0 0 8px;">👤</span>
                                                <select name="assignee" id="assign-to" class="form-select shadow-none" style="border-radius: 0 8px 8px 0;">
                                                    <option value="" disabled selected>-- Choose Assignee</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                        <button type="button" class="btn btn-light me-2 px-4" style="border-radius: 8px;">Cancel</button>
                                        <button type="submit" class="btn btn-primary px-4 fw-bold" style="border-radius: 8px;">
                                            <i class="fa fa-save me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card border-1 shadow-sm mb-3">
                            <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                                <h6 class="fw-bold d-flex align-items-center text-dark">
                                    <span class="me-2">💬</span> Notes
                                </h6>
                            </div>
                            <div class="card-body">
                                <form id="note-form">
                                    <input type="hidden" name="task_id" value="<?php echo isset($_GET['tid']) ? intval($_GET['tid']) : 0; ?>">
                                    
                                    <div class="position-relative">
                                        <textarea name="note" class="form-control bg-light border-0 ps-3 pt-3 shadow-none" 
                                            id="notes" 
                                            placeholder="Write a comment or update..." 
                                            style="border-radius: 12px; min-height: 100px; resize: none;"></textarea>
                                        
                                        <div class="d-flex justify-content-between align-items-center mt-2 px-1">
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                <i class="fas fa-info-circle me-1"></i>Visible to team members
                                            </small>
                                            <button type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 8px;">
                                                <i class="fas fa-paper-plane me-2"></i>Post Note
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                                <div id="notes-list" class="mt-3">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card border-1 shadow-sm mb-3">
                            <div class="card-header bg-white border-0 pt-4 px-4">
                                <h6 class="fw-bold mb-0 text-dark">
                                    <i class="fas fa-history me-2 text-muted"></i>Task History
                                </h6>
                            </div>
                            <div class="card-body px-4">
                                <div class="timeline-container">
                                    
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