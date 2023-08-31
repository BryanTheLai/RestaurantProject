<?php 
include '../inc/dashHeader.php'; 
require_once '../config.php';

?>

<div class="row">
        <div class="col-md-10 order-md-2" style="margin-top: 3rem; margin-left: 20rem;">
            <div class="container-fluid pt-5  row">
            <h3>List of Most Purchased Items</h3>

            <!-- Sorting form and button -->
             <div class="col d-flex justify-content-end">
                 
                 <!-- 
                <a href="?sortOrder=desc" class=" btn btn-primary">Most</a>

                <a href="?sortOrder=asc" class=" btn btn-primary">Least</a>
                Ascending sort button -->
            </div>
            <div>
                <?php
                // Get the sorting order from the form or use default (ascending)
                $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'desc';

                $menuItemSalesQuery = "SELECT Menu.item_name, SUM(Bill_Items.quantity) AS total_quantity
                                       FROM Bill_Items
                                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                                       GROUP BY Menu.item_name
                                       ORDER BY total_quantity $sortOrder"; // Modify query here

                $menuItemSalesResult = mysqli_query($link, $menuItemSalesQuery);

                echo '<table class="table" >';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Item Name</th>';
                echo '<th>Units</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = mysqli_fetch_assoc($menuItemSalesResult)) {
                    echo '<tr>';
                    echo '<td>' . $row['item_name'] . '</td>';
                    echo '<td>' . $row['total_quantity'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 order-md-1 col" style="margin-top: 3rem; margin-left: 15rem;">
            <div class="container pt-3 row">
                <!-- Add a div for Google Charts -->
                <div id="mostPurchased" style="width: 120%; max-width: 1000px; height: 500px;"></div>
            </div>
            <div class="container pt-3 row">
                <!-- Add a div for Google Charts -->
                <div id="mostPurchasedMain" style="width: 120%; max-width: 1000px; height: 500px;"></div>
            </div>
            <div class="container pt-3 row">
                <!-- Add a div for Google Charts -->
                <div id="mostPurchasedDrinks" style="width: 120%; max-width: 1000px; height: 500px;"></div>
            </div>
            <div class="container pt-3 row">
                <!-- Add a div for Google Charts -->
                <div id="mostPurchasedSide" style="width: 120%; max-width: 1000px; height: 500px;"></div>
            </div>
        </div>
    </div>
</div>



<!-- Load Google Charts library -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(mostPurchasedChart);
    google.charts.setOnLoadCallback(mostPurchasedDrinksChart);
    google.charts.setOnLoadCallback(mostPurchasedMainChart);
    google.charts.setOnLoadCallback(mostPurchasedSideChart);

    function mostPurchasedChart() {
        const data = google.visualization.arrayToDataTable([
            ['Item Name', 'Total Quantity'],
            <?php
            $topPurchasedItemsQuery = "SELECT Menu.item_name, SUM(Bill_Items.quantity) AS total_quantity
                                       FROM Bill_Items
                                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                                       GROUP BY Menu.item_name
                                       ORDER BY total_quantity DESC
                                       LIMIT 10";
            $topPurchasedItemsResult = mysqli_query($link, $topPurchasedItemsQuery);

            while ($row = mysqli_fetch_assoc($topPurchasedItemsResult)) {
                echo "['{$row['item_name']}', {$row['total_quantity']}],";
            }
            ?>
        ]);

        const options = {
            title: 'Top 10 Most Purchased Items',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('mostPurchased'));
        chart.draw(data, options);
    }
    function mostPurchasedDrinksChart() {
        const data = google.visualization.arrayToDataTable([
            ['Item Name', 'Total Quantity'],
            <?php
            $topPurchasedItemsQuery = "SELECT Menu.item_name, SUM(Bill_Items.quantity) AS total_quantity
                                       FROM Bill_Items
                                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                                       WHERE item_category = 'Drinks'
                                       GROUP BY Menu.item_name
                                       ORDER BY total_quantity DESC
                                       LIMIT 10";
            $topPurchasedItemsResult = mysqli_query($link, $topPurchasedItemsQuery);

            while ($row = mysqli_fetch_assoc($topPurchasedItemsResult)) {
                echo "['{$row['item_name']}', {$row['total_quantity']}],";
            }
            ?>
        ]);

        const options = {
            title: 'Top 10 Most Purchased Drinks',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('mostPurchasedDrinks'));
        chart.draw(data, options);
    }
    function mostPurchasedMainChart() {
        const data = google.visualization.arrayToDataTable([
            ['Item Name', 'Total Quantity'],
            <?php
            $topPurchasedItemsQuery = "SELECT Menu.item_name, SUM(Bill_Items.quantity) AS total_quantity
                                       FROM Bill_Items
                                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                                       WHERE item_category = 'Main Dishes'
                                       GROUP BY Menu.item_name
                                       ORDER BY total_quantity DESC
                                       LIMIT 10";
            $topPurchasedItemsResult = mysqli_query($link, $topPurchasedItemsQuery);

            while ($row = mysqli_fetch_assoc($topPurchasedItemsResult)) {
                echo "['{$row['item_name']}', {$row['total_quantity']}],";
            }
            ?>
        ]);

        const options = {
            title: 'Top 10 Most Purchased Main Dishes',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('mostPurchasedMain'));
        chart.draw(data, options);
    }
    function mostPurchasedSideChart() {
        const data = google.visualization.arrayToDataTable([
            ['Item Name', 'Total Quantity'],
            <?php
            $topPurchasedItemsQuery = "SELECT Menu.item_name, SUM(Bill_Items.quantity) AS total_quantity
                                       FROM Bill_Items
                                       INNER JOIN Menu ON Bill_Items.item_id = Menu.item_id
                                       WHERE item_category = 'Side Snacks'
                                       GROUP BY Menu.item_name
                                       ORDER BY total_quantity DESC
                                       LIMIT 10";
            $topPurchasedItemsResult = mysqli_query($link, $topPurchasedItemsQuery);

            while ($row = mysqli_fetch_assoc($topPurchasedItemsResult)) {
                echo "['{$row['item_name']}', {$row['total_quantity']}],";
            }
            ?>
        ]);

        const options = {
            title: 'Top 10 Most Purchased Side Snacks',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('mostPurchasedSide'));
        chart.draw(data, options);
    }
</script>
