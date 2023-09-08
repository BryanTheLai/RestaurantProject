<?php
session_start(); // Ensure session is started
?>
<?php include '../inc/dashHeader.php'; ?>
    <style>
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 20px  }
    </style>
<div class="wrapper">
    <div class="container-fluid pt-5 pl-600">
        <div class="row">
            <div class="m-50">
                <div class="mt-5 mb-3">
                    <h2 class="pull-left">Reservation Details</h2>
                    <a href="../reservationsCrud/createReservation.php" class="btn btn-outline-dark"><i class="fa fa-plus"></i> Add Reservation</a>
                </div>
                <div class="mb-3">
                    <form method="POST" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" id="search" name="search" class="form-control" placeholder="Enter Reservation ID, Customer Name">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-light">Search</button>
                            </div>
                            <div class="col-md-3">
                                <a href="reservation-panel.php" class="btn btn-info">Show All</a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <?php
                // Include config file
                require_once "../config.php";
                $sql = "SELECT * FROM reservations ORDER BY reservation_id;";

                if (isset($_POST['search'])) {
                    if (!empty($_POST['search'])) {
                        $search = $_POST['search'];

                        $sql = "SELECT * FROM reservations WHERE reservation_id LIKE '%$search%' OR customer_name LIKE '%$search%'";
                    } else {
                        // Default query to fetch all reservations
                        $sql = "SELECT * FROM reservations ORDER BY reservation_id;";
                    }
                } else{
                    $sql = "SELECT * FROM reservations ORDER BY reservation_id;";
                }
                
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Customer Name</th>";
                        echo "<th>Table ID</th>";
                        echo "<th>Reservation Time</th>";
                        echo "<th>Reservation Date</th>";
                        echo "<th>Head Count</th>";
                        echo "<th>Special Request</th>";
                        echo "<th>Delete</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['reservation_id'] . "</td>";
                            echo "<td>" . $row['customer_name'] . "</td>";
                            echo "<td>" . $row['table_id'] . "</td>";
                            echo "<td>" . $row['reservation_time'] . "</td>";
                            echo "<td>" . $row['reservation_date'] . "</td>";
                            echo "<td>" . $row['head_count'] . "</td>";
                            echo "<td>" . $row['special_request'] . "</td>";
                            echo "<td>";
                            echo '<a href="../reservationsCrud/deleteReservation.php?id='. $row['reservation_id'] .'" title="Delete Record" data-toggle="tooltip" onclick="return confirm(\'Are you sure you want to delete this reservation?\')"><span class="fa fa-trash text-black"></span></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
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
