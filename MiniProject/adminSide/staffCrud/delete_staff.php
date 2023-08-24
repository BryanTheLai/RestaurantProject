<?php
// Include config file
require_once "../config.php";

// Check if the staff_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the staff_id from the URL and sanitize it
    $staff_id = intval($_GET['id']);

    // Construct the DELETE query
    $deleteSQL = "DELETE FROM Staffs WHERE staff_id = ?";

    // Prepare the DELETE query
    $stmt = $link->prepare($deleteSQL);
    
    // Bind the parameter
    $stmt->bind_param("i", $staff_id);

    // Execute the DELETE query
    if ($stmt->execute()) {
        // Staff member successfully deleted, redirect back to the main page
        header("location: ../panel/staff-panel.php");
        exit();
    } else {
        // Error occurred during execution, display an error message
        echo "Have to delete account who using this staff_id in Account first!";
        echo "Error: " . $stmt->error;
    }

    // Close the statements
    $stmt->close();

    // Close the connection
    $link->close();
}
?>
