<?php  include '../inc/dashHeader.php'?>
<?php
// Include config file
require_once "../config.php";
 
$input_table_id = $table_id_err = $table_id = "";
 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
    if (empty($_POST['table_id'])) {
    $table_idErr = 'ID is required';
  } else {
    // $table_id = filter_var($_POST['table_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $table_id = filter_input(
      INPUT_POST,
      'item_id',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
    
}
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>
<div class="wrapper">
    <h1>Restaurant Reservation</h1>
    <h3>Create New Reservation</h3>
    <p>Please fill in Reservation Details</p>

    <form method="POST" action="success_create_reserve.php" class="ht-600 w-50">
        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" required>
        </div>

        <div class="form-group">
            <label for="table_id">Table Number:</label>
            <input type="number" name="table_id" class="form-control" id="table_id" required>
        </div>

        <div class="form-group">
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" name="reservation_date" id="reservation_date" required class="form-control">
        </div>

        <div class="form-group">
            <label for="reservation_time">Reservation Time:</label>
                <select name="reservation_time" id="reservation_time" class="form-control" required>
                    <?php
                    $start_hour = 14; // 2:00 PM in 24-hour format
                    $end_hour = 21;   // 9:00 PM in 24-hour format

                    for ($hour = $start_hour; $hour <= $end_hour; $hour++) {
                        for ($minute = 0; $minute <= 30; $minute += 30) { // Change this line to increase by 60 (1 hour)
                            $time_slot = sprintf('%02d:%02d', $hour, $minute);
                            echo '<option value="' . $time_slot . '">' . $time_slot . '</option>';
                        }
                    }
                    ?>
                </select>
        </div>

        <div class="form-group">
            <label for="head_count">Number of People:</label>
            <input type="number" name="head_count" id="head_count" required class="form-control">
        </div>

        <div class="form-group">
            <label for="special_request">Special Request:</label>
            <input type="text" name="special_request" id="special_request" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Create Reservation">
        </div>
    </form>
</div>

<!-- Include footer -->
<!-- ... -->

