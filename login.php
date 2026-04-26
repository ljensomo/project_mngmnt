<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PMS</title>

    <?php include 'includes/css-assets.html'; ?>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            
            <?php if (isset($_SESSION['access_error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> Access denied. Please log in.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['access_error']); ?>
                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-lg overflow-hidden">
                <div class="card-header bg-primary text-white text-center py-4 border-0">
                    <h4 class="mb-0 fw-bold">Project Management System</h4>
                    <small class="opacity-75">Secure Access Portal</small>
                </div>
                
                <div class="card-body p-4">
                    <form action="" method="POST" id="login-form">
                        <div class="mb-3">
                            <label for="username" class="form-label text-muted small fw-bold text-uppercase">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-primary"></i></span>
                                <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label text-muted small fw-bold text-uppercase">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-primary"></i></span>
                                <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="••••••••" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold text-uppercase shadow-sm">
                            Login to System
                        </button>
                    </form>
                </div>
                
                <div class="card-footer bg-light text-center py-3 border-0">
                    <small class="text-muted">System Developed by <strong>LJ Ensomo</strong></small>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/js-assets.html'; ?>
    <script src="assets/js/login.js"></script>
</body>

</html>