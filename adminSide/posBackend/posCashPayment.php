<?php
session_start(); // Ensure session is started
?>
<?php
require_once '../config.php';
include '../inc/dashHeader.php'; 
$bill_id = $_GET['bill_id'];
$staff_id = $_GET['staff_id'];
$member_id = intval($_GET['member_id']);
$reservation_id = $_GET['reservation_id'];
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Bill (Cash Payment)</h3>
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
                    echo '<td>RM ' . $item_price . '</td>';
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
            
            

<div id="cash-payment" class="container-fluid mt-5 pt-5 pl-5 pr-5 mb-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Cash Payment</h1>
            <form action="" method="get">
                <div class="form-group">
                    <label for="payment_amount">Payment Amount</label>
                    <input type="number" min="0" id="payment_amount" name="payment_amount" class="form-control" required>
                </div>

                <!-- Add hidden input fields for bill_id, staff_id, member_id, and reservation_id -->
                <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
                <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                <input type="hidden" name="GRANDTOTAL" value="<?php echo $tax * $cart_total + $cart_total; ?>">

                <button type="submit" id="cardSubmit" class="btn btn-dark mt-2">Pay</button>
            </form>
        </div>
        <div class="col-md-6">
        <?php
        function calculateChange(float $paymentAmount, float $GrandTotal) {
            return $paymentAmount - $GrandTotal;
        }
        
        

        if (isset($_GET['payment_amount'])) {
            $payment_amount = isset($_GET['payment_amount']) ? floatval($_GET['payment_amount']) : 0.0;

            $billCheckQuery = "SELECT payment_time FROM Bills WHERE bill_id = $bill_id";
            $billCheckResult = $link->query($billCheckQuery);

            if ($billCheckResult) {
                if ($billCheckResult->num_rows > 0) {
                    $billRow = $billCheckResult->fetch_assoc();
                    if ($billRow['payment_time'] !== null) {
                        echo '<div class="alert alert-warning" role="alert">';
                        echo "Bill with ID $bill_id has already been paid.</div>";
                        echo '<br><a href="posTable.php" class="btn btn-dark">Back to Tables</a>';
                        echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-light">Print Receipt <span class="fa fa-receipt text-black"></span></a>';
                        exit; // Stop further execution
                    }
                }
            } else {
                echo "Error checking bill: " . $link->error;
                exit; // Stop further execution
            }

            if ($payment_amount >= $GRANDTOTAL) {
                echo '<div class="alert alert-dark" role="alert">';
                echo "Change is RM" . number_format(calculateChange($payment_amount, $GRANDTOTAL),2);
                echo '</div>';

                // Update the payment method, bill time, and other details in the Bills table
                $currentTime = date('Y-m-d H:i:s');
                $updateQuery = "UPDATE Bills SET payment_method = 'cash', payment_time = '$currentTime',
                                staff_id = $staff_id, member_id = $member_id, reservation_id = $reservation_id
                                WHERE bill_id = $bill_id;";
                
                // Update member points if member_id is not empty

   
                $points = intval($GRANDTOTAL);
                if ($link->query($updateQuery) === TRUE) {
                    $update_points_sql = "UPDATE Memberships SET points = points + $points WHERE member_id = $member_id;";
                    $link->query($update_points_sql);
                    echo '<div class="alert alert-success" role="alert">
                            Bill successfully Paid!
                          </div>';
                    echo '<a href="posTable.php" class="btn btn-dark ">Back to Tables</a>';
                    echo '<a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-light">Print Receipt <span class="fa fa-receipt text-black"></span></a>';
                } else {
                    echo "Error updating bill: " . $link->error;
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">
                        Payment amount is not sufficient
                      </div>';
                echo '<br><a href="posTable.php" class="btn btn-dark">Back to Tables</a>';
            }
        }
        ?>

    </div>
    </div>
</div>

<?php include '../inc/dashFooter.php'; ?>
