<?php
// Initialize the session
require_once '../config.php';
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
    <?php
    header("location: ../home/home.php"); // Redirect to the home page
    exit;
?>
</body>
</html>
