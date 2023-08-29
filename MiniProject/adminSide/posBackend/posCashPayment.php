<?php
require_once '../config.php';
include '../inc/dashHeader.php'; 
$bill_id = $_GET['bill_id'];
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
                    echo '<td><a href="deleteItem.php?bill_id=' . $bill_id . '&bill_item_id=' . $bill_item_id . '">Delete</a></td>';
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

<div id="cash-payment">
    <>
</div>
