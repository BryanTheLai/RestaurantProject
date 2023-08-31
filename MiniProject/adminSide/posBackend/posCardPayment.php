<?php
require_once '../config.php';
include '../inc/dashHeader.php'; 
$bill_id = $_GET['bill_id'];
$staff_id = $_GET['staff_id'];
$member_id = $_GET['member_id'];
$reservation_id = $_GET['reservation_id'];
?>

<div class="cart-section" style="margin-top: 15rem; margin-left: 15rem;max-width: 40rem;">
    <h3>Bill (Credit Card Payment)</h3>
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
    echo "<br>Grand Total: RM " . $tax * $cart_total + $cart_total;
    ?>
</div>
<div id="card-payment" class="col-md-6 order-md-2" style="margin-top: 10rem; margin-left: 10rem;max-width: 40rem;">
    <div class="container-fluid pt-5 pl-600 pr-5 row">
        

        <h1>Fill in your card details</h1>
            <form action="creditCard.php?bill_id=<?php echo $bill_id; ?>" method="post">
            <div class="form-group">
                <label for="cardNameField">Account Holder Name</label>
                <input type="text" id="cardNameField" name="cardName" class="form-control" required>
            </div><br>
            <div class="form-group">
                <label for="cardField">Card Number</label>
                <input type="text" id="cardField" name="cardNumber" maxlength="19" minlength="15" class="form-control" placeholder="1234567890123456 (15 to 19 digits)" required>
            </div><br>
            <div class="form-group">
                <label for="expiryDate">Expiry Date</label>
                <input type="text" id="expiryDate" name="expiryDate" pattern="(0[1-9]|1[0-2])\/[0-9]{4}" maxlength="7" placeholder="MM/YYYY" class="form-control" required>
            </div><br>

            <div class="form-group">
                <label for="securityCode">Security Code</label>
                <input type="text" id="securityCode" name="securityCode" maxlength="3" class="form-control" placeholder="CCV" pattern="[0-9]{3}" required>
                <small class="form-text text-muted">Please enter a 3-digit security code.</small>
            </div><br>
             <!-- Add hidden input fields for bill_id, staff_id, member_id, and reservation_id -->
                <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
                <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                <input type="hidden" name="GRANDTOTAL" value="<?php echo $tax * $cart_total + $cart_total; ?>">
            
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="privacyCheckbox" required>
                <label class="form-check-label" for="privacyCheckbox">I agree to the Private Data Terms and Conditions</label><br>
                <small id="privacyHelp" class="form-text text-muted">By checking the box you understand we will save your credit card information.</small>
            </div>
            <button type="submit" id="cardSubmit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


         