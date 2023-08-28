

<?php
require_once 'config.php';


$reservationStatus = $_GET['reservation'] ?? null;
$message = '';

if ($reservationStatus === 'success') {
    $message = "Reservation successful";
}

$defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
$head_count = $_GET['head_count'] ?? 1;

$select_query_tables = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count';";
$result_tables = mysqli_query($link, $select_query_tables);
$resultCheckTables = mysqli_num_rows($result_tables);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservation System</title>
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
      .reservation-btn {
        font-family: 'Montserrat', sans-serif;
	display: inline-block;
	padding: 1px 20px; /* Adjust padding to make the button smaller */
	color: black;
	background-color: transparent;
	border: 2px solid black;
	font-size: 1.6rem; /* Adjust font size to make the text smaller */
	letter-spacing: 0.1rem;
	margin-top: 20px; /* Adjust margin-top if needed */
	transition: 0.3s ease;
	transition-property: background-color, color;
        border-radius: 5px;
}

.reservation-btn:hover {
	color: white;
	background-color: black;
}

      
     .wrapper {
        width: 80%;
        max-width: 600px; /* Limit the maximum width of the content */
        padding: 20px;
        text-align: left;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        display: flex;
        flex-direction: column;
        align-items: left;
        justify-content: left;
        min-height: 100vh;
        margin: 0;
    }
    .form-group {
        margin-bottom: 30px; /* Add more space between form groups */
    }
    
/* Style for the select element */
.select-table {
    font-family: 'Montserrat', sans-serif;
    padding: 8px;
    font-size: 14px;
    border: 2px solid black;
    border-radius: 5px;
    background-color: white; /* Set default background color to white */
    color: black; /* Set default text color to black */
}

/* Style for the options within the select element */
.select-table option {
    font-size: 14px;
    background-color: white; /* Set default background color to white */
    color: black; /* Set default text color to black */
    transition: background-color 0.3s, color 0.3s; /* Add transition effect */
}

/* Change style when hovering over options */
.select-table option:hover {
    background-color: black; /* Change background color to black */
    color: white; /* Change text color to white */
}

    </style>
    
</head>
<body>
    <div class="wrapper">
   
    <form id="reservation-form" method="POST" action="availability.php" class="ht-600 w-50">        
        <div class="form-group">
            <label for="reservation_date">Select Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="head_count">Number of People:</label>
            <input type="number" class="form-control" id="head_count" name="head_count" value="<?= $head_count ?>" required>
            <button type="submit" class="reservation-btn" name="submit">Search</button>
        </div> 
    </form>


    <form id="reservation-form" method="POST" action="reservation.php" class="ht-600 w-50">
        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        
        <div class="form-group">
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="<?= $defaultReservationDate ?>" readonly required>
        </div>
        
        <div class="form-group">
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
        </div>
        
        <div class="form-group">
            <label for="table_id_reserve">Pick a Table:</label>
                <select class="select-table" name="table_id" id="table_id_reserve" required>
                <option value="table1">Table 1</option>
                <option value="table2">Table 2</option>
               <option value="table3">Table 3</option>
               <!-- Add more options as needed -->
                    <option value="" selected disabled>Select a table</option>
                    <?php
                    if ($resultCheckTables > 0) {
                        while ($row = mysqli_fetch_assoc($result_tables)) {
                            echo '<option value="' . $row['table_id'] . '">' . $row['table_id'] . ' (Capacity: ' . $row['capacity'] . ')</option>';
                        }
                    } else {
                        echo '<option disabled>No tables available</option>';
                    }
                    ?>
                </select>
        </div>
        
        <div class="form-group">
            <label for="special_request">Special request:</label>
            <input type="text" class="form-control" id="special_request" name="special_request">
            <button type="submit" class="reservation-btn" name="submit">Make Reservation</button>
        </div>
    </form>

    <div id="reservation-status">
        <?php
        if (isset($_SESSION['customer_name'])) {
            $customer_name = $_SESSION['customer_name'];
            $select_query = "SELECT * FROM Reservations WHERE customer_name = '$customer_name'";
            $result = mysqli_query($link, $select_query);
            if (isset($message)) {
                echo '<p class="success-message">' . $message . ' ' . $customer_name . '!</p>';
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
            echo "";
        }
        ?>
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