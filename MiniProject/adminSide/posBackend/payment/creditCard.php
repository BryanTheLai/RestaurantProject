<?php
// payment/creditCardProcessing.php
// Include your database connection configuration
require_once('../../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $account_holder_name = $_POST['cardName'];
    $card_number = $_POST['cardNumber'];
    $expiry_date = $_POST['expiryDate'];
    $security_code = $_POST['securityCode'];
    $bill_id = $_GET['bill_id'];

    // Prepare and execute the SQL query to insert into card_payments table
    $insert_card_sql = "INSERT INTO card_payments (account_holder_name, card_number, expiry_date, security_code) 
                       VALUES ('$account_holder_name', '$card_number', '$expiry_date', '$security_code')";
    
    if ($link->query($insert_card_sql) === TRUE) {
        // Retrieve the generated card_id
        $card_id = $link->insert_id;

        // Prepare and execute the SQL query to insert into Bills table
        $insert_bill_sql = "INSERT INTO Bills (bill_id, card_id,payment_method) 
                            VALUES ('$bill_id', '$card_id','card')";

        if ($link->query($insert_bill_sql) === TRUE) {
            echo "Data inserted into both tables successfully!";
        } else {
            echo "Error inserting data into Bills table: " . $insert_bill_sql . "<br>" . $link->error;
        }
    } else {
        echo "Error inserting data into card_payments table: " . $insert_card_sql . "<br>" . $link->error;
    }
}
?>
