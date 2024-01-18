<?php
// Include config file
require_once "../config.php";

// Check if the account_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the account_id from the URL and sanitize it
    $account_id = intval($_GET['id']);

    // Disable foreign key checks
    $disableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=0;";
    mysqli_query($link, $disableForeignKeySQL);

    // Construct the DELETE query with a parameterized query
    $deleteSQL = "DELETE FROM Accounts WHERE account_id = ?";

    // Prepare the DELETE query
    if ($stmt = mysqli_prepare($link, $deleteSQL)) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $account_id);

        // Execute the DELETE query
        if (mysqli_stmt_execute($stmt)) {
            // Account successfully deleted, redirect back to the main page
            header("location: ../panel/account-panel.php");
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

    // Enable foreign key checks
    $enableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=1;";
    mysqli_query($link, $enableForeignKeySQL);

    // Close the connection
    mysqli_close($link);
}
?>
