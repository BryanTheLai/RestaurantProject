<?php
// Include config file
require_once "../config.php";

// Check if the member_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the member_id from the URL and sanitize it
    $member_id = intval($_GET['id']);

    // Disable foreign key checks
    $disableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=0;";
    mysqli_query($link, $disableForeignKeySQL);

    // Construct the DELETE query
    $deleteSQL = "DELETE FROM Memberships WHERE member_id = ?";

    // Prepare the DELETE query
    $stmt = $link->prepare($deleteSQL);
    $stmt->bind_param("i", $member_id);

    // Execute the DELETE query
    if ($stmt->execute()) {
        // Membership successfully deleted, redirect back to the main page
        header("location: ../panel/customer-panel.php");
        exit();
    } else {
        // Error occurred during execution, display an error message
        echo "Error: " . $stmt->error;
    }

    // Enable foreign key checks
    $enableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=1;";
    mysqli_query($link, $enableForeignKeySQL);

    // Close the statement
    $stmt->close();

    // Close the connection
    mysqli_close($link);
}
?>
