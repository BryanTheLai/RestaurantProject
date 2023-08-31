<?php
require_once '../../config.php';
//echo '<a href="kitchenBackend/kitchen-panel-back.php?action=set_time_ended&kitchen_id=' . $kitchen_id . '" class="btn btn-danger">Set Time Ended</a>';

// Handle setting time_ended and undo actions
if (isset($_GET['action']) && isset($_GET['kitchen_id'])) {
    $action = $_GET['action'];
    $kitchen_id = $_GET['kitchen_id'];
    
    if ($action === 'set_time_ended') {
        $currentTime = date('Y-m-d H:i:s');
        $updateQuery = "UPDATE Kitchen SET time_ended = '$currentTime' WHERE kitchen_id = $kitchen_id";
        if ($link->query($updateQuery) === TRUE) {
            header("Location: ../../panel/kitchen-panel.php"); // Redirect back to kitchen panel

            
        } else {
            // Error updating time_ended
            echo "Error updating time_ended: " . $link->error;
        }
        
    }
}

/*
if (isset($_GET['UndoUnshow'])) {
        $selectQuery = "SELECT kitchen_id FROM Kitchen WHERE  ORDER BY time_ended DESC";

        $selectResult = $link->query($selectQuery);
        if ($selectResult && $selectResult->num_rows > 0) {
            $row = $selectResult->fetch_assoc();
            $time_submitted = $row['time_submitted'];
            $updateQuery = "UPDATE Kitchen SET time_ended = NULL WHERE time_submitted = '$time_submitted'";
            if ($link->query($updateQuery) === TRUE) {
                // Time ended undone successfully
            } else {
                // Error undoing time_ended
            }
        }
    }
 * 
 */


?>