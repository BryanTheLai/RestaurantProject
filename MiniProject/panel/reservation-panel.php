<?php  include '../inc/dashHeader.php'?>'
. '    <div class="wrapper">
        <div class="container-fluid pt-5 pl-600">
            <div class="row">
                <div class="m-50">
                    <div class="mt-5 mb-3">
                        <h2 class="pull-left">Reservation Details</h2>
                        <a href="../reservationsCrud/createReservation.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Reservation</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM reservations ORDER BY reservation_id;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Bill Id</th>";
                                        echo "<th>Customer Name</th>";
                                        echo "<th>Time Reserved</th>";
                                        echo "<th>Turnout</th>";
                                        echo "<th>Special request</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['reservation_id'] . "</td>";
                                        echo "<td>" . $row['bill_id'] . "</td>";
                                        echo "<td>" . $row['customer_name'] . "</td>";
                                        echo "<td>" . $row['reservation_time'] . "</td>";
                                        echo "<td>" . $row['turnout'] . "</td>";
                                        echo "<td>" . $row['special_request'] . "</td>";
                                        echo "<td>";
                                        $deleteSQL = "DELETE FROM Reservations WHERE reservation_id = '" . $row['reservation_id'] . "';";
                                            echo '<a href="../reservationsCrud/updateReservation.php?id='. $row['reservation_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil  text-black"></span></a>';
                                            echo '<a href="../reservationsCrud/deleteReservation.php?id='. $row['reservation_id'] .'" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this item?\')"><span class="fa fa-trash text-black"></span></a>';
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
