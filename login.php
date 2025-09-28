<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php include 'includes/css-assets.html'; ?>
    <style>
        body {
            background: linear-gradient(to right, #0d6efd, #6610f2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .login-card h4 {
            font-weight: bold;
            color: #0d6efd;
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
                <div class="text-center mb-4">
                    <h1 class="text-white fw-bold text-uppercase">Project Management</h1>
                </div>

                <div class="card login-card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="login-form">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/js-assets.html'; ?>
    <script src="assets/login.js"></script>
</body>

</html>