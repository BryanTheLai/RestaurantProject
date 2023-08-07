<?php
require_once "../customerLogin/config.php";
$reservation_name = $reservation_nameErr = "";
if(isset($_POST['submit'])){
    if (empty($_POST['reservation_name'])) {
    $reservation_nameErr = 'Name Required';
  } else {
    // $item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $reservation_name = filter_input(
      INPUT_POST,
      'reservation_name',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
    
}

