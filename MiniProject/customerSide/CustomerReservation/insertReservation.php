<?php
// reservation.php
require_once 'config.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $customer_name = $_POST["customer_name"];
    $table_id = intval($_POST["table_id"]);
    $reservation_time = $_POST["reservation_time"];
    $reservation_date = $_POST["reservation_date"];
    $special_request = $_POST["special_request"];
    
    $select_query_capacity = "SELECT capacity FROM restaurant_tables WHERE table_id='$table_id';";
    $results_capacity = mysqli_query($link, $select_query_capacity);

    if ($results_capacity) {
        $row = mysqli_fetch_assoc($results_capacity);
        $head_count = $row['capacity'];

        $reservation_id = intval($reservation_time)  . intval($reservation_date)  . intval($table_id);

        // Prepare the SQL query for insertion
        $insert_query1 = "INSERT INTO Reservations (reservation_id, customer_name, table_id, reservation_time, reservation_date, head_count, special_request) 
                        VALUES ('$reservation_id', '$customer_name', '$table_id', '$reservation_time', '$reservation_date', '$head_count', '$special_request');";
        $insert_query2 = "INSERT INTO Table_Availability (availability_id, table_id, reservation_date, reservation_time, status) 
                        VALUES ('$reservation_id', '$table_id', '$reservation_date', '$reservation_time',  'no');";
        mysqli_query($link, $insert_query1);
        mysqli_query($link, $insert_query2);

        $_SESSION['customer_name'] = $customer_name;
        header("Location: reservePage.php?reservation=success&reservation_id=$reservation_id");
    } else {
        // Handle the case where the query failed
        echo "Error fetching table capacity: " . mysqli_error($link);
    }
}
?>
