<nav class="sidebar text-white p-3 shadow-sm" style="width: 250px; min-height: 100vh;">
    <h4 class="text-center text-uppercase inactive-text fw-bold mb-4">Admin Panel</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active bg-white text-primary fw-bold' : ''; ?>" href="projects.php">
                <i class="fas fa-folder-open me-2"></i> Projects
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active bg-white text-primary fw-bold' : ''; ?>" href="users.php">
                <i class="fas fa-users me-2"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?php echo basename($_SERVER['PHP_SELF']) == 'database-backups.php' ? 'active bg-white text-primary fw-bold' : ''; ?>" href="database-backups.php">
                <i class="fas fa-database me-2"></i> Database Backups
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse"
                href="#settingsSubmenu"
                role="button"
                aria-expanded="false"
                aria-controls="settingsSubmenu">
                <span>
                    <i class="fas fa-cogs me-2"></i> Settings
                </span>
                <i class="fas fa-chevron-down small"></i>
            </a>
            <div class="collapse" id="settingsSubmenu">
                <ul class="nav flex-column ms-3 mt-1">
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="project-status.php">Project Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="#">Technologies</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="utilities/logout.php">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>
    </ul>
</nav>