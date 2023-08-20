<?php
// availability.php
require_once 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST["reservation_date"];
    $select_query = "SELECT reservation_time FROM Table_Availability WHERE reservation_date = '$selectedDate'";
    $result = mysqli_query($link, $select_query);
    
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

        if (count($availableTimes) > 0) {
            $availableTimesQueryParam = implode(",", $availableTimes);
            header("Location: reserve.php?reservation_date=" . urlencode($selectedDate) . "&available_times=" . urlencode($availableTimesQueryParam));
            exit();
        } else {
            $message = "No available reservation times on '$selectedDate'.";
            header("Location: reserve.php?message=" . urlencode($message));
            exit();
        }
    }
}
?>
