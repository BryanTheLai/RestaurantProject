<?php
require_once '../config.php';

if (isset($_GET['bill_item_id'])) {
    $bill_item_id = $_GET['bill_item_id'];
    
    // Delete the item with the given bill_item_id
    $delete_query = "DELETE FROM bill_items WHERE bill_item_id = '$bill_item_id'";
    
    if (mysqli_query($link, $delete_query)) {
        // Redirect back to the orderItem.php page with a success message
        header("Location: orderItem.php?bill_id={$_GET['bill_id']}&delete_success=1");
        exit();
    } else {
        // Redirect back to the orderItem.php page with an error message
        header("Location: orderItem.php?bill_id={$_GET['bill_id']}&delete_error=1");
        exit();
    }
} else {
    // Redirect back to the orderItem.php page if bill_item_id is not provided
    header("Location: orderItem.php?bill_id={$_GET['bill_id']}");
    exit();
}
?>
