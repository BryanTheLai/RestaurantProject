<?php
// availability.php
require_once 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST["reservation_date"];
    $head_count = $_POST["head_count"];
    $select_query = "SELECT reservation_time FROM Table_Availability WHERE reservation_date = '$selectedDate'";
    $select_table_fit_capacity = "SELECT table_id FROM restaurant_tables WHERE capacity > '$head_count'";

    $result = mysqli_query($link, $select_query);
    $result_table = mysqli_query($link, $select_table_fit_capacity);
    if ($result) {
        
        
        $reservedTimes = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $reservedTimes[] = $row['reservation_time'];
        }

        // Generate all possible reservation times from 10:00 to 20:00
        $availableTimes = array();
        for ($hour = 10; $hour <= 20; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 60) {
                $time = sprintf('%02d:%02d:00', $hour, $minute);
                if (!in_array($time, $reservedTimes)) {
                    $availableTimes[] = $time;
                }
            }
        }
        
        //tableid start
        $selectedTable = $result_table;
        //if $result_table is 1
        //Select * FROM TableAvailability Where reservation_date = '$result' AND table_id = '$result_table';
        //tableid end

        if (count($availableTimes) > 0) {
            $availableTimesQueryParam = implode(",", $availableTimes);
            header("Location: reserve.php?head_count=" . $head_count . "&reservation_date=" . urlencode($selectedDate) . "&available_times=" . urlencode($availableTimesQueryParam));
            exit();
        } else {
            $message = "No available reservation times on '$selectedDate'.";
            header("Location: reserve.php?head_count=" . $head_count . "&message=" . urlencode($message));
            exit();
        }
    }
}
?>
