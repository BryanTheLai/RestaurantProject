<?php
require_once '../config.php';

$table_id = $_GET['table_id'];
$cartQuery = "SELECT bi.item_id, m.item_name, m.item_price, bi.quantity FROM Bill_Items bi INNER JOIN Menu m ON bi.bill_id = m.bill_id WHERE bi.table_id = $table_id";
$cartResult = mysqli_query($link, $cartQuery);


?>
<?php include '../inc/dashHeader.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link href="../css/pos.css" rel="stylesheet" />
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 order-md-1" id="item-select-section ">
                <div class="container-fluid pt-5 pl-600 row" style=" margin-left: 15rem;max-width: 40rem;">
                    <div class="mt-5 mb-2">
                        <h2 class="pull-left">Food & Drinks</h2>
                        <form method="POST">
                            <input type="text" name="bill_id" placeholder="Enter bill_id">
                            <input type="submit" name="submit" value="Submit">
                            <input type="submit" name="random" value="Create Random Bill ID">
                        </form>
                    </div>
                    <div class="mb-3">
                        <form method="POST" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search Food & Drinks">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-light">Search</button>
                                </div>
                                <div class="col-md-3">
                                    <a href="orderItems.php?table_id=<?php echo $table_id; ?>" class="btn btn-dark">Show All</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="max-height: 40rem;overflow-y: auto;">
                        <?php
                        // Include config file
                        require_once "../config.php";
                        if (isset($_POST['search'])) {
                            if (!empty($_POST['search'])) {
                                $search = $_POST['search'];

                                $query = "SELECT * FROM Menu WHERE item_name LIKE '%$search%' OR item_category LIKE '%$search%' OR item_id LIKE '%$search%'";
                                $result = mysqli_query($link, $query);
                            }else{
                                // Default query to fetch all menu items
                                $sql = "SELECT * FROM Menu ORDER BY item_id;";
                                $result = mysqli_query($link, $sql);
                            }
                        } else {
                            // Default query to fetch all menu items
                            $sql = "SELECT * FROM Menu ORDER BY item_id;";
                            $result = mysqli_query($link, $sql);
                        }

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
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['item_id'] . "</td>";
                                    echo "<td>" . $row['item_name'] . "</td>";
                                    echo "<td>" . $row['item_category'] . "</td>";
                                    echo "<td>" . $row['item_price'] . "</td>";
                                    echo '<td>' . '<form method="post"><input type="text" value=' . $row['item_id'] . ' hidden><input type="submit" name="btn-atc" value="Add to Cart">' . '</form> </td>';
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo '<div class="alert alert-danger"><em>No menu items were found.</em></div>';
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        // Close connection
                        mysqli_close($link);
                        ?>
                        <?php
                            if(isset($_POST['btn-atc'])){
                                $bill_id = $_GET['bill_id'];
                                $item_id = $_GET['item_id'];
                                $SQL_quantity = "SELECT quantity FROM Bill_Items WHERE bill_id = '$bill_id' AND item_id = '$item_id';";
                                //if not found create one and add 1 to quantity
                                //else quantity _1
                                
                                
                            }
                        
                        ?>
                     </div>

                </div>
            </div>
            <div class="col-md-6 order-md-2" id="cart-section">
                <div class="container-fluid pt-5 pl-600 row">
                    <div class="cart-section">
                    <h3>Cart</h3>
                    <table>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        
                        $subtotal = 0.0;
                        $taxRate = 0.1;
                        
                        
                        while ($row = mysqli_fetch_assoc($cartResult)): ?>
                            <?php
                                $item_id = $row['item_id'];
                                $item_name = $row['item_name'];
                                $item_price = $row['item_price'];
                                $quantity = $row['quantity'];
                                $total = $item_price * $quantity;
                                $subtotal += $total;
                            ?>
                            <tr>
                                <td><?= $item_id ?></td>
                                <td><?= $item_name ?></td>
                                <td><?= $item_price ?></td>
                                <td><?= $quantity ?></td>
                                <td><?= $total ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="item_id" value="<?= $item_id ?>">
                                        <button type="submit" name="remove_item">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                    <div>
                        <p>Subtotal: <?= $subtotal ?></p>
                        <p>Tax: <?= $subtotal * $taxRate ?></p>
                        <p>Grand Total: <?= $subtotal + ($subtotal * $taxRate) ?></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php include '../inc/dashFooter.php'; ?>