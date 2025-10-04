<?php 
    session_start();

    require_once 'utilities/utilities.php';

    if (!hasValidSession()) {
        $_SESSION['access_error'] = true;
        header("Location: login.php");
    }
?>
<nav class="navbar navbar-light navbar-expand-lg shadow-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Project Management System</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
      <span class="navbar-text text-white ms-auto">
        <i class="fas fa-user-circle me-1"></i> Logged in: 
        <strong class="active-text">
          <?php echo $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']; ?>
        </strong>
      </span>
    </div>
  </div>
</nav>

