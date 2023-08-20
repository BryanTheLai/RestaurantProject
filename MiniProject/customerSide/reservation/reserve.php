<?php
require_once 'config.php';
session_start();
if (isset($_GET['reservation'])) {
    $reservationStatus = $_GET['reservation'];

    // Check the value of the reservationStatus and display a message
    if ($reservationStatus === 'success') {
        $message = "Reservation successful ";
        // You can include additional HTML or logic here
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Reservation System</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h1>Search Available Time Slot</h1>
        <form id="reservation-form" method="POST" action="availability.php" >
            <label for="reservation_date">Select Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" required>       <button type="submit" name="submit">Search</button>
        </form>
        


        <h1>Make a Reservation</h1>
        <form id="reservation-form" method="POST" action="reservation.php">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <!--auto Assign table id-->
            <?php
            $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
            //availability table
            $select_query = "SELECT * FROM Table_Availability;";
            $result = mysqli_query($link, $select_query);
            
            $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "availability_id: " . $row['availability_id'] . "<br>";
                            echo "table_id : " . $row['table_id'] . "<br>";
                            echo "reservation_date : " . $row['reservation_date'] . "<br>";
                            echo "reservation_time : " . $row['reservation_time'] . "<br>";
                            echo "Status : " . $row['status'] . "<br><br>";
                        }
                    } else {
                        echo "No Table_Availability found.";
                    }
            ?>

            <input type="date" id="reservation_date" name="reservation_date" value="<?php echo $defaultReservationDate; ?>" readonly required>
            <label for="reservation_time">Available Reservation Times:</label>
            <div id="availability-table">
            <?php
            if (isset($_GET['available_times'])) {
                $availableTimesQueryParam = $_GET['available_times'];
                $availableTimes = explode(",", $availableTimesQueryParam);

                foreach ($availableTimes as $time) {
                    echo "<label>";
                    echo "<input type='radio' name='reservation_time' value='$time'>";
                    echo "$time";
                    echo "</label><br>";
                }  
            }
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
                echo "<p>$message</p>";
            }

            ?>
            </div>
            <label for="head_count">Number of People:</label>
            <input type="number" id="head_count" name="head_count" required max="8">

            <label for="special_request">Special request:</label>
            <input type="text" id="special_request" name="special_request">
            <button type="submit" name="submit">Make Reservation</button>
        </form>

        <div id="reservation-status">
            <?php


            if (isset($_SESSION['customer_name'])) {
                $customer_name = $_SESSION['customer_name'];
                $select_query = "SELECT * FROM Reservations WHERE customer_name = '$customer_name'";
                $result = mysqli_query($link, $select_query);
                if (isset($message)) {// Display the reservation success message if applicable
                echo '<p class="success-message">' . $message . $customer_name . '!</p>';
                }
                if ($result) {
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "Reservation Id: " . $row['reservation_id'] . "<br>";
                            echo "Reservation Date: " . $row['reservation_date'] . "<br>";
                            echo "Reservation Time: " . $row['reservation_time'] . "<br>";
                            echo "Customer Name: " . $row['customer_name'] . "<br>";
                            echo "Table Id: " . $row['table_id'] . "<br>";
                            echo "Special Request: " . $row['special_request'] . "<br><br>";
                        }
                    } else {
                        echo "No reservations found for customer '$customer_name'.";
                    }
                } else {
                    echo "Error in query: " . mysqli_error($link);
                }
            } else {
                echo "No customer name found.";
            }
            ?>
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


