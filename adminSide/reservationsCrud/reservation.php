<?php
// Assuming you have already established a database connection

// reservation.php
require_once '../config.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $customer_name = $_POST["customer_name"];
    $table_id = intval($_POST["table_id"]);
    $reservation_time = $_POST["reservation_time"];
    $reservation_date = $_POST["reservation_date"];
    $head_count = $_POST["head_count"];
    $special_request = $_POST["special_request"];
    $reservation_id = $customer_name . "_" . $reservation_date . "_" . $head_count;

    // Prepare the SQL query for insertion
    $insert_query1 = "INSERT INTO Reservations (reservation_id, customer_name, table_id, reservation_time, reservation_date, head_count, special_request) 
                    VALUES ('$reservation_id', '$customer_name', '$table_id', '$reservation_time', '$reservation_date', '$head_count', '$special_request');"; // Change "Menu" to "Reservations"
    $insert_query2 = "INSERT INTO Table_Availability (availability_id, table_id, reservation_date, reservation_time, status) 
                    VALUES ('$reservation_id', '$table_id', '$reservation_date', '$reservation_time',  'no');";
    mysqli_query($link, $insert_query1);
    mysqli_query($link, $insert_query2);

    $_SESSION['customer_name'] = $customer_name;
    
    header("Location: success_create_reserve.php");
}
?>

