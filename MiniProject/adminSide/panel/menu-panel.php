<?php  include '../inc/dashHeader.php'?>'
. '    <div class="wrapper">
        <div class="container-fluid pt-5 pl-600">
            <div class="row">
                <div class="m-50">
                    <div class="mt-5 mb-3">
                        <h2 class="pull-left">Items Details</h2>
                        <a href="../menuCrud/createItem.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Item</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM items ORDER BY item_id;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Item ID</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Type</th>";
                                        echo "<th>Category</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Description</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['item_id'] . "</td>";
                                        echo "<td>" . $row['item_name'] . "</td>";
                                        echo "<td>" . $row['item_type'] . "</td>";
                                        echo "<td>" . $row['item_category'] . "</td>";
                                        echo "<td>" . $row['item_price'] . "</td>";
                                        echo "<td>" . $row['item_description'] . "</td>";
                                        echo "<td>";
                                        $deleteSQL = "DELETE FROM items WHERE item_id = '" . $row['item_id'] . "';";
                                            echo '<a href="update.php?id='. $row['item_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil  text-black"></span></a>';
                                            echo '<a href="../menuCrud/deleteItem.php?id='. $row['item_id'] .'" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this item?\')"><span class="fa fa-trash text-black"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>

<?php  include '../inc/dashFooter.php'?>

