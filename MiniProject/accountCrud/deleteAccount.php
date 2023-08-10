<?php
// Include config file
require_once "../config.php";

// Check if the member_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the member_id from the URL and sanitize it
    $member_id = intval($_GET['id']);

    // Construct the DELETE query
    $deleteSQL = "DELETE FROM Accounts  WHERE account_id  = $account_id";

    // Execute the DELETE query
    if (mysqli_query($link, $deleteSQL)) {
        // Membership successfully deleted, redirect back to the main page
        header("location: ../panel/account-panel.php");
        exit();
    } else {
        // Error occurred during execution, display an error message
        echo "Error: " . mysqli_error($link);
    }

    // Close the connection
    mysqli_close($link);
}
?>
