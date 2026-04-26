<nav class="sidebar text-white p-3 shadow-lg" style="width: 260px; min-height: 100vh;">
    <div class="px-3 py-4 mb-3">
        <h5 class="text-white text-uppercase fw-bold m-0" style="letter-spacing: 1px;">
            <i class="fas fa-layer-group me-2 text-primary"></i>DevPanel
        </h5>
    </div>

    <ul class="nav flex-column">
        <?php 
            // Helper to clean up active class logic
            $current = basename($_SERVER['PHP_SELF']);
            function isActive($page, $current) { return $page == $current ? 'active' : ''; }
        ?>
        
        <li class="nav-item">
            <a class="nav-link <?= isActive('index.php', $current) ?>" href="#">
                <i class="fas fa-tachometer-alt me-3"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= isActive('projects.php', $current) ?>" href="projects.php">
                <i class="fas fa-folder-open me-3"></i> Projects
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= isActive('users.php', $current) ?>" href="users.php">
                <i class="fas fa-users me-3"></i> Users
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse" href="#settingsSubmenu" role="button">
                <span><i class="fas fa-cogs me-3"></i> Settings</span>
                <i class="fas fa-chevron-down small opacity-50"></i>
            </a>
            <div class="collapse" id="settingsSubmenu">
                <ul class="nav flex-column ms-4 mt-1 border-start border-secondary">
                    <li class="nav-item">
                        <a class="nav-link py-2 text-white-50" href="phase-requirements.php">Phase Requirements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 text-white-50" href="project-status.php">Project Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link py-2 text-white-50" href="#">Technologies</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item mt-auto">
            <a class="nav-link mt-5 text-white-50" href="utilities/logout.php">
                <i class="fas fa-sign-out-alt me-3"></i> Logout
            </a>
        </li>
    </ul>
</nav>