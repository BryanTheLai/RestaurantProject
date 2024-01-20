<?php
require_once '../config.php';

// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <title>Customer Reservation </title>
    <style>
        /* Apply background image to the body */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: rgb(37, 42, 52);    
            display: flex;
            color: white;
            justify-content: center; /* Center the container horizontally */
            align-items: center; /* Center the container vertically */
            height: 100vh; /* Ensure the container takes up the full viewport height */
        }
        .reserve-container {
            max-width: 36.4em;
        }
        .column {
            padding: 10px;
            text-align: left;
            width: 36.4em;
            flex-basis: 50%; /* Adjust the width of the columns as needed */
           
        }

            
    </style>
</head>
<body>
    <?php
        $reservationStatus = $_GET['reservation'] ?? null;
        $message = '';
        if ($reservationStatus === 'success') {
            $message = "Reservation successful";
            $reservation_id = $_GET['reservation_id'] ?? null;
            echo '<a class="nav-link" href="../home/home.php#hero">' .
            '<h1 class="text-center" style="font-family: Copperplate; color: whitesmoke;">JOHNNY\'S</h1>' .
            '<span class="sr-only"></span></a>';
            echo '<script>alert("Table Successfully Reserved. Click OK to view your reservation receipt."); window.location.href = "reservationReceipt.php?reservation_id=' . $reservation_id . '";</script>';

        }
        $head_count = $_GET['head_count'] ?? 1;
    ?>
    <div class="member-info"></div>
    <div class="reserve-container">
        <a class="nav-link" href="../home/home.php#hero">
            <h1 class="text-center" style="font-family: Copperplate; color: whitesmoke;">JOHNNY'S</h1>
            <span class="sr-only"></span>
        </a>

        <div class="row">
            <div class="column">
                <div id="Search Table">
                    <h2 style=" color:white;">Search for Time</h2>
                 
                    <form id="reservation-form" method="GET" action="availability.php"><br>
                        <div class="form-group">
                        <label for="reservation_date" style="">Select Date</label><br>
                        <input class="form-control" type="date" id="reservation_date" name="reservation_date" required>
                        </div>
                        <div class="form-group">
                        <label for="reservation_time" style="">Available Reservation Times</label>
                        <div id="availability-table">
                            <?php
                            $availableTimes = array();
                            for ($hour = 10; $hour <= 20; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $time = sprintf('%02d:%02d:00', $hour, $minute);
                                    $availableTimes[] = $time;
                                }
                            }
                            echo '<select name="reservation_time" id="reservation_time" style="width:10em;" class="form-control" >';
                            echo '<option value="" selected disabled>Select a Time</option>';
                            foreach ($availableTimes as $time) {
                                echo "<option  value='$time'>$time</option>";
                            }
                            echo '</select>';
                            if (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo "<p>$message</p>";
                            }
                            ?>
                        </div>
                        </div>
              
                        <input type="number" id="head_count" name="head_count" value=1 hidden required>
                        <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn" name="submit" >Search</button>
                    </form>
                </div>
            </div>

            <div class="column right-column">
                <div id="insert-reservation-into-table">
                    <h2 style=" color:white;">Make Reservation</h2>
                    <form id="reservation-form" method="POST" action="insertReservation.php">
                        <br>
                        <div class="form-group">
                            <label for="customer_name" style="">Customer Name</label><br>
                            <input class="form-control" type="text" id="customer_name" name="customer_name" required>
                        </div>
                        <?php
                        $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
                        $defaultReservationTime = $_GET['reservation_time'] ?? "13:00:00";
                        ?>
                   
                        <div class="form-group " >
                            <label for="reservation_date" style="">Reservation Date</label><br>
                            <input type="date" id="reservation_date" name="reservation_date"
                                   value="<?= $defaultReservationDate ?>" readonly required>
                            <input type="time" id="reservation_time" name="reservation_time"
                                   value="<?= $defaultReservationTime ?>" readonly required>
                        </div>
                 
                        <div class="form-group">
                            <label for="table_id_reserve" style="">Available Tables</label>
                            <select class="form-control" name="table_id" id="table_id_reserve" style="width:10em;" required>
                                <option value="" selected disabled>Select a Table</option>
                                <?php
                                $table_id_list = $_GET['reserved_table_id'];
                                $head_count = $_GET['head_count'] ?? 1;
                                $reserved_table_ids = explode(',', $table_id_list);
                                $select_query_tables = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count'";
                                if (!empty($reserved_table_ids)) {
                                    $reserved_table_ids_string = implode(',', $reserved_table_ids);
                                    $select_query_tables .= " AND table_id NOT IN ($reserved_table_ids_string)";
                                }
                                $result_tables = mysqli_query($link, $select_query_tables);
                                $resultCheckTables = mysqli_num_rows($result_tables);
                                if ($resultCheckTables > 0) {
                                    while ($row = mysqli_fetch_assoc($result_tables)) {
                                        echo '<option value="' . $row['table_id'] . '">For ' . $row['capacity'] . ' people. (Table Id: ' . $row['table_id'] . ')</option>';
                                    }
                                }  else {
                                    echo '<option disabled>No tables available, please choose another time.</option>';
                                    echo '<script>alert("No reservation tables found for the selected time. Please choose another time.");</script>';
                                }
                                ?>
                            </select>
                            <input type="number" id="head_count" name="head_count" value="<?= $head_count ?>" required hidden>
                        </div>
                 
                        <div class="form-group mb-3">
                            <label for="special_request">Special request</label><br>
                            <textarea class="form-control"  id="special_request" name="special_request"> </textarea><br>
                            <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn" type="submit" name="submit">Make Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const viewDateInput = document.getElementById("reservation_date");
        const makeDateInput = document.getElementById("reservation_date");

        viewDateInput.addEventListener("change", function () {
            makeDateInput.value = this.value;
        });
    </script>
</body>

</html>
