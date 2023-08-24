<?php
// availability.php
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = $_POST["reservation_date"];
    $head_count = $_POST["head_count"];

    // Query to get the count of reservations for each reservation time on the selected date
    $countQuery = "SELECT reservation_time, COUNT(*) as count FROM reservations WHERE reservation_date = '$selectedDate' GROUP BY reservation_time";
    $countResult = mysqli_query($link, $countQuery);

    if ($countResult) {
        $reservedTimesExceedingLimit = array();
        while ($row = mysqli_fetch_assoc($countResult)) {
            if ($row['count'] >= 3) {
                $reservedTimesExceedingLimit[] = $row['reservation_time'];
            }
        }

        // Generate all possible reservation times from 10:00 to 20:00
        $availableTimes = array();
        for ($hour = 10; $hour <= 20; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 60) {
                $time = sprintf('%02d:%02d:00', $hour, $minute);
                if (!in_array($time, $reservedTimesExceedingLimit)) {
                    $availableTimes[] = $time;
                }
            }
        }

        if (count($availableTimes) > 0) {
            $availableTimesQueryParam = implode(",", $availableTimes);
            header("Location: createReservation.php?head_count=" . $head_count . "&reservation_date=" . urlencode($selectedDate) . "&available_times=" . urlencode($availableTimesQueryParam));
            exit();
        } else {
            $message = "No available reservation times on '$selectedDate'.";
            header("Location: createReservation.php?head_count=" . $head_count . "&message=" . urlencode($message));
            exit();
        }
    }
}

?>