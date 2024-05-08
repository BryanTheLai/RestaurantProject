<?php 
require_once('../database-connection.php');

// Data
$data = $_POST;


$memberName = escape_this_string($data['member_name']);
$email = escape_this_string($data['email']);
$password = escape_this_string($data['password']);
$phone_number = escape_this_string($data['phone_number']);

$insertQueryToAccounts = "INSERT INTO Accounts (email, password, phone_number, register_date) VALUES(?, ?, ?, NOW())";
$accountsParam = [$email, $password, $phone_number];
$last_inserted_id = run_mysql_query($insertQueryToAccounts, $accountsParam);
if($last_inserted_id){
    $insertQueryToMemberships = "INSERT INTO Memberships (member_name, points, account_id) VALUES (?, ?, ?)";
    $membershipParams = [$memberName, 0, $last_inserted_id];
    run_mysql_query($insertQueryToMemberships, $membershipParams);

    $response = ['status' => 'success', 'message' => "Successful sign-up! <a href='/login'>Login here.</a>"];
} else {
    $response = ['status' => 'error', 'errors' => ["error_msg" => "There's an error occurred while saving the data. Error: ".$conn->error]];
}

echo json_encode($response);
?>