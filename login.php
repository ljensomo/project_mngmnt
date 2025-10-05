<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PMS</title>

    <?php include 'includes/css-assets.html'; ?>
    <style>
        body {
            /* background: linear-gradient(to right, #0d6efd, #6610f2); */
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            /* background-color: #fff; */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .login-card h4 {
            font-weight: bold;
            /* color: #0d6efd; */
        }

        .btn-block {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                session_start();
                if (isset($_SESSION['access_error'])) {
                    echo '<div class="alert alert-danger" role="alert">Access denied. Please log in.</div>';
                    unset($_SESSION['access_error']);
                }
                ?>
                <div class="card login-card">
                    <div class="card-header text-center">
                        <h4>Login | Project Mangement System</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="login-form">
                            <div class="mb-3">
                                <label for="username" class="form-label"><i class="fas fa-user"></i> Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        Developed by LJ Ensomo
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/js-assets.html'; ?>
    <script src="assets/js/login.js"></script>
</body>

</html>