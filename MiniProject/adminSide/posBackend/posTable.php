<?php
include '../inc/dashHeader.php';
require_once '../config.php'; // Include your database configuration
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../css/pos.css" rel="stylesheet" />
</head>
<body>

<div class="container">
    <div id="POS-Content" class="row">
        <div class="row center-middle">
            <div class="row" style="margin-top: 3rem;">
                <div class="col-md-4">
                    <div class="alert alert-success" role="alert">
                        Free
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-danger" role="alert">
                        Ordered
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-dark" role="alert">
                        No Bill Id
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-left: 17rem; margin-top: 0rem;max-height: 700px; overflow-y: auto;">
                <div class="row justify-content-center">
                    
                    
                    <?php
                    // Fetch all tables from the database
                    $query = "SELECT * FROM Restaurant_Tables ORDER BY table_id;";
                    $result = mysqli_query($link, $query);
                    $table = array("", "", "");
                    if ($result) {
                        $table_count = 0;
                    // ...
while ($row = mysqli_fetch_assoc($result)) {
    if ($table_count % 3 == 0) {
        echo '</div><div class="row justify-content-center">';
    }
    $table_id = $row['table_id'];
    $capacity = $row['capacity'];

    $sqlBill = "SELECT bill_id FROM Bills WHERE table_id = $table_id ORDER BY bill_time DESC LIMIT 1";
    $result1 = $link->query($sqlBill);
    $latestBillData = $result1->fetch_assoc();

    if ($latestBillData) {
        $latestBillID = $latestBillData['bill_id'];

        $sqlBillItems = "SELECT * FROM bill_items WHERE bill_id = $latestBillID";
        $result2 = $link->query($sqlBillItems);
        if ($result2 && mysqli_num_rows($result2) > 0) {
            $billItemColor = 'red'; // Bill has associated bill items (red)
        } else {
            $billItemColor = 'green'; // Bill has no associated bill items (green)
        }

        $paymentTimeQuery = "SELECT payment_time FROM Bills WHERE bill_id = $latestBillID";
        $paymentTimeResult = $link->query($paymentTimeQuery);
        $hasPaymentTime = false;

        if ($paymentTimeResult && $paymentTimeResult->num_rows > 0) {
            $paymentTimeRow = $paymentTimeResult->fetch_assoc();
            if (!empty($paymentTimeRow['payment_time'])) {
                $hasPaymentTime = true;
            }
        }

        $box_color = $hasPaymentTime ? 'green' : $billItemColor;
    } else {
        $latestBillID = null;
        $box_color = 'gray'; // No bill for the table (gray)
    }

    echo '<div class="col-md-4 mb-4">';
    echo '<a href="orderItem.php?bill_id=' . $latestBillID . '&table_id=' . $table_id . '"class="btn btn-primary btn-block btn-lg" style="background-color: ' . $box_color . ';justify-content: center; align-items: center; display: flex; width: 9rem; height: 9rem;">Table: ' . $table_id . '<br>Bill ID: ' . $latestBillID . '<br>Capacity: ' . $capacity;
    echo '</a></div>';
    $table_count++;
}
// ...





                    } else {
                        echo "Error fetching tables: " . mysqli_error($link);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/dashFooter.php' ?>

