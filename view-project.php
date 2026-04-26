<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project | PMS</title>
    <?php include 'includes/css-assets.html'; ?>
</head>
<style>
    .hover-primary:hover { color: var(--bs-primary) !important; }
    .breadcrumb-item.active { color: var(--bs-primary) !important; }
    #projectTabs .nav-link {
        color: #6c757d;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        font-weight: 600;
    }
    #projectTabs .nav-link.active {
        background-color: white !important;
        color: var(--bs-primary) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    #projectTabs .nav-link:hover:not(.active) {
        color: var(--bs-primary);
        background-color: rgba(13, 110, 253, 0.05);
    },
    .hover-highlight:hover { background-color: rgba(13, 110, 253, 0.05); cursor: default; }
    .transition-all:hover { transform: scale(1.02); }
</style>
<body>
    <?php include 'includes/topbar.php'; ?>

    <div class="sidebar-wrapper">
        <?php include 'includes/sidebar.php'; ?>
    </div>

    <main class="main-content">
        <input type="hidden" id="project-id" value="<?php echo isset($_GET['id']) ? intval($_GET['id']) : 0; ?>">

        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="mb-4 d-inline-block">
                <ol class="breadcrumb bg-white border border-light shadow-sm rounded-pill px-4 py-2 mb-0">
                    <li class="breadcrumb-item d-flex align-items-center">
                        <a href="projects.php" class="text-decoration-none text-muted d-flex align-items-center hover-primary">
                            <i class="fas fa-chevron-left me-2" style="font-size: 0.7rem;"></i> 
                            Projects
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-primary fw-bold d-flex align-items-center" aria-current="page">
                        <span class="ms-1">View Project</span>
                    </li>
                </ol>
            </nav>

            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold text-primary">
                                <i class="fas fa-folder-open me-2"></i>Project Information
                            </h6>
                            <button type="button" 
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#edit-project-modal">
                                <i class="fas fa-edit me-1"></i> Edit Details
                            </button>
                        </div>

                        <div class="card-body p-4">
                            <div class="d-flex flex-column gap-3">
                                
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3"><i class="fas fa-heading"></i></div>
                                    <div class="flex-grow-1">
                                        <div class="small text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Project Name</div>
                                        <div class="fw-bold text-dark fs-6" id="project-name">Loading...</div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start">
                                    <div class="bg-info bg-opacity-10 text-info p-2 rounded-3 me-3"><i class="fas fa-align-left"></i></div>
                                    <div class="flex-grow-1">
                                        <div class="small text-muted text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Description</div>
                                        <div class="text-secondary small" id="project-description">Loading...</div>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Current Phase</div>
                                        <span id="project-status" class="badge bg-light text-dark border px-3 py-2">Loading...</span>
                                    </div>
                                    <div class="col-6">
                                        <div class="small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Date Created</div>
                                        <div class="text-dark fw-medium" id="project-date-created">Loading...</div>
                                    </div>
                                </div>

                                <hr class="text-muted opacity-25">

                                <div class="d-flex align-items-center">
                                    <div class="bg-light text-primary rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" 
                                        style="width: 36px; height: 36px; border: 2px solid #fff;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted" style="font-size: 0.7rem;">Created By</div>
                                        <div id="project-created-by" class="fw-bold text-dark">Loading...</div>
                                    </div>
                                </div>

                                <div class="row g-2 mt-3">
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded text-center">
                                            <div class="small text-muted text-uppercase" style="font-size: 0.6rem;">Deadline</div>
                                            <div class="fw-bold text-dark">May 15, 2026</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded text-center">
                                            <div class="small text-muted text-uppercase" style="font-size: 0.6rem;">Priority</div>
                                            <div class="fw-bold text-danger">High</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="d-flex justify-content-between small text-muted mb-1">
                                        <span>Overall Progress</span>
                                        <span>65%</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 16px;">
                        <div class="card-header bg-gradient bg-light border-0 pt-3 pb-2">
                            <h6 class="fw-bold small text-uppercase text-primary m-0">
                                <i class="fas fa-clock me-2"></i>Phase Milestones
                            </h6>
                        </div>

                        <div class="card-body p-3 d-flex flex-column">
                            <div class="table-responsive flex-grow-1">
                                <table class="table table-sm table-hover align-middle mb-0">
                                    <tbody id="project-milestones-body">
                                        <?php 
                                        $milestones = [
                                            ['name' => 'Planning', 'date' => 'Apr 30, 2026', 'icon' => 'fa-clipboard'],
                                            ['name' => 'Design', 'date' => 'May 05, 2026', 'icon' => 'fa-pencil-ruler'],
                                            ['name' => 'Development', 'date' => 'May 15, 2026', 'icon' => 'fa-code'],
                                            ['name' => 'Testing', 'date' => 'May 20, 2026', 'icon' => 'fa-bug'],
                                            ['name' => 'Deployment', 'date' => 'May 25, 2026', 'icon' => 'fa-rocket'],
                                            ['name' => 'Maintenance', 'date' => 'Ongoing', 'icon' => 'fa-tools'],
                                            ['name' => 'Closed', 'date' => '—', 'icon' => 'fa-check-circle']
                                        ];
                                        foreach($milestones as $m): 
                                        ?>
                                        <tr class="hover-highlight">
                                            <td class="small fw-medium py-2">
                                                <i class="fas <?= $m['icon'] ?> text-muted me-2" style="width: 15px;"></i>
                                                <?= $m['name'] ?>
                                            </td>
                                            <td class="text-end small fw-bold text-primary"><?= $m['date'] ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 pt-2 border-top">
                                <button type="button" 
                                        class="btn btn-sm btn-primary w-100 rounded-pill shadow-sm transition-all"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#milestones-modal"
                                        style="transition: transform 0.2s;">
                                    <i class="fas fa-calendar-plus me-2"></i>Manage Timeline
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <ul class="nav nav-pills nav-justified bg-light p-1 rounded-pill" id="projectTabs" style="width: fit-content; gap: 4px;">
                        <?php 
                            $tabs = [
                                ['id' => '#tasks', 'label' => 'Tasks', 'icon' => 'fa-tasks'],
                                ['id' => '#modules', 'label' => 'Modules', 'icon' => 'fa-cubes'],
                                ['id' => '#features', 'label' => 'Features', 'icon' => 'fa-rocket'],
                                ['id' => '#versions', 'label' => 'Versions', 'icon' => 'fa-code-branch'],
                                ['id' => '#technologies', 'label' => 'Tech', 'icon' => 'fa-microchip']
                            ];
                            foreach($tabs as $tab):
                        ?>
                        <li class="nav-item">
                            <a class="nav-link rounded-pill px-4 <?= ($tab['id'] === '#tasks') ? 'active' : '' ?>" 
                            data-bs-toggle="pill" href="<?= $tab['id'] ?>">
                            <i class="fas <?= $tab['icon'] ?> me-2"></i><?= $tab['label'] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tasks"><?php include 'includes/project/tasks-tab.html'; ?></div>
                        <div class="tab-pane fade" id="modules"><?php include 'includes/project/modules-tab.html'; ?></div>
                        <div class="tab-pane fade" id="features"><?php include 'includes/project/features-tab.html'; ?></div>
                        <div class="tab-pane fade" id="versions"><?php include 'includes/project/version-tab.html'; ?></div>
                        <div class="tab-pane fade" id="technologies"><?php include 'includes/project/technologies-tab.html'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
        include 'modals/project-view-edit-modal.php';
        include 'modals/project-task-modals.html';
        include 'modals/project-module-modals.html';
        include 'modals/project-feature-modals.html';
        include 'modals/project-version-modals.html';
        include 'modals/project-technologies-modals.html';
        include 'includes/js-assets.html';
    ?>

    <script src="assets/js/utilities.js"></script>
    <script src="assets/js/view-project.js"></script>
    <script src="assets/js/project/task.js"></script>
    <script src="assets/js/project/module.js"></script>
    <script src="assets/js/project/feature.js"></script>
    <script src="assets/js/project/version.js"></script>
    <script src="assets/js/project/technology.js"></script>
</body>
</html>