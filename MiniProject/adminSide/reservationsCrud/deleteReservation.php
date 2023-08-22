<?php
// Include config file
require_once "../config.php";

// Check if the item_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the reservation_id from the URL and sanitize it
    $reservation_id = intval($_GET['id']);

    // Construct the DELETE query
    $deleteSQL = "DELETE FROM Reservations WHERE reservation_id = ?";

    // Prepare the DELETE query
    $deleteStmt = $link->prepare($deleteSQL);
    $deleteStmt->bind_param("i", $reservation_id);

    // Execute the DELETE query
    if ($deleteStmt->execute()) {
        // Item successfully deleted, redirect back to the main page
        header("location: ../panel/reservation-panel.php");
        exit();
    } else {
        // Error occurred during execution, display an error message
        echo "Error: " . $deleteStmt->error;
    }

    // Close the statement
    $deleteStmt->close();
    
    // Close the connection
    $link->close();
}
?>
