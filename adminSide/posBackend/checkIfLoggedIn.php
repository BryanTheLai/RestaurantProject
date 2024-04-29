<?php 
// session_start();
if(!isset($_SESSION['logged_account_id'])) {
    header("Location: ../StaffLogin/login.php");
}
?>