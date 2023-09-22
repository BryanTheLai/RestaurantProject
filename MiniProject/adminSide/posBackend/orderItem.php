<?php
session_start(); // Ensure session is started
?>
<?php
require_once '../config.php';
include '../inc/dashHeader.php'; 

$bill_id = $_GET['bill_id'];
$table_id = $_GET['table_id'];

function createNewBillRecord($table_id) {
    global $link; // Assuming $link is your database connection
    
    $bill_time = date('Y-m-d H:i:s');
    
    $insert_query = "INSERT INTO Bills (table_id, bill_time) VALUES ('$table_id', '$bill_time')";
    if ($link->query($insert_query) === TRUE) {
        return $link->insert_id; // Return the newly inserted bill_id
    } else {
        return false;
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <link href="../css/pos.css" rel="stylesheet" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 order-md-1 m-1" id="item-select-section ">
                <div class="container-fluid pt-4 pl-500 row" style=" margin-left: 10rem;width: 81% ;">
                    <div class="mt-5 mb-2">
                    <h3 class="pull-left">Food & Drinks</h3>
                        
                    </div>
                    <div class="mb-3">
                        <form method="POST" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" required="" id="search" name="search" class="form-control" placeholder="Search Food & Drinks">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-dark">Search</button>
                                </div>
                                <div class="col" style="text-align: right;" >
                                    <a href="orderItem.php?bill_id=<?php echo $bill_id; ?>&table_id=<?php echo $table_id; ?>" class="btn btn-light">Show All</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="max-height: 45rem;overflow-y: auto;">
                        <?php
                        // Include config file
                        
                        require_once "../config.php";
                        if (isset($_POST['search'])) {
                            if (!empty($_POST['search'])) {
                                $search = $_POST['search'];

                                $query = "SELECT * FROM Menu WHERE item_type LIKE '%$search%' OR item_category LIKE '%$search%' OR item_name LIKE '%$search%' OR item_id LIKE '%$search%' ORDER BY item_id;";
                                $result = mysqli_query($link, $query);
                            }else{
                                // Default query to fetch all menu items
                                $query = "SELECT * FROM Menu ORDER BY item_id;";
                                $result = mysqli_query($link, $query);
                            }
                        } else {
                            // Default query to fetch all menu items
                            $query = "SELECT * FROM Menu ORDER BY item_id;";
                            $result = mysqli_query($link, $query);
                        }
                        $bill_id = $_GET['bill_id'];
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Item Name</th>";
                                echo "<th>Category</th>";
                                echo "<th>Price</th>";
                                echo "<th>Add</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                // ...

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['item_id'] . "</td>";
                                    echo "<td>" . $row['item_name'] . "</td>";
                                    echo "<td>" . $row['item_category'] . "</td>";
                                    echo "<td>" . number_format($row['item_price'],2) . "</td>";

                                    // Check if the bill has been paid
                                    $payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
                                    $payment_time_result = mysqli_query($link, $payment_time_query);
                                    $has_payment_time = false;

                                    if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
                                        $payment_time_row = mysqli_fetch_assoc($payment_time_result);
                                        if (!empty($payment_time_row['payment_time'])) {
                                            $has_payment_time = true;
                                        }
                                    }

                                    // Display the "Add to Cart" button if the bill hasn't been paid
                                    if (!$has_payment_time) {
                                        echo '<td><form method="get" action="addItem.php">'
                                            . '<input type="text" hidden name= "table_id" value="' . $table_id . '">'
                                            . '<input type="text" name= "item_id" value=' . $row['item_id'] . ' hidden>'
                                            . '<input type="number" name= "bill_id" value=' . $bill_id . ' hidden>'
                                            . '<input type="number" name="quantity" style="width:120px" placeholder="1 to 1000" required min="1" max="1000">'
                                            . '<input type="hidden" name="addToCart" value="1">'
                                            . '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                                        echo "</form></td>";
                                    } else {
                                        echo '<td>Bill Paid</td>';
                                    }

                                    echo "</tr>";
                                }

                                // ...

                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo '<div class="alert alert-danger"><em>No menu items were found.</em></div>';
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        // Close connection
                        
                        ?>
                     </div>

                </div>
            </div>
            <div class="col-md-4 order-md-2 m-1" id="cart-section" >
                <div class="container-fluid pt-5 pl-600 pr-6 row mt-3" style="max-width: 200%; width:150%;">
                    <div class="cart-section" >
                        <h3>Cart</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <div style="max-height: 40rem;overflow-y: auto;">
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
                                        // Check if the bill has been paid
                                        $payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
                                        $payment_time_result = mysqli_query($link, $payment_time_query);
                                        $has_payment_time = false;

                                        if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
                                            $payment_time_row = mysqli_fetch_assoc($payment_time_result);
                                            if (!empty($payment_time_row['payment_time'])) {
                                                $has_payment_time = true;
                                            }
                                        }

                                        // Display the "Delete" button if the bill hasn't been paid
                                        if (!$has_payment_time) {
                                            echo '<td><a class="btn btn-dark" href="deleteItem.php?bill_id=' . $bill_id . '&table_id=' . $table_id . '&bill_item_id=' . $bill_item_id . '&item_id=' . $item_id .'">Delete</a></td>';
                                        } else {
                                            echo '<td>Bill Paid</td>';
                                        }
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="6">No Items in Cart.</td></tr>';
                                }
                                ?>
                                </tbody>
                            </div>
                        </table>
                        <hr>
                        <div class="table-responsive">
    <table class="table table-bordered ">
        <tbody>
            <tr>
                <td><strong>Cart Total</strong></td>
                <td>RM <?php echo number_format($cart_total, 2); ?></td>
            </tr>
            <tr>
                <td><strong>Cart Taxed</strong></td>
                <td>RM <?php echo number_format($cart_total * $tax, 2); ?></td>
            </tr>
            <tr>
                <td><strong>Grand Total</strong></td>
                <td>RM <?php echo number_format(($tax * $cart_total) + $cart_total, 2); ?></td>
            </tr>
        </tbody>
    </table>
</div>

                        <?php 
                        
                        //echo "Cart Total: RM " . $cart_total;
                        //echo "<br>Cart Taxed: RM " . $cart_total * $tax;
                        //echo "<br>Grand Total: RM " . $tax * $cart_total + $cart_total;
                      
                        // Check if the payment time record exists for the bill
                        $payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
                        $payment_time_result = mysqli_query($link, $payment_time_query);
                        $has_payment_time = false;

                        if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
                            $payment_time_row = mysqli_fetch_assoc($payment_time_result);
                            if (!empty($payment_time_row['payment_time'])) {
                                $has_payment_time = true;
                            }
                        }

                        // If payment time record exists, show the "Print Receipt" button
                        if ($has_payment_time) {
                            echo '<div>';
                            echo '<div class="alert alert-success" role="alert">
                                    Bill has already been paid.
                                  </div>';
                            echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-light">Print Receipt <span class="fa fa-receipt text-black"></span></a></div>';
                            

                            
                        } elseif(($tax * $cart_total + $cart_total) > 0) {
                            echo '<br><a href="idValidity.php?bill_id=' . $bill_id . '" class="btn btn-success">Pay Bill</a>';
                        } else {
                            echo '<br><h3>Add Item To Cart to Proceed</h3>';
                        }

                        
                        
                        ?>
                    </div>
                    <?php 
                       echo '<form class="mt-3" action="newCustomer.php" method="get">'; // Add this form element
                        echo '<input type="hidden" name="table_id" value="' . $table_id . '">';
                        echo '<button type="submit" name="new_customer" value="true" class="btn btn-warning">New Customer</button>';
                        echo '</form>';

            



                    ?>
                </div>

            </div>
        </div>
    </div>
<?php include '../inc/dashFooter.php'; ?>
