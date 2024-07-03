<?php
session_start(); // Ensure session is started
require_once '../posBackend/checkIfLoggedIn.php';
?>
<?php  include '../inc/dashHeader.php'?>   
    <style>
        .wrapper{ width: 50%; padding-left: 200px; padding-top: 20px  }
    </style>
<div class="wrapper">
        <div class="container-fluid pt-5 pl-600">
            <div class="row">
                <div class="m-50">
                    <div class="mt-5 mb-3">
                        <h2 class="pull-left">Table Details</h2>
                        <a href="../tableCrud/createTable.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Table</a>
                    </div>
                    <div class="mb-3">
                    <form method="POST" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <input required type="text" id="search" name="search" class="form-control" placeholder="Enter Table ID, Capacity">
                            </div>
                            <div class="col-md-3" >
                                <button type="submit" class="btn btn-dark">Search</button>
                            </div>
                            <div class="col" style="text-align: right;" >
                                <a href="table-panel.php" class="btn btn-light">Show All</a>
                            </div>
                        </div>
                    </form>
                </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    if (isset($_POST['search'])) {
                    if (!empty($_POST['search'])) {
                        $search = $_POST['search'];

                        $sql = "SELECT *
                                FROM Restaurant_Tables
                                WHERE table_id LIKE '%$search%' OR capacity LIKE '%$search%' 
                                ORDER BY table_id;";
                    } else {
                        // Default query to fetch all Restaurant_tables
                        $sql = "SELECT *
                                FROM Restaurant_Tables
                                ORDER BY table_id;";
                    }
                } else {
                    // Default query to fetch all Restaurant_tables
                    $sql = "SELECT *
                            FROM Restaurant_Tables
                            ORDER BY table_id;";
                }


                    // Attempt select query execution
                    //$sql = "SELECT * FROM Restaurant_Tables ORDER BY table_id;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Table ID</th>";
                                        echo "<th>Capacity</th>";
                                        echo "<th>Availability</th>";
                                        //echo "<th>Delete</th>";
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
                                      
                                     //   echo "<td>";
                                      //  $deleteSQL = "DELETE FROM Reservations WHERE reservation_id = '" . $row['table_id'] . "';";
                                        //   echo '<a href="../tableCrud/deleteTableVerify.php?id='. $row['table_id'] .'" title="Delete Record" data-toggle="tooltip" '
                                         //           . 'onclick="return confirm(\'Admin Permissions Required!\n\nAre you sure you want to delete this Table?\n\nThis will alter other modules related to this Table!\')"><span class="fa fa-trash text-black"></span></a>';
                                       // echo "</td>";
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

