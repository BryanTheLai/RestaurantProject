<?php
require_once '../config.php'; // Include your database configuration

if (isset($_GET['new_customer']) && $_GET['new_customer'] === 'true') {
    // Retrieve the passed table_id
    $table_id = $_GET['table_id'];

    // Get the current date and time
    $bill_time = date('Y-m-d H:i:s');

    // Insert into the Bills table
    $insertQuery = "INSERT INTO Bills (table_id, bill_time) VALUES ('$table_id', '$bill_time')";

    if ($link->query($insertQuery) === TRUE) {
        $bill_id = $link->insert_id; // Get the inserted bill_id
        echo "Welcome to our restaurant! You're now seated at Table ID: $table_id";
        echo "<br>Your bill has been created with Bill ID: $bill_id";
        echo '<br><a href="orderItem.php?bill_id=' . $bill_id . '&table_id=' . $table_id . '" class="btn btn-primary">Back</a>';

    } else {
        echo "Error inserting data into Bills table: " . $link->error;
    }
}
?>
