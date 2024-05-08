<?php 
require_once('../database-connection.php');
session_start();

if(!isset($_POST['field']) || !isset($_POST['value'])){
    echo json_encode(['status' => 'failed', 'error' => 'Invalid Field Value or Name']);
    exit;
}

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // STORE VALUES
    $field = $_POST['field'];
    $value = $_POST['value'];


    $email_query = "SELECT email FROM accounts WHERE email = ?";
    // VALIDATE THE FORM
   switch($field) {
     case 'email': 
        if(empty($value)){
            $error = "Email is empty";
        } else if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
            $error = "Value is not an email!";
        } else if(fetch_record($email_query, [$value])){
            $error = "Email is already registered!";
        } else {
            $email = escape_this_string($value);
        }
        break;
    
    case 'member_name': 
        if(empty($value)){
            $error = "Username field is empty";
        } else {
            $memberName = escape_this_string($value);
        }
        break;
    case 'password': 
        if(empty($value)){
            $error = "Password is empty";
        } else {
            $password = escape_this_string($value);
        }
        break;
    case 'phone_number': 
        if(empty($value)){
            $error = "Contact Number field is empty!";
        } else if (!is_numeric($value)) {
            $error = "Contact Number field is not a number!";
        } else if (strlen($value) < 11) {
            $error = "Contact Number field is less than 11!";
        } else if (strlen($value) > 11) {
            $error = "Contact Number field is greater than 11!";
        } else if(!(preg_match('/^09([0-9]{9})/', $value))){
            $error = "Invalid Format. Must start with 09 and must be 11 digit.";
        } else {
            $number = escape_this_string($value);
        }
        break;
   }

}



if(isset($error)){
    echo json_encode(['status' => 'failed', 'error' => $error]);
} else {
    echo json_encode(['status' => 'success']);
}

?>