<?php
require_once '../config.php';
include '../inc/dashHeader.php'; 
$bill_id = $_GET['bill_id'];
$staff_id = $_GET['staff_id'];
$member_id = $_GET['member_id'];
$reservation_id = $_GET['reservation_id'];
?>

<div class="cart-section" style="margin-top: 15rem; margin-left: 15rem;max-width: 40rem;">
    <h3>Bill (Cash Payment)</h3>
    <?php
    echo '<h5>Bill ID : ' . $bill_id . '</h5>';
    ?>
    <table>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <div style="max-height: 40rem;overflow-y: auto;">
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
                    echo '<td>RM ' . $total . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No Items in Cart.</td></tr>';
            }
            ?>
        </div>
    </table>
    <hr>
    <?php 
    echo "Cart Total: RM " . $cart_total;
    echo "<br>Cart Taxed: RM " . $cart_total * $tax;
    $GRANDTOTAL = $tax * $cart_total + $cart_total;
    echo "<br>Grand Total: RM " . $GRANDTOTAL;
    ?>
</div>

<div id="cash-payment">
    <div class="container-fluid pt-5 pl-600 pr-5 row">
        <h1>Cash Payment</h1>
            <form action="" method="get">
                <div class="form-group">
                    <label for="payment_amount">Payment Amount</label>
                    <input type="number" id="payment_amount" name="payment_amount" class="form-control" required>
                </div><br>

                <!-- Add hidden input fields for bill_id, staff_id, member_id, and reservation_id -->
                <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
                <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">

                <button type="submit" id="cardSubmit" class="btn btn-dark">Submit</button>
            </form>
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
                        echo '<br><a href="posTable.php" class="btn btn-dark">Back to Order Item Page</a>';
                        echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-info">Print Receipt</a>';
                        exit; // Stop further execution
                    }
                }
            } else {
                echo "Error checking bill: " . $link->error;
                exit; // Stop further execution
            }

            if ($payment_amount >= $GRANDTOTAL) {
                echo '<div class="alert alert-dark" role="alert">';
                echo "Change is RM" . calculateChange($payment_amount, $GRANDTOTAL);
                echo '</div>';

                // Update the payment method, bill time, and other details in the Bills table
                $currentTime = date('Y-m-d H:i:s');
                $updateQuery = "UPDATE Bills SET payment_method = 'cash', payment_time = '$currentTime',
                                staff_id = $staff_id, member_id = $member_id, reservation_id = $reservation_id
                                WHERE bill_id = $bill_id";

                if ($link->query($updateQuery) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">
                            Bill successfully Paid!
                          </div>';
                    echo '<br><a href="posTable.php" class="btn btn-dark">Back to Order Item Page</a>';
                    echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-info">Print Receipt</a>';
                } else {
                    echo "Error updating bill: " . $link->error;
                }
            } else {
                echo '<div class="alert alert-warning" role="alert">
                        Payment amount is not sufficient
                      </div>';
                echo '<br><a href="posTable.php" class="btn btn-dark">Back to Order Item Page</a>';
            }
        }
        ?>

    </div>
</div>
