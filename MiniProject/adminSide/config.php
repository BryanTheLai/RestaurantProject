<?php
define('DB_HOST','localhost');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','restaurantDB');

//Create Connection
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($conn->connect_error){ //if not Connection
die('Connection Failed'.$conn->connect_error);//kills the Connection OR terminate execution
}
?>