<?php
session_start(); // Ensure session is started
require_once '../posBackend/checkIfLoggedIn.php';
include '../inc/dashHeader.php'; 
require_once '../config.php';

?>


    



<div class="container-fluid">
    
    <div class="row">
        
        <div class="col-md-6 order-md-1  " style="margin-top: 6rem; margin-left: 15rem;">
            <h2 class="pull-left">Search Member</h2>
            <form method="get" action="#">
                <div class="row">
                    <div class="col-md-6">
                        <input required type="text" id="member_id" style="width:150px" name="member_id" class="form-control" placeholder="Enter Member ID">
                    </div>
                    <div class="col-md-6">
                        <button type="submit"  class="btn btn-dark">Search</button>
                    </div> 
                </div>
            </form><br>
            
            <?php
            require_once '../config.php';
            $currentMonthStart = date('Y-m-01');
            $currentMonthEnd = date('Y-m-t');

            // Get the current month and year in the format 'YYYY-MM'
            $currentMonth = date('Y-m');

            $memberId = isset($_GET['member_id']) ? $_GET['member_id'] : 1;
            // Get member's most ordered items
            $mostOrderedItemsQuery = "SELECT Menu.item_name, SUM(Bill_Items.quantity) AS order_count
                                      FROM Bill_Items
                                      INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                                      INNER JOIN Bills ON Bill_Items.bill_id = Bills.bill_id
                                      WHERE Bills.member_id = $memberId
                                      GROUP BY Bill_Items.item_id
                                      ORDER BY order_count DESC";
            $mostOrderedItemsResult = mysqli_query($link, $mostOrderedItemsQuery);
            // Check if any results were returned
            if(mysqli_num_rows($mostOrderedItemsResult) == 0) {
                echo "Member ID not found.";
            }
            else {
            ?>          
            <h3>Showing Member ID - <?php echo $memberId; ?></h3>
            <h3>Most Ordered Items - (All Time)</h3>
            <table class="table ">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($mostOrderedItemsResult)) : ?>
                        <tr>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['order_count']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-10 order-md-2" style="margin-top: 3rem; margin-left: -10rem;">
        <div class="container-fluid pt-5  row">
            <h3>Top 5 Favourites - (All Time)</h3>
            <div style="width: 800px; height: 800px;">
                <canvas id="mostOrderedItemsChart"></canvas>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get data for the donut chart
    <?php
    $chartLabels = [];
    $chartData = [];

    $chartItemsResult = mysqli_query($link, $mostOrderedItemsQuery);
    $itemCount = 0;

    while ($row = mysqli_fetch_assoc($chartItemsResult)) {
        if ($itemCount >= 5) {
            break;
        }
        array_push($chartLabels, $row['item_name']);
        array_push($chartData, $row['order_count']);
        $itemCount++;
    }
    ?>

    // Create the donut chart
    var ctx = document.getElementById('mostOrderedItemsChart');
    
    var mostOrderedItemsChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($chartData); ?>,
                backgroundColor: [
                    'rgb(8, 32, 50)',
                    'rgb(255, 76, 41)',
                    'rgb(13, 18, 130)',
                    'rgb(143, 67, 238)',
                    'rgb(179, 19, 18)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'right'
            },
            is3D:true
        }
    });
</script>



<?php include '../inc/dashFooter.php';  // Include your footer file here ?>
