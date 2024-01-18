<?php
require_once '../config.php';

$bill_id = $_POST['bill_id'];
$item_id = $_POST['item_id'];

// Check if the item already exists in the bill_items table
$existingItemQuery = "SELECT * FROM Bill_Items WHERE bill_id = $bill_id AND item_id = '$item_id'";
$existingItemResult = mysqli_query($link, $existingItemQuery);

if (mysqli_num_rows($existingItemResult) > 0) {
    // Item already exists, increase the quantity
    $updateQuantityQuery = "UPDATE Bill_Items SET quantity = quantity + 1 WHERE bill_id = $bill_id AND item_id = '$item_id'";
    mysqli_query($link, $updateQuantityQuery);
} else {
    // Item doesn't exist, create a new bill item
    $insertItemQuery = "INSERT INTO Bill_Items (bill_id, item_id, quantity) VALUES ($bill_id, '$item_id', 1)";
    mysqli_query($link, $insertItemQuery);
}

// Close connection
mysqli_close($link);
?>
