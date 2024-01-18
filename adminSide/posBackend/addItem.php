<?php
require_once '../config.php';

if (isset($_GET['addToCart'])) {
    $bill_id = intval($_GET['bill_id']);
    $item_id = $_GET['item_id'];
    $quantity = intval($_GET['quantity']);
    $table_id = $_GET['table_id'];
    $currentTime = date('Y-m-d H:i:s'); // Current time

    $select_sql = "SELECT * FROM bill_items WHERE bill_id = '$bill_id' AND item_id = '$item_id'";
    $result = mysqli_query($link, $select_sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Record exists, update quantity
            $update_quantity_sql = "UPDATE bill_items SET quantity = quantity + $quantity WHERE bill_id = '$bill_id' AND item_id = '$item_id'";
            if (mysqli_query($link, $update_quantity_sql)) {
                // Update the Kitchen table too
                $update_kitchen_sql = "UPDATE Kitchen SET quantity = quantity + $quantity, time_submitted = '$currentTime' WHERE table_id = '$table_id' AND item_id = '$item_id'";
                mysqli_query($link, $update_kitchen_sql);

                echo '<script>alert("Quantity updated successfully")</script>';
                header("Location: orderItem.php?bill_id=" . urlencode($bill_id) . "&table_id=" . $table_id);
            } else {
                echo '<script>alert("Error updating quantity: ' . mysqli_error($link) . '")</script>';
            }
        } else {
            // Record doesn't exist, insert new record
            $insert_item_sql = "INSERT INTO bill_items (bill_id, item_id, quantity) VALUES ('$bill_id', '$item_id', '$quantity')";
            $insert_kitchen_sql = "INSERT INTO Kitchen (table_id, item_id, quantity, time_submitted) VALUES ('$table_id', '$item_id', '$quantity', '$currentTime')";

            if (mysqli_query($link, $insert_item_sql) && mysqli_query($link, $insert_kitchen_sql)) {
                echo '<script>alert("Item added to cart successfully")</script>';
                header("Location: orderItem.php?bill_id=" . urlencode($bill_id) . "&table_id=" . $table_id);
            } else {
                echo '<script>alert("Error adding item to cart: ' . mysqli_error($link) . '")</script>';
            }
        }
    } else {
        echo '<script>alert("Error checking bill item: ' . mysqli_error($link) . '")</script>';
    }
}
?>
