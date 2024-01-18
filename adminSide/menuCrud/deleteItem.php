<?php
// Include config file
require_once "../config.php";

// Check if the item_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the item_id from the URL and sanitize it
    $item_id = intval($_GET['id']);

    // Disable foreign key checks
    $disableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=0;";
    mysqli_query($link, $disableForeignKeySQL);

    // Construct the DELETE query
    $deleteSQL = "DELETE FROM Menu WHERE item_id = '" . $_GET['id'] . "';";

    // Execute the DELETE query
    if (mysqli_query($link, $deleteSQL)) {
        // Item successfully deleted, redirect back to the main page
        header("location: ../panel/menu-panel.php");
        echo 'deleted';
        exit();
    } else {
        // Error occurred during execution, display an error message
        echo "Error: " . mysqli_error($link);
    }

    // Enable foreign key checks
    $enableForeignKeySQL = "SET FOREIGN_KEY_CHECKS=1;";
    mysqli_query($link, $enableForeignKeySQL);

    // Close the connection
    mysqli_close($link);
}
?>
