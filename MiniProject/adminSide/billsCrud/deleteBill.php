<?php
// Include config file
require_once "../config.php";

// Check if the member_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the member_id from the URL and sanitize it
    $account_id = intval($_GET['id']);

    // Construct the DELETE query with a parameterized query
    $deleteSQL = "DELETE FROM bills WHERE bill_id = ?";

    // Prepare the DELETE query
    if ($stmt = mysqli_prepare($link, $deleteSQL)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $account_id);

        // Execute the DELETE query
        if (mysqli_stmt_execute($stmt)) {
            // Membership successfully deleted, redirect back to the main page
            header("location: ../panel/bill-panel.php");
            exit();
        } else {
            // Error occurred during execution, display an error message
            echo "Error: " . mysqli_error($link);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error occurred while preparing the statement
        echo "Error: " . mysqli_error($link);
    }

    // Close the connection
    mysqli_close($link);
}
?>
