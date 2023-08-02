<?php  include '../inc/dashHeader.php'?>'
. '    <div class="wrapper">
        <div class="container-fluid pt-5 pl-600">
            <div class="row">
                <div class="m-50">
                    <div class="mt-5 mb-3">
                        <h2 class="pull-left">Staff Details</h2>
                        <a href="../staffCrud/createStaff.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Staff</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM staffs ORDER BY staff_id;";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Staff Name</th>";
                                        echo "<th>Role</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Salary</th>";
                                        echo "<th>Phone No</th>";
                                        echo "<th>Password</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['staff_id'] . "</td>";
                                        echo "<td>" . $row['staff_name'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>RM " . $row['salary'] . "</td>";
                                        echo "<td>" . $row['phone_no'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>";
                                        $deleteSQL = "DELETE FROM Reservations WHERE reservation_id = '" . $row['staff_id'] . "';";
                                            echo '<a href="../staffCrud/updateStaff.php?id='. $row['staff_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil  text-black"></span></a>';
                                            echo '<a href="../staffCrud/deleteStaff.php?id='. $row['staff_id'] .'" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this staff?\')"><span class="fa fa-trash text-black"></span></a>';
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

