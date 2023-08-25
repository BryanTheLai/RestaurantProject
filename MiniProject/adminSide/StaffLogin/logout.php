<?php
// Initialize the session
require_once "config.php";
session_start();

// Check if the user is already logged out
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect to home page
    header("Location: ../home/home.php");
    exit;
}

// Unset custom cookies (change cookie_name to the actual name of your custom cookie)
setcookie('cookie_name', '', time() - 3600, '/');

// Clear session data
$_SESSION = array();
session_destroy();

// Prevent caching
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <!-- Custom CSS styles for the alert box -->
    <style>
        .alert-box {
            max-width: 300px;
            margin: 0 auto;
        }

        .alert-icon {
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Replace the alert box div with PHP code -->
        <?php echo '
        <div class="alert-box" style="float: none; margin: 0 auto;">
            <div class="alert alert-success">
                <div class="alert-icon text-center">
                    <i class="fa fa-check-square-o fa-3x" aria-hidden="true"></i>
                </div>
                <div class="alert-message text-center">
                    <strong>Success!</strong> Thank you for signing up.
                </div>
            </div>
        </div>
        '; ?>
    </div>

    <div style="text-align: center; margin-top: 20px;">Redirecting in <span id="countdown">3</span></div>
    <script>
        function countdown() {
            var i = 3;
            var countdownElement = document.getElementById("countdown");
            var countdownInterval = setInterval(function() {
                i--;
                countdownElement.textContent = i;
                if (i <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "../home/home.php";
                }
            }, 1000); // 1000 milliseconds = 1 second
        }
        window.onload = countdown;
    </script>
</body>
</html>
