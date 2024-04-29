<?php
session_start(); // Ensure session is started
require_once 'checkIfLoggedIn.php';
?>
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

<div class="container" style="text-align: center; width:100%; margin-top:3rem; margin-left: 2rem;  ">
    <div id="POS-Content" class="row" >
        <div class="row center-middle">
          

            <div class="col-md-15" style="margin-left: 17rem; margin-top: 0rem;max-height: 700px; overflow-y: auto;">
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
                        if ($table_count % 5 == 0) {
                            echo '</div><div class="row justify-content-center">';
                        }
                        $table_id = $row['table_id'];
                        $capacity = $row['capacity'];
                        

                        $sqlBill = "SELECT bill_id FROM Bills WHERE table_id = $table_id ORDER BY bill_time DESC LIMIT 1";
                        $result1 = $link->query($sqlBill);
                        $latestBillData = $result1->fetch_assoc();
                        
                         // Check if the table is reserved for the selected time
                        date_default_timezone_set('Asia/Singapore'); // Set the time zone to Singapore

                        $selectedDate = date("Y-m-d"); // Get the current date, you can change this to your selected date
                        $endTime = date("H:i:s"); // Get the current time, you can change this to your selected time

                        // Calculate the end time of the 20-minute range
                        $startTime = date("H:i:s", strtotime($endTime) - (20 * 60));
                        // Check if there's a reservation within the 20-minute range
                        $reservationQuery = "SELECT * FROM reservations WHERE table_id = $table_id AND reservation_date = '$selectedDate' AND reservation_time BETWEEN '$startTime' AND '$endTime'";
                        $reservationResult = mysqli_query($link, $reservationQuery);
                        
                        //Show all reservations
                        
                        //

                        if ($latestBillData) {
                            $latestBillID = $latestBillData['bill_id'];

                            $sqlBillItems = "SELECT * FROM bill_items WHERE bill_id = $latestBillID";
                            $result2 = $link->query($sqlBillItems);
                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                $billItemColor = 'rgb(216, 0, 50)'; // Bill has associated bill items (red)
                            } else {
                                $billItemColor = 'rgb(23, 89, 74)'; // Bill has no associated bill items (rgb(23, 89, 74))
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

                            $box_color = $hasPaymentTime ? 'rgb(23, 89, 74)' : $billItemColor;
                        } else {
                            $latestBillID = null;
                            $box_color = 'gray'; // No bill for the table (gray)
                        }

                        echo '<div class="col-md-2 mb-3">';
                        if ($reservationResult && mysqli_num_rows($reservationResult) > 0) {
                                // The table is reserved for the selected time, so set the color accordingly
                            echo '<a href="orderItem.php?bill_id=' . $latestBillID . '&table_id=' . $table_id . '"class="btn btn-primary btn-block btn-lg" style="color:black; '
                                    . 'background-color: rgb(248, 222, 34);justify-content: center; align-items: center; display: flex; width: 9rem; height: 9rem;">'
                                    . 'Table: ' . $table_id /* . '<br>Bill ID: ' . $latestBillID */. '<br>Capacity: ' . $capacity;
                        } else{
                            echo '<a href="orderItem.php?bill_id=' . $latestBillID . '&table_id=' . $table_id . '"class="btn btn-primary btn-block btn-lg" '
                                    . 'style="background-color: ' . $box_color . ';justify-content: center; align-items: center; display: flex; width: 9rem; height: 9rem;">Table:'
                                    . ' ' . $table_id /*. '<br>Bill ID: ' . $latestBillID */. '<br>Capacity: ' . $capacity;
                        }
                        echo '</a></div>';
                        $table_count++;
                    }
                    // ...
                    } else {
                        echo "Error fetching tables: " . mysqli_error($link);
                    }
                    ?>
                </div>
           
              <div class="row d-flex justify-content-around"style="margin-top: 2rem;" >
                <div class="col-md-3">
                    <div class="alert alert-success" role="alert" style="color:white;background-color: rgb(23, 89, 74);" data-toggle="tooltip" data-placement="top" title="Tables That are Free">
                        Available
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-danger" role="alert" style="color:white;background-color: rgb(216, 0, 50);" data-toggle="tooltip" data-placement="top" title="Tables That are Used">
                        Occupied
                    </div>
                </div>
                <!--
                <div class="col-md-3">
                    <div class="alert alert-dark" role="alert">
                        No Bill Id
                    </div>
                </div>
                -->
                <div class="col-md-3">
                    <div class="alert alert-warning" style="color:black;background-color: rgb(248, 222, 34);" role="alert" data-toggle="tooltip" data-placement="top" title="Tables That are Reserved">
                        Reserved
                    </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../inc/dashFooter.php' ?>

