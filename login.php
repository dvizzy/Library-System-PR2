<?php
include "connect.php";

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['sign'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to fetch user data
    $viewlogin = "SELECT * FROM tbl_admin WHERE username = ?";
    $stmt = $conn->prepare($viewlogin);
    
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the username exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Assuming the password is stored in a hashed format in the database
        if (password_verify($password, $user['password'])) {
            // Start the session and set session variables
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            // Redirect to the sidebar page
            header("Location: ../sidebar/sidebar.php");
            exit();
        } else {
            // Password mismatch
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToastMessage('Incorrect password.');
                });
            </script>";
        }
    } else {
        // Username not found
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showToastMessage('Username is not Registered.');
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="photo/pcu.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
        body {
            width: 100%;
            height: 100vh;
            background-image: url("photo/ctto-pitikera.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .password-container {
        position: relative;
    }
    .password-container i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2em;
        color: #6c757d;
    }
        /* Existing styles */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            background-color: #002253;
            width: 100px;
            border-radius: 25px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            color: white;
            background-color:#133463;
        }

        .forgot-password {
            color: #5d6d7e;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .exit-logo {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 30px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.7);
            padding: 5px 10px;
            border-radius: 50%;
            transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }
        
        .exit-logo:hover {
            color: #133463;
            background: rgba(255, 255, 255, 0.9);
        }

        .exit-logo:active {
            transform: scale(0.95);
        }

        .countdown {
            margin-top: 10px;
            color:red;
            font-weight: bold;
        }

        .toast-header {
            background-color: red;
            color: white;
            /* Optional: make the text color white for better readability */
        }

    </style>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-lg-6 d-none d-lg-block illustration-container">
                <div class="d-flex flex-column justify-content-center align-items-center h-100">
                    <img src="photo/pcu.png" class="img-fluid" alt="Logo" style="max-width: 230px;">
                    <p class="illustration-text mt-4">Philippine Christian University - Dasmarinas Cavite </p>
                    <p class="illustration-subtext">Library Management System </p>
                </div>
            </div>

            <div
                class="col-lg-6 login-form-container d-flex align-items-center justify-content-center position-relative">
                <a href="login.php" class="exit-logo">&times;</a>
                <div class="w-75">
                    <h1 class="brand-name">Welcome to Library System</h1>
                    <h3 class="welcome-text">Admin Login</h3>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control custom-input" name="username"
                                placeholder="Enter your username" required>
                        </div>
                      

                        <div class="mb-3">
                            <label>Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control custom-input" name="password" id="pass" placeholder="Enter your password" required>
                                <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                            </div>
                        </div>

                        <div style="text-align:center; margin-top: 10px;">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"
                                class="forgot-password">Forgot Password?</a>
                            <button type="submit" class="btn" name="sign">Sign in</button>
                            <div id="countdown" class="countdown"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>No worries. We'll send you reset instructions.</p>
                    <form method="POST" action="forgot_password.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        function showToastMessage(message) {
            const toastMessage = document.getElementById('toastMessage');
            toastMessage.innerHTML = message;

            const toastElement = new bootstrap.Toast(document.getElementById('liveToast'));
            toastElement.show();
        }
        function startCountdown(duration) {
            var countdownElement = document.getElementById('countdown');
            var endTime = Date.now() + duration * 1000;

            function updateCountdown() {
                var remainingTime = Math.max(0, endTime - Date.now());
                var seconds = Math.floor((remainingTime / 1000) % 60);
                var minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
                var hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);

                if (remainingTime <= 0) {
                    countdownElement.textContent = '';
                    return;
                }

                countdownElement.textContent =
                    (hours > 0 ? hours + 'h ' : '') +
                    (minutes > 0 ? minutes + 'm ' : '') +
                    seconds + 's';
                setTimeout(updateCountdown, 1000);
            }

            updateCountdown();
        }
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('pass');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
