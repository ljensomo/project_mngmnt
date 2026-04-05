<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project | PMS</title>

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
                            <a href="projects.php" class="text-decoration-none text-primary fw-semibold">
                                <i class="fas fa-folder-open me-1"></i> Projects
                            </a>
                        </li>
                        <li class="breadcrumb-item active fw-semibold text-dark" aria-current="page">
                            <i class="fas fa-eye me-1"></i> View Project
                        </li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="card border-1 shadow-sm" style="overflow: hidden;">
                            <div class="card-header bg-white border-bottom py-3">
                                <h6 class="mb-0 fw-bold text-primary">
                                    📂 Project Information
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light text-muted fw-semibold ps-4" style="width: 30%;">Project Name</th>
                                                <td id="project-name" class="ps-3 fw-bold">Loading...</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-muted fw-semibold ps-4">Description</th>
                                                <td id="project-description" class="ps-3">Loading...</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-muted fw-semibold ps-4">Phase</th>
                                                <td class="ps-3">
                                                    <span id="project-status" class="badge bg-primary-soft text-primary border border-primary border-opacity-25">Loading...</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-muted fw-semibold ps-4">Date Created</th>
                                                <td id="project-date-created" class="ps-3 text-muted">Loading...</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light text-muted fw-semibold ps-4">Created By</th>
                                                <td class="ps-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-secondary rounded-circle me-2" style="width: 24px; height: 24px;"></div>
                                                        <span id="project-created-by">Loading...</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card border-1 shadow-sm h-80" style="border-radius: 16px; background: #ffffff;">
                            <div class="card-body p-4 text-center">
                                <div class="mb-2">
                                    <span style="font-size: 2rem;">📋</span>
                                </div>
                                
                                <h6 class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">
                                    Open Tasks
                                </h6>
                                
                                <h1 class="display-4 fw-bold mb-0" style="color: #0d6efd;" id="tasks-count">
                                    0
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card border-1 shadow-sm h-80" style="border-radius: 16px; background: #ffffff;">
                            <div class="card-body p-4 text-center">
                                <div class="mb-2">
                                    <span style="font-size: 2rem;">📦</span>
                                </div>
                                <h6 class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">
                                    Total Modules
                                </h6>
                                <h1 class="display-4 fw-bold mb-0" style="color: #6610f2;" id="modules-count">0</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card border-1 shadow-sm h-80" style="border-radius: 16px; background: #ffffff;">
                            <div class="card-body p-4 text-center">
                                <div class="mb-2">
                                    <span style="font-size: 2rem;">🚀</span>
                                </div>
                                <h6 class="text-muted fw-semibold text-uppercase mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">
                                    Total Features
                                </h6>
                                <h1 class="display-4 fw-bold mb-0" style="color: #198754;" id="features-count">0</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link project-nav-link active" aria-current="true" href="#">📋 <span>Tasks</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">📦 <span>Modules</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">🚀 <span>Features</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">🔄 <span>Versions</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">⚙️ <span>Technologies</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <?php
                        include 'includes/project/tasks-tab.html';
                        include 'includes/project/modules-tab.html';
                        include 'includes/project/features-tab.html';
                        include 'includes/project/version-tab.html';
                        include 'includes/project/technologies-tab.html';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'modals/project-task-modals.html';
    include 'modals/project-module-modals.html';
    include 'modals/project-feature-modals.html';
    include 'modals/project-version-modals.html';
    include 'modals/project-technologies-modals.html';
    include 'includes/js-assets.html';
    ?>

    <!-- custom scripts -->
    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/view-project.js"></script>
    <script src="assets/js/project/task.js"></script>
    <script src="assets/js/project/module.js"></script>
    <script src="assets/js/project/feature.js"></script>
    <script src="assets/js/project/version.js"></script>
    <script src="assets/js/project/technology.js"></script>
</body>

</html>