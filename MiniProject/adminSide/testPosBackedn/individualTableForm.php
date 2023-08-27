<div class="col-md-4 mb-4">
    <a href="orderItem.php?table_id=1" class="btn btn-primary btn-block btn-lg" 
       style="background-color: green;justify-content: center; align-items: center; display: flex; width: 9rem; height: 9rem;">
        Table: 1
        <br>
        Capacity: 4
    
    </a>
</div>

<div class="col-md-4 mb-4 row btn">
    <form method="get" action='orderItem.php' class='row'>
        <input type="text" name="bill_id" value=$bill_id disabled required>
        <input type="text" name="table_id" value=$table_id disabled required>
        <input type='submit' name="submit" placeholder='Go to order'>
    </form>
</div>
<?php
//include '../inc/dashHeader.php';
require_once '../config.php'; // Include your database configuration
?>
                    <?php
                    // Fetch all tables from the database
                    $query = "SELECT * FROM Restaurant_Tables ORDER BY table_id;";
                    $result = mysqli_query($link, $query);
                    
                    $table = array("", "", "");
                    if ($result) {
                        $table_count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            if ($table_count % 3 == 0) {
                                echo '</div><div class="row justify-content-center">';
                            }
                            $table_id = $row['table_id'];
                            $capacity = $row['capacity'];
                            $is_available = $row['is_available'];
                            $box_color = $is_available ? 'green' : 'red';
                            echo '<div class="col-md-4 mb-4">';
                            
                            $sqlBill = "SELECT bill_id FROM Bills WHERE table_id = $table_id ORDER BY bill_time DESC LIMIT 1";
                            $result1 = $link->query($sqlBill);
                            if ($result1->num_rows > 0) {
                                // Output data of the latest bill for the specified table ID
                                $row = $result1->fetch_assoc(); // Use $result1 instead of $result
                                $latestBillID = $row["bill_id"];
                                $table[$table_id] = $latestBillID; // Use $table_id instead of $row['table_id']
                                echo "Latest bill ID for table $table_id: $latestBillID bill id";
                            } else {
                                echo "No bills found for table $table_id";
                            }
                            echo '<a href="orderItem.php?table_id=' . $table_id . '&bill_id' . $latestBillID . '"class="btn btn-primary btn-block btn-lg" style="background-color: ' . $box_color . ';justify-content: center; align-items: center; display: flex; width: 9rem; height: 9rem;">Table: ' . $table_id . '<br>Capacity: ' . $capacity; 
                            
                            echo '</a></div>';
                            $table_count++;
                        }
                    } else {
                        echo "Error fetching tables: " . mysqli_error($link);
                    }
                    ?>