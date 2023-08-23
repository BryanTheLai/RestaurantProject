<?php
include '../inc/dashHeader.php';
require_once '../config.php'; // Include your database configuration
$searchErr = '';
$reservation_details = array();

if (isset($_POST['search'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];

        $query = "SELECT * FROM Menu WHERE item_name LIKE '%$search%'";
        $result = mysqli_query($link, $query);
    } else {
        $searchErr = "Please enter the information";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your head content here -->
</head>
<body>
<div class="container">
    <div id="POS-Content" class="row">
        <p>This is the content of the center-aligned div.</p>
        <h1>Reservation Search</h1>
        <form method="POST" action="#">
            <label for="search">Search by Reservation ID:</label>
            <input type="text" id="search" name="search" placeholder="Enter Reservation ID">
            <button type="submit">Search</button>
        </form>

        <!-- Your content goes here -->
        <p>This is the content of the center-aligned div.</p>

        <h3><u>Search Result</u></h3><br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Table ID</th>
                    <th>Reservation Time</th>
                    <th>Reservation Date</th>
                    <th>Head Count</th>
                    <th>Special Request</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (empty($result)) {
                    echo '<tr><td colspan="8">No data found</td></tr>';
                } else {
                    foreach ($result as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['reservation_id'] . '</td>';
                        echo '<td>' . $row['customer_name'] . '</td>';
                        echo '<td>' . $row['table_id'] . '</td>';
                        echo '<td>' . $row['reservation_time'] . '</td>';
                        echo '<td>' . $row['reservation_date'] . '</td>';
                        echo '<td>' . $row['head_count'] . '</td>';
                        echo '<td>' . $row['special_request'] . '</td>';
                        echo '<td>';
                        echo '<a href="pos-panel.php?reservation_id=' . $row['reservation_id'] . '" class="btn btn-primary" title="View Details">Order</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include footer -->
<?php include '../inc/dashFooter.php' ?>
</body>
</html>
