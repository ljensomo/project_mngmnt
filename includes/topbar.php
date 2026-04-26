<?php
session_start();

require_once 'utilities/utilities.php';

if (!hasValidSession()) {
  $_SESSION['access_error'] = true;
  header("Location: login.php");
}
?>
<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Project Management System</a>

    <div class="d-flex align-items-center">
      <div class="user-profile-pill">
        <i class="fas fa-user-circle me-2 text-primary"></i>
        <span>Logged in: </span>
        <strong class="text-dark">
          <?php echo htmlspecialchars($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']); ?>
        </strong>
      </div>
    </div>
  </div>
</nav>