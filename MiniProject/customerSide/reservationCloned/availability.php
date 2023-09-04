<?php
// availability.php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_GET["reservation_date"];
    $head_count = $_GET["head_count"];
    $selectedTime = $_GET["reservation_time"];

    // Query to get the count of reservations for each reservation time on the selected date
    $countQuery = "SELECT reservation_time, COUNT(*) as count FROM reservations WHERE reservation_date = '$selectedDate' GROUP BY reservation_time";
    $countResult = mysqli_query($link, $countQuery);

    if ($countResult) {
        if (count($availableTimes) > 0) {
            // Now, let's query the available tables
            $tableQuery = "SELECT table_id FROM Restaurant_tables WHERE capacity >= $head_count";
            $tableResult = mysqli_query($link, $tableQuery);

            if ($tableResult) {
                $availableTables = array();
                while ($tableRow = mysqli_fetch_assoc($tableResult)) {
                    $tableId = $tableRow['table_id'];
                    // Check if the table is available at the selected date and time
                    $tableAvailabilityQuery = "SELECT COUNT(*) as count FROM reservations WHERE reservation_date = '$selectedDate' AND reservation_time IN ('" . implode("', '", $availableTimes) . "') AND table_id = $tableId";
                    $tableAvailabilityResult = mysqli_query($link, $tableAvailabilityQuery);
                    if ($tableAvailabilityResult) {
                        $tableAvailabilityRow = mysqli_fetch_assoc($tableAvailabilityResult);
                        if ($tableAvailabilityRow['count'] == 0) {
                            $availableTables[] = $tableId;
                        }
                    }
                }

                if (count($availableTables) > 0) {
                    // Now, redirect with available times and available table IDs
                    header("Location: reservePage.php?head_count=" . $head_count . "&reservation_date=" . urlencode($selectedDate) . "&available_times=" . urlencode(implode(",", $availableTimes)) . "&tables_booked=" . urlencode(implode(",", $availableTables)));
                    exit();
                } else {
                    $message = "No available tables for $head_count people on '$selectedDate' at '$selectedTime'.";
                    header("Location: reservePage.php?head_count=" . $head_count . "&message=" . urlencode($message));
                    exit();
                }
            }
        } else {
            $message = "No available reservation times on '$selectedDate'.";
            header("Location: reservePage.php?head_count=" . $head_count . "&message=" . urlencode($message));
            exit();
        }
    }
}

?>
