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

    // Check if the bill has already been paid for
    $check_payment_sql = "SELECT card_id FROM Bills WHERE bill_id = '$bill_id'";
    $check_payment_result = $link->query($check_payment_sql);

    if ($check_payment_result) {
        $row = $check_payment_result->fetch_assoc();
        if ($row['card_id'] !== null) {
            echo "Bill has already been paid for.";
            echo '<br><a href="../posTable.php" class="btn btn-primary">Back to Order Item Page</a>';

        } else {
            // Prepare and execute the SQL query to insert into card_payments table
            $insert_card_sql = "INSERT INTO card_payments (account_holder_name, card_number, expiry_date, security_code) 
                                VALUES (?, ?, ?, ?)";
            
            $stmt = $link->prepare($insert_card_sql);
            $stmt->bind_param("ssss", $account_holder_name, $card_number, $expiry_date, $security_code);

            if ($stmt->execute()) {
                // Retrieve the generated card_id
                $card_id = $stmt->insert_id;

                // Prepare and execute the SQL query to update Bills table with payment details
                $update_bill_sql = "UPDATE Bills SET card_id = ?, payment_method = ? WHERE bill_id = ?";
                
                $stmt = $link->prepare($update_bill_sql);
                $payment_method = "card";
                $stmt->bind_param("isi", $card_id, $payment_method, $bill_id);

                if ($stmt->execute()) {
                    echo "Payment successful!";
                    echo '<br><a href="../posTable.php" class="btn btn-primary">Back to Order Item Page</a>';
                } else {
                    echo "Error updating Bills table: " . $stmt->error;
                }
            } else {
                echo "Error inserting data into card_payments table: " . $stmt->error;
            }
        }
    } else {
        echo "Error checking payment status: " . $link->error;
    }
}
?>
