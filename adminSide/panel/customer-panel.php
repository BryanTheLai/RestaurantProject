<?php
session_start(); // Ensure session is started
require_once '../posBackend/checkIfLoggedIn.php';
?>
<?php include '../inc/dashHeader.php'; ?>
    <style>
        .wrapper{ width: 60%; padding-left: 200px; padding-top: 20px  }
    </style>

<div class="wrapper">
    <div class="container-fluid pt-5 pl-600">
        <div class="row">
            <div class="m-50">
                <div class="mt-5 mb-3">
                    <h2 class="pull-left">Membership Details</h2>
                    <a href="../customerCrud/createCust.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Membership</a>
                </div>
                <div class="mb-3">
                    <form method="POST" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <input required type="text" id="search" name="search" class="form-control" placeholder="Enter Member ID, Name">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-dark">Search</button>
                            </div>
                            <div class="col" style="text-align: right;" >
                                <a href="customer-panel.php" class="btn btn-light">Show All</a>
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

                        // Modified query to search memberships by member_name or member_id
                        /*
                        $sql = "SELECT *
                                FROM Memberships M
                                INNER JOIN Accounts A ON M.account_id = A.account_id
                                WHERE M.member_name LIKE '%$search%' OR M.member_id = '$search'
                                ORDER BY M.member_id";
                         */
                        $sql = "SELECT * FROM Memberships WHERE member_name LIKE '%$search%' OR member_id = '$search'ORDER BY member_id";
                    } else {
                        // Default query to fetch all memberships with account information
                         /* 
                         
                        $sql = "SELECT *
                                FROM Memberships M
                                INNER JOIN Accounts A ON M.account_id = A.account_id
                                ORDER BY M.member_id";
                         * 
                         */
                        $sql = "SELECT * FROM Memberships ORDER BY member_id";
                    }
                } else {
                    // Default query to fetch all memberships with account information
                    /*
                    $sql = "SELECT *
                            FROM Memberships M
                            INNER JOIN Accounts A ON M.account_id = A.account_id
                            ORDER BY M.member_id";
                     * 
                     */
                     $sql = "SELECT * FROM Memberships ORDER BY member_id";
                }


                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th style='width:7em;'>Member Id</th>";
                        echo "<th>Member Name</th>";
                        echo "<th style='width:7em;'>Points</th>";
                        echo "<th>Account ID</th>";
                        //echo "<th>Email</th>";
                        //echo "<th>Phone Number</th>";
                        //echo "<th style='width:5em;'>Delete</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['member_id'] . "</td>";
                            echo "<td>" . $row['member_name'] . "</td>";
                            echo "<td>" . $row['points'] . "</td>";
                            echo "<td>" . $row['account_id'] . "</td>";
                            //echo "<td>" . $row['email'] . "</td>";
                            //echo "<td>" . $row['phone_number'] . "</td>";
                          //  echo "<td>";
                         //   $deleteSQL = "DELETE FROM Memberships WHERE member_id = '" . $row['member_id'] . "';";
                         //   echo '<a href="../customerCrud/deleteCustomerVerify.php?id=' . $row['member_id'] . '" title="Delete Record" data-toggle="tooltip" '
                         //           . 'onclick="return confirm(\'Admin permission Required!\n\nAre you sure you want to delete this Member?\n\nThis will alter other modules related to this Member!\n\')"><span class="fa fa-trash text-black"></span></a>';
                          //  echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/dashFooter.php'; ?>
