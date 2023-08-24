<?php  include '../inc/dashHeader.php'?>

<?php
require_once '../config.php';


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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>
<body>
    <div class="wrapper">
    <h1>Restaurant Reservation</h1>
    <h2>Search Available Time Slot</h2>
    <form id="reservation-form" method="POST" action="availability.php" class="ht-600 w-50">        
        <div class="form-group">
            <label for="reservation_date">Select Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="head_count">Number of People:</label>
            <input type="number" class="form-control" id="head_count" name="head_count" value="<?= $head_count ?>" required>
            <button type="submit" class="btn btn-primary" name="submit">Search</button>
        </div> 
    </form>

    <h2>Make a Reservation</h2>
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
                <select name="table_id" id="table_id_reserve" required>
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
            <button type="submit" class="btn btn-primary" name="submit">Make Reservation</button>
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