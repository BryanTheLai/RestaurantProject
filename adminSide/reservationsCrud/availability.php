<?php
// availability.php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selectedDate = $_GET["reservation_date"]; // Selected Date
    $head_count = $_GET["head_count"];  // Number of people
    $selectedTime = date("H:i:s", strtotime($_GET["reservation_time"]));

    // Query to get all reservations for the selected date and time
    $reservedQuery = "SELECT * FROM reservations WHERE reservation_date = '$selectedDate' AND reservation_time = '$selectedTime'";
    $reservedResult = mysqli_query($link, $reservedQuery);

    // Initialize an array to store reserved table IDs
    $reservedTableIDs = array();

    // Collect reserved table IDs
    if ($reservedResult) {
        while ($row = mysqli_fetch_assoc($reservedResult)) {
            $reservedTableIDs[] = $row["table_id"];
            // Print each row of data
            echo "Reservation Time: " . $row["reservation_time"] . "<br>";
            echo "Reservation ID: " . $row["reservation_id"] . "<br>";
            echo "Table ID: " . $row["table_id"] . "<br>";
            echo "Reservation Date: " . $row["reservation_date"] . "<br>";
            echo "Head Count: " . $row["head_count"] . "<br>";
            echo "<br>"; // Add spacing between rows
        }
    } else {
        echo "Query failed: " . mysqli_error($link);
    }

    // Check available tables
    if (!empty($reservedTableIDs)) {
        $reservedTableIDsString = implode(",", $reservedTableIDs);
        $availableTables = "SELECT table_id, capacity FROM restaurant_tables WHERE capacity >= '$head_count' AND table_id NOT IN ($reservedTableIDsString)";
        $availableResult = mysqli_query($link, $availableTables);

        if ($availableResult) {
            while ($row = mysqli_fetch_assoc($availableResult)) {
                echo "Available Table ID: " . $row["table_id"] . "<br>";
                echo "Capacity: " . $row["capacity"] . "<br>";
                
            }
            // Construct the reservation link with all table IDs
            $reservedTableIDsString = implode(",", $reservedTableIDs);
            $reservationLink = "createReservation.php?reservation_date=$selectedDate&head_count=$head_count&reservation_time=$selectedTime&reserved_table_id=$reservedTableIDsString";

            // Add header link to reservationPage.php with parameters
            header("Location: $reservationLink");
            exit();
        } else {
            echo "Available tables query failed: " . mysqli_error($link);
        }
    } else {
        $reservationLink = "createReservation.php?reservation_date=$selectedDate&head_count=$head_count&reservation_time=$selectedTime&reserved_table_id=0";
        header("Location: $reservationLink");
    }
    

}
?>