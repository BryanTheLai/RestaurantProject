<?php
require_once 'config.php';

// Start the session
session_start();

$reservationStatus = $_GET['reservation'] ?? null;
$message = '';
if ($reservationStatus === 'success') {
    $message = "Reservation successful";
}
$head_count = $_GET['head_count'] ?? 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Reservation Page</title>
    <style>
        /* Apply background image to the body */
        body {
            font-family: 'Montserrat', sans-serif;
            color:white;
            font-size: 17px;
            background-color: black;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0; /* Remove default body margin */
            display: flex;
            justify-content: center; /* Center the container horizontally */
            align-items: center; /* Center the container vertically */
            height: 100vh; /* Ensure the container takes up the full viewport height */
        }

        .reserve-container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 50px;
            border-radius: 10px;
            max-width: 1000px;
            color: white;
            text-align: left; /* Center text inside the container */
        }

        /* Style all buttons with the color #007bff */
        button, select {
            background-color: #5A5A5A;
            color: white;
            border: 2px solid black;
            padding: 3px 10px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            touch-action: manipulation;
            font-family: serif;
            border-color: #41403e;
            box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
            transition: background-color 0.3s, color 0.3s, border 0.3s;
        }

        /* Style buttons and selects on hover */
        button:hover, select:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
            box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
            transform: translate3d(0, 2px, 0);
        }
        
        .button:focus {
          box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
        }

        .reserve-container h2 {
            color: white; /* Set text color to white */
        }

        a.nav-link {
            text-decoration: none; /* Remove underline */
            color: whitesmoke; /* Set link color */
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .column {
            flex-basis: 48%; /* Adjust the width of the columns as needed */
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            color: white;
            text-align: left;
            width: 900px;
        }
    </style>
</head>
<body>
    <div class="member-info"></div>
    <div class="reserve-container">
        <a class="nav-link" href="../home/home.php#hero">
            <h1 class="text-center" style="font-family: Copperplate; color: whitesmoke;">JOHNNY'S</h1>
            <span class="sr-only"></span>
        </a>

        <div class="row">
            <div class="column left-column">
                <div id="Search Table">
                    <h2 style="font-family: serif; color:white;">Time Slot</h2><br>
                    <form id="reservation-form" method="GET" action="availability.php">
                        <label for="reservation_date" style=" font-family: serif;">Select Date:</label><br>
                        <input type="date" id="reservation_date" name="reservation_date" required><br>
                        <!-- HEAD COUNT
                        <label for="head_count" style=" font-family: serif;">Number of People:</label>
                        <input type="number" class="form-control" id="head_count" name="head_count" value="<?= $head_count ?>" required>
                        -->
                        <br><label for="reservation_time" style=" font-family: serif;">Available Reservation Times:</label>
                        <div id="availability-table">
                            <?php
                            $availableTimes = array();
                            for ($hour = 10; $hour <= 20; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $time = sprintf('%02d:%02d:00', $hour, $minute);
                                    $availableTimes[] = $time;
                                }
                            }
                            echo '<select name="reservation_time" id="reservation_time" class="form-control" >';
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
                        <br>
                        
                        <button type="submit" name="submit">Search</button>
                    </form>
                </div>
            </div>

            <div class="column right-column">
                <div id="insert-reservation-into-table">
                    <h2 style="font-family: serif; color:white;">Make a Reservation</h2>
                    <form id="reservation-form" method="POST" action="insertReservation.php">
                        <br>
                        <div class="form-group">
                            <label for="customer_name" style=" font-family: serif;">Customer Name:</label>
                            <br>
                            <input type="text" id="customer_name" name="customer_name" required>
                        </div>
                        <?php
                        $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
                        $defaultReservationTime = $_GET['reservation_time'] ?? "13:00:00";
                        ?>                       
                        <div class="form-group">
                            <label for="reservation_date" style=" font-family: serif;">Reservation Date:</label><br>
                            <input type="date" id="reservation_date" name="reservation_date"
                                   value="<?= $defaultReservationDate ?>" readonly required>
                            <input type="time" id="reservation_time" name="reservation_time"
                                   value="<?= $defaultReservationTime ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="table_id_reserve" style=" font-family: serif;">Pick a Table:</label>
                            <select class="form-control" name="table_id" id="table_id_reserve" required>
                                <option value="" selected disabled style="color:black">Select a table</option>
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
                            <label for="special_request">Special request:</label><br>
                            <input type="text" id="special_request" name="special_request">
                            <br><br>
                            <button type="submit" name="submit">Make Reservation</button>
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


