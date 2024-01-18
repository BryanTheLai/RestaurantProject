<?php
session_start(); // Ensure session is started
?>
<?php
require_once '../config.php';
include '../inc/dashHeader.php';
$bill_id = $_GET['bill_id'];
?>

<div class="container" style="margin-top: 15rem; margin-left: 4rem;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bill (Credit Card Payment)</h3>
                </div>
                <div class="card-body">
                    <h5>Bill ID: <?php echo $bill_id; ?></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
            <?php
            // Query to fetch cart items for the given bill_id
            $cart_query = "SELECT bi.*, m.item_name, m.item_price FROM bill_items bi
                           JOIN Menu m ON bi.item_id = m.item_id
                           WHERE bi.bill_id = '$bill_id'";
            $cart_result = mysqli_query($link, $cart_query);
            $cart_total = 0;//cart total
            $tax = 0.1; // 10% tax rate

            if ($cart_result && mysqli_num_rows($cart_result) > 0) {
                while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                    $item_id = $cart_row['item_id'];
                    $item_name = $cart_row['item_name'];
                    $item_price = $cart_row['item_price'];
                    $quantity = $cart_row['quantity'];
                    $total = $item_price * $quantity;
                    $bill_item_id = $cart_row['bill_item_id'];
                    $cart_total += $total;
                    echo '<tr>';
                    echo '<td>' . $item_id . '</td>';
                    echo '<td>' . $item_name . '</td>';
                    echo '<td>RM ' . number_format($item_price,2) . '</td>';
                    echo '<td>' . $quantity . '</td>';
                    echo '<td>RM ' . number_format($total,2) . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No Items in Cart.</td></tr>';
            }
            ?>
        </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-right">
                        <?php 
                        echo "<strong>Total:</strong> RM " . number_format($cart_total, 2) . "<br>";
                        echo "<strong>Tax (10%):</strong> RM " . number_format($cart_total * $tax, 2) . "<br>";
                        $GRANDTOTAL = $tax * $cart_total + $cart_total;
                        echo "<strong>Grand Total:</strong> RM " . number_format($GRANDTOTAL, 2);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="card-payment" class="col-md-6 order-md-2" style="margin-top: 10rem; margin-right: 5rem;max-width: 40rem;">
    <div class="container-fluid pt-5 pl-3 pr-3">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $account_holder_name = $_POST['cardName'];
    $card_number = $_POST['cardNumber'];
    $expiry_date = $_POST['expiryDate'];
    $security_code = $_POST['securityCode'];
    $bill_id = $_GET['bill_id'];
    $staff_id = $_POST['staff_id'];
    $member_id = intval($_POST['member_id']);
    $reservation_id = $_POST['reservation_id'];
    $GRANDTOTAL = $_POST['GRANDTOTAL'];
    $points = intval($GRANDTOTAL);

    // Check if the bill has already been paid for
    $check_payment_sql = "SELECT card_id FROM Bills WHERE bill_id = '$bill_id'";
    $check_payment_result = $link->query($check_payment_sql);

    if ($check_payment_result) {
        $row = $check_payment_result->fetch_assoc();

        if ($row['card_id'] !== null) {
            echo '<div class="alert alert-warning" role="alert">';
            echo "Bill has already been paid for.</div>";
            
            echo '<br><a href="posTable.php" class="btn btn-dark">Back to Tables</a>';
            echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-light">Print Receipt <span class="fa fa-receipt text-black"></span></a>';
        } else {
            $currentTime = date('Y-m-d H:i:s'); // Current time

            // Prepare and execute the SQL query to insert into card_payments table
            $insert_card_sql = "INSERT INTO card_payments (account_holder_name, card_number, expiry_date, security_code) 
                                VALUES (?, ?, ?, ?)";
            
            $stmt = $link->prepare($insert_card_sql);
            $stmt->bind_param("ssss", $account_holder_name, $card_number, $expiry_date, $security_code);

            if ($stmt->execute()) {
                // Retrieve the generated card_id
                $card_id = $stmt->insert_id;
                
                // Update member points if member_id is not empty
                if (!empty($member_id)) {
                    $update_points_sql = "UPDATE Memberships SET points = points + ? WHERE member_id = ?";
                    $stmt = $link->prepare($update_points_sql);
                    $stmt->bind_param("ii", $points, $member_id);
                    if ($stmt->execute()) {
                        //echo "Points updated successfully!";
                    } else {
                        echo "Error updating points: " . $stmt->error;
                    }
                }

                // Prepare and execute the SQL query to update Bills table with payment details
                $update_bill_sql = "UPDATE Bills SET card_id = ?, payment_method = ?, payment_time = ?,
                                    staff_id = ?, member_id = ?, reservation_id = ? WHERE bill_id = ?";
                
                $stmt = $link->prepare($update_bill_sql);
                $payment_method = "card";
                $stmt->bind_param("issiiii", $card_id, $payment_method, $currentTime, $staff_id, $member_id, $reservation_id, $bill_id);

                if ($stmt->execute()) {
                    echo '<div class="alert alert-success" role="alert">
                    Payment successful!</div>';
                    echo '<br><a href="posTable.php" class="btn btn-dark">Back to Tables</a>';
                    echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-light">Print Receipt <span class="fa fa-receipt text-black"></span></a>';
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
    </div>
    </div><!-- comment -->


<?php include '../inc/dashFooter.php'; ?>