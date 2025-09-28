<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>

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
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-end bg-white" style="white-space:nowrap; position:sticky; left:0; z-index:1;">Project Name</th>
                                        <td id="project-name">Loading...</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end bg-white" style="white-space:nowrap; position:sticky; left:0; z-index:1;">Description</th>
                                        <td id="project-description">Loading...</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end bg-white" style="white-space:nowrap; position:sticky; left:0; z-index:1;">Phase</th>
                                        <td id="project-status">Loading...</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end bg-white" style="white-space:nowrap; position:sticky; left:0; z-index:1;">Date Created</th>
                                        <td id="project-date-created">Loading...</td>
                                    </tr>
                                    <tr>
                                        <th class="text-end bg-white" style="white-space:nowrap; position:sticky; left:0; z-index:1;">Created By</th>
                                        <td id="project-created-by">Loading...</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Legends</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Description</th>
                                            <th style="width: 100px;">Tasks</th>
                                            <th style="width: 100px;">Modules</th>
                                            <th style="width: 100px;">Features</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-primary">
                                            <td><strong>Open</strong></td>
                                            <td>Currently open and not yet started.</td>
                                            <td id="task-1">0</td>
                                            <td id="module-1">0</td>
                                            <td id="feature-1">0</td>
                                        </tr>
                                        <tr class="table-secondary">
                                            <td><strong>In Progress</strong></td>
                                            <td>Currently being worked on.</td>
                                            <td id="task-2">0</td>
                                            <td id="module-2">0</td>
                                            <td id="feature-2">0</td>
                                        </tr>
                                        <tr class="table-success">
                                            <td><strong>Completed</strong></td>
                                            <td>Has been completed successfully.</td>
                                            <td id="task-3">0</td>
                                            <td id="module-3">0</td>
                                            <td id="feature-3">0</td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td><strong>On Hold</strong></td>
                                            <td>Currently on hold and not being worked on.</td>
                                            <td id="task-4">0</td>
                                            <td id="module-4">0</td>
                                            <td id="feature-4">0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link project-nav-link active" aria-current="true" href="#">Tasks</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">Modules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">Versions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link project-nav-link" href="#">Technologies</a>
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
    <script src="assets/utilities.js"></script>
    <script src="assets/view-project.js"></script>
    <script src="assets/project/task.js"></script>
    <script src="assets/project/module.js"></script>
    <script src="assets/project/feature.js"></script>
    <script src="assets/project/version.js"></script>
    <script src="assets/project/technology.js"></script>
</body>

</html>