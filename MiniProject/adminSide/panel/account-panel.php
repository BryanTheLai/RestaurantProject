<?php include '../inc/dashHeader.php'; ?>

<div class="wrapper">
    <div class="container-fluid pt-5 pl-600">
        <div class="row">
            <div class="m-50">
                <div class="mt-5 mb-3">
                    <h2 class="pull-left">Members and Staff Account Details</h2>
                    <a href="../accountCrud/createStaffAccount.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Staff Account</a>
                    <a href="../accountCrud/createMemberAccount.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Member Account</a>
                </div>
                <?php
                // Include config file
                require_once "../config.php";

                // Attempt select query execution
                $sql = "SELECT *, 
                               IF(Accounts.staff_id IS NOT NULL, 'staff', 'member') AS account_type
                        FROM Accounts
                        LEFT JOIN Memberships ON Accounts.membership_id = Memberships.member_id
                        LEFT JOIN Staffs ON Accounts.staff_id = Staffs.staff_id
                        ORDER BY account_id;";

                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Account ID</th>";
                        echo "<th>Email</th>";
                        echo "<th>Register Date</th>";
                        echo "<th>Phone Number</th>";
                        echo "<th>Account Type</th>"; // Display account type
                        echo "<th>Staff ID</th>";
                        echo "<th>Delete</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['account_id'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['register_date'] . "</td>";
                            echo "<td>" . $row['phone_number'] . "</td>";
                            echo "<td>" . ucfirst($row['account_type']) . "</td>"; // Display account type
                            echo "<td>" . $row['staff_id'] . "</td>";
                            echo "<td>";
                            $deleteSQL = "DELETE FROM Accounts WHERE account_id = '" . $row['account_id'] . "';";
                            echo '<a href="../accountCrud/deleteAccount.php?id=' . $row['account_id'] . '" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this account?\')"><span class="fa fa-trash text-black"></span></a>';
                            echo "</td>";
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
