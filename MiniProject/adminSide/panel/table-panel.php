<?php  include '../inc/dashHeader.php'?>'
. '    <div class="wrapper">
        <div class="container-fluid pt-5 pl-600">
            <div class="row">
                <div class="m-50">
                    <div class="mt-5 mb-3">
                        <h2 class="pull-left">Table Details</h2>
                        <a href="../tableCrud/createTable.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Table</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM Restaurant_Tables ORDER BY table_id;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Table ID</th>";
                                        echo "<th>Capacity</th>";
                                        echo "<th>Availability</th>";
                                        echo "<th>Delete</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['table_id'] . "</td>";
                                        echo "<td>" . $row['capacity'] . " Persons </td>";
                                        if ($row['is_available'] == true) {
                                            echo "<td>" . "Yes" . "</td>";
                                        } else {
                                            echo "<td>" . "No" . "</td>";
                                        }
                                      
                                        echo "<td>";
                                        $deleteSQL = "DELETE FROM Reservations WHERE reservation_id = '" . $row['table_id'] . "';";
                                            echo '<a href="../tableCrud/deleteTable.php?id='. $row['table_id'] .'" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this table?\')"><span class="fa fa-trash text-black"></span></a>';
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

