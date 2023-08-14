<?php
// Include config file
require_once "../config.php";

// Check if the table_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the table_id from the URL and sanitize it
    $table_id = intval($_GET['id']);

    // Remove or update related records in referencing table(s)
    // For example, assuming a referencing table named 'Reservations'
    $deleteReservationsSQL = "DELETE FROM Reservations WHERE table_id = ?";
    if ($stmt = mysqli_prepare($link, $deleteReservationsSQL)) {
        mysqli_stmt_bind_param($stmt, "i", $table_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Construct the DELETE query with a parameterized query
    $deleteSQL = "DELETE FROM Restaurant_Tables WHERE table_id = ?";

    // Prepare and execute the DELETE query
    if ($stmt = mysqli_prepare($link, $deleteSQL)) {
        mysqli_stmt_bind_param($stmt, "i", $table_id);
        if (mysqli_stmt_execute($stmt)) {
            // Table successfully deleted, redirect back to the main page
            header("location: ../panel/table-panel.php");
            exit();
        } else {
            // Error occurred during execution, display an error message
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        // Error occurred while preparing the statement
        echo "Error: " . mysqli_error($link);
    }

    // Close the connection
    mysqli_close($link);
}
?>
