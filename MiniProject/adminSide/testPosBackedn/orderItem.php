<?php
require_once '../config.php';
//include '../inc/dashHeader.php'; 
$bill_id = $_GET['bill_id'];
?>
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
                                    <a href="orderItem.php?bill_id=<?php echo $bill_id; ?>" class="btn btn-dark">Show All</a>
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
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['item_id'] . "</td>";
                                    echo "<td>" . $row['item_name'] . "</td>";
                                    echo "<td>" . $row['item_category'] . "</td>";
                                    echo "<td>" . $row['item_price'] . "</td>";
                                    echo '<td><form method="get" action="">'
                                            . '<input type="text" name= "item_id" value=' . $row['item_id'] . ' hidden>'
                                            . '<input type="number" name= "bill_id" value=' . $bill_id . ' hidden>'
                                            . '<input type="number" name="quantity" placeholder="Enter Quantity" required>'
                                            . '<input type="hidden" name="addToCart" value="1">'
                                            . '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                                    echo "</form> </td></tr>";
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
                       
                            if (isset($_GET['addToCart'])) {
                              
                                $bill_id = intval($_GET['bill_id']);
                                $item_id = $_GET['item_id']; // No need to convert, assuming it's a string
                                $quantity = intval($_GET['quantity']);

                                echo var_dump($bill_id);
                                echo var_dump($item_id);
                                echo var_dump($quantity);
                                echo '<script>alert(<?php echo var_dump($quantity);?>)</script>';
                                header("location:" . var_dump($quantity));
                                $SQL_bill_item_id = "SELECT bill_item_id FROM bill_items WHERE bill_id = '$bill_id' AND item_id = '$item_id'";
                                $result_bill_item_id = $link->query($SQL_bill_item_id);
                                
/*
                                //Stops running from here to
                                    if ($result_bill_item_id) {
                                        if ($result_bill_item_id->num_rows > 0) {
                                            // Update quantity
                                            $update_quantity_sql = "UPDATE bill_items SET quantity = quantity + $quantity WHERE bill_id = '$bill_id' AND item_id = '$item_id'";
                                            if ($link->query($update_quantity_sql)) {
                                                echo "Quantity updated successfully.";
                                                echo '<script>alert("Quantity updated successfully")</script>';
                                            } else {
                                                echo "Error updating quantity: " . $link->error;
                                                echo '<script>alert("Error updating quantity")</script>';
                                            }
                                        } else {
                                            // Insert new record
                                            $insert_item_sql = "INSERT INTO bill_items (bill_id, item_id, quantity) VALUES ('$bill_id', '$item_id', '$quantity')";
                                            if ($link->query($insert_item_sql)) {
                                                echo "Item added to cart successfully.";
                                                echo '<script>alert("Item added to cart successfully")</script>';
                                            } else {
                                                echo "Error adding item to cart: " . $link->error;
                                                echo '<script>alert("Error adding item to cart")</script>';
                                            }
                                        }
                                    } else {
                                        echo "Error checking bill item ID: " . $link->error;
                                        echo '<script>alert("Error checking bill item ID")</script>';
                                    }
                                 
                                 
                                */
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
                        <?php 
                        echo var_dump($bill_id);
                        echo var_dump($item_id);
                        echo var_dump($quantity);
                        
                        
                        ?>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>    
                    </table>
                    <div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?php include '../inc/dashFooter.php'; ?>