<?php  include '../inc/dashHeader.php'?>
<?php
// Include config file
require_once "../config.php";

ob_start(); 
$input_reservation_id = $reservation_id_err = $reservation_id = "";
$input_customer_name = $customer_name_err = $customer_name = "";
$input_table_id = $table_id_err = $table_id = "";
$input_reservation_time = $reservation_time_err = $reservation_time = "";
$input_reservation_date = $reservation_date_err = $reservation_date = "";
$input_head_count = $head_count_err = $head_count = "";
$input_special_request = $special_request_err = $special_request = ""; 

// Processing form data when form is submitted
if(isset($_POST['submit'])){
    if (empty($_POST['reservation_id'])) {
    $reservation_id_Err = 'ID is required';
  } else {
    // $reservation_id = filter_var($_POST['reservation_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $reservation_id = filter_input(
      INPUT_POST,
      'reservation_id',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
    
}
?>
<head>
    <meta charset="UTF-8">
    <title>Make a Reservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>

 <div class="wrapper" >
    <h1>Johnny's Dining & Bar</h1>
    <h3>Make a Reservation</h1>
    <p>Please fill in Reservation Information Properly </p>
    
<form method="POST" action="success_create_reserve.php" class="ht-600 w-50">
        
        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" required<?php echo (!empty($customer_name_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>
        
       <div class="form-group">
            <label for="table_id">Table Number:</label>
            <input type="number" name="table_id" class="form-control" id="table_id" required<?php echo (!empty($table_id_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" name="reservation_date" id="reservation_date" required class="form-control"<?php echo (!empty($reservation_date_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <label for="reservation_time">Reservation Time:</label>
            <input type="time" name="reservation_time" id="reservation_time" required class="form-control"<?php echo (!empty($reservation_time_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <label for="head_count">Number of People:</label>
            <input type="number" name="head_count" id="head_count" required class="form-control"<?php echo (!empty($head_count_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <label for="special_request">Special Request:</label>
            <input type="text" name="special_request" id="special_request" class="form-control"<?php echo (!empty($special_request_err)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Make Reservation">
        </div>    
        
    
 </form>
 </div>
