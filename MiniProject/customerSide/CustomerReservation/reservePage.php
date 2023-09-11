<?php
require_once 'config.php';

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
             font-size: 17px;
            background-color:black;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0; /* Remove default body margin */
            display: flex;
            justify-content: center; /* Center the container horizontally */
            align-items: center; /* Center the container vertically */
            height: 100vh; /* Ensure the container takes up the full viewport height */|
           
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
            background-color: #007bff;
            color: white;
            border: 2px solid black;
            padding: 3px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border 0.3s;
        }

        /* Style buttons and selects on hover */
        button:hover, select:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
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
    <!-- Display member information here -->
<div class="member-info">
    <?php
    // Get the member_id from the query parameters
    $member_id = $_GET['member_id'] ?? 1; // Change this to the way you obtain the member ID

    // Create a query to retrieve the member's information
    $query = "SELECT member_name, points FROM memberships WHERE member_id = $member_id";

    // Execute the query
    $result = mysqli_query($link, $query);

    // Check if the query was successful and fetch member information
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $member_name = $row['member_name'];
            $points = $row['points'];

            // Calculate VIP status
            $vip_status = ($points >= 1000) ? 'VIP' : 'Regular';

            // Output the member's information
            echo "<p>Member Name: $member_name</p>";
            echo "<p>Points: $points</p>";
            echo "<p>Status: $vip_status</p>";
        } else {
            echo "Member not found.";
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }

    // Close the database connection
    mysqli_close($link);
    ?>
</div>
    <div class="reserve-container">
        <a class="nav-link" href="../home/home.php#hero">
            <h1 class="text-center" style="font-family: Copperplate; color: whitesmoke;">JOHNNY'S</h1>
            <span class="sr-only"></span>
        </a>
 <!-- Display member information here -->
        <?php
        // Get the member_id from the query parameters
        $member_id = $_GET['member_id'] ?? 1; // Change this to the way you obtain the member ID

        // Create a query to retrieve the member's information
        $query = "SELECT member_name, points FROM memberships WHERE member_id = $member_id";

        // Execute the query
   

        // Check if the user is logged in
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            // If logged in, show "Logout" link
            // Check if the query was successful
            if ($result) {
                // Fetch the member's information
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    $member_name = $row['member_name'];
                    $points = $row['points'];

                    // Calculate VIP status
                    $vip_status = ($points > 1000) ? 'VIP' : 'Regular';

                    // Output the member's information
                    echo "<div style='text-align: center; color: white;'>";
                    echo "<h1>Member Information</h1>";
                    echo "<p><span style='color: white;'>Member Name:</span> $member_name</p>";
                    echo "<p><span style='color: white;'>Points:</span> $points</p>";
                    echo "<p><span style='color: white;'>Status:</span> $vip_status</p>";
                    echo "</div>";
                } else {
                    echo "<div style='text-align: center; color: white;'>";
                    echo "Member not found.";
                    echo "</div>";
                }
            } else {
                echo "<div style='text-align: center; color: white;'>";
                echo "Error: " . mysqli_error($link);
                echo "</div>";
            }

           
        }
        ?>


        <div class="row">
            <div class="column left-column">
              
        <div id="Search Table">
        <h2>Time Slot</h2>
        <form id="reservation-form" method="GET" action="availability.php">
            <label for="reservation_date">Select Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" required>
            <br><label for="reservation_time">Available Reservation Times:</label>
            <div id="availability-table">
                <?php
                $availableTimes = array();
                for ($hour = 10; $hour <= 20; $hour++) {
                    for ($minute = 0; $minute < 60; $minute += 60) {
                        $time = sprintf('%02d:%02d:00', $hour, $minute);
                        $availableTimes[] = $time;

                    }
                }
                foreach ($availableTimes as $time) {
                    echo "<label>";
                    echo "<input type='radio' name='reservation_time' value='$time'>";
                    echo "$time";
                    echo "</label><br>";
                }

                if (isset($_GET['message'])) {
                    $message = $_GET['message'];
                    echo "<p>$message</p>";
                }
                ?>
            </div>
            <br><label for="head_count">Number of People:</label>
            <input type="number" id="head_count" name="head_count" value="<?= $head_count ?>" required>
            <button type="submit" name="submit">Search</button>
        </form>
    </div>
            </div>

            <div class="column right-column">
                  
<div id="insert-reservation-into-table">
    <h2>Make a Reservation</h2>
    <form id="reservation-form" method="POST" action="insertReservation.php">
        <br>
        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        </div>
        <?php
        // reservePage.php
        $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
        $defaultReservationTime = $_GET['reservation_time'] ?? "13:00:00"; // Set your desired default time here
        ?>
        <br>
        <div class="form-group">
            <label for="reservation_date">Reservation Date:</label>
        <input type="date" id="reservation_date" name="reservation_date" value="<?= $defaultReservationDate ?>" readonly required>
        <input type="time" id="reservation_time" name="reservation_time" value="<?= $defaultReservationTime ?>" readonly required>
        </div>
        
        <br>
        <div class="form-group">
            <label for="table_id_reserve">Pick a Table:</label>
        <select class="form-control" name="table_id" id="table_id_reserve" required>
            <option value="" selected disabled>Select a table</option>
            <?php
            $table_id_list = $_GET['reserved_table_id'];
            $head_count = $_GET['head_count'] ?? 1;

            // Split the comma-separated table IDs into an array
            $reserved_table_ids = explode(',', $table_id_list);

            // Prepare the SQL query to select available tables
            $select_query_tables = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count'";

            // If there are reserved table IDs, exclude them from the query
            if (!empty($reserved_table_ids)) {
                $reserved_table_ids_string = implode(',', $reserved_table_ids);
                $select_query_tables .= " AND table_id NOT IN ($reserved_table_ids_string)";
            }

            // Execute the query
            $result_tables = mysqli_query($link, $select_query_tables);
            $resultCheckTables = mysqli_num_rows($result_tables);

            // Rest of your code to display available tables...

            if ($resultCheckTables > 0) {
                while ($row = mysqli_fetch_assoc($result_tables)) {
                    echo '<option value="' . $row['table_id'] . '">' . $row['table_id'] . ' (Capacity: ' . $row['capacity'] . ')</option>';
                }
            }  else {
                echo '<option disabled>No tables available, please choose another time.</option>';
                echo '<script>alert("No reservation tables found for the selected time. Please choose another time.");</script>';
            }
            ?>
        </select>
        <input type="number" id="head_count" name="head_count" value="<?= $head_count ?>" required hidden>
        </div>
        
        <br>
        <div class="form-group">
            <label for="special_request">Special request:</label>
        <input type="text" id="special_request" name="special_request">
        <button type="submit" name="submit">Make Reservation</button>
        </div>
    </form>

</div>
    </div>
            </div>
        </div>
    </div>
 <script>
        // Get the input elements
        const viewDateInput = document.getElementById("reservation_date");
        const makeDateInput = document.getElementById("reservation_date");

        // Add event listener to the view date input
        viewDateInput.addEventListener("change", function () {
            // Set the value of the make date input to the selected date
            makeDateInput.value = this.value;
        });
    </script>
</body>
</html>


