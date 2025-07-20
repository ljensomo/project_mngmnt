<?php 
    session_start();

    require_once 'utilities/utilities.php';

    if (!hasValidSession()) {
        $_SESSION['access_error'] = true;
        header("Location: login.php");
    }
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Project Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="projects.php">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="utilities/logout.php">Logout</a>
                </li>
            </ul>
            <span class="navbar-text">
                Logged in as: 
                <strong>
                    <?php echo $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']; ?>
                </strong>
            </span>
        </div>
    </div>
</nav>