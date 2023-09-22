<?php
require_once '../../config.php';

// Select the latest record from Kitchen
$selectQuery = "SELECT kitchen_id FROM Kitchen WHERE time_ended IS NOT NULL ORDER BY time_ended DESC LIMIT 1";
$result = $link->query($selectQuery);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kitchen_id = $row['kitchen_id'];

    // Update the record to set time_ended as NULL
    $updateQuery = "UPDATE Kitchen SET time_ended = NULL WHERE kitchen_id = $kitchen_id";
    if ($link->query($updateQuery) === TRUE) {
        // Time ended undone successfully
        header("Location: ../../panel/kitchen-panel.php"); // Redirect back to kitchen panel
        exit();
    } else {
        // Error undoing time_ended
        echo "Error undoing time_ended: " . $link->error;
    }
} else {
    // No records with time_ended set
    echo "No records available to undo.";
    echo '<a class="btn btn-danger" href="javascript:window.history.back();">Back</a>';
}
?>
