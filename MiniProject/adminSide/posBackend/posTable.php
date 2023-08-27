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
            <div class="col-md-12" style="max-height: 600px; overflow-y: auto;">
                <div class="row justify-content-center">
                    <?php
                    // Fetch all tables from the database
                    $query = "SELECT * FROM Restaurant_Tables ORDER BY table_id;";
                    $result = mysqli_query($link, $query);

                    if ($result) {
                        $table_count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($table_count % 3 == 0) {
                                echo '</div><div class="row justify-content-center">';
                            }
                            $table_id = $row['table_id'];
                            $capacity = $row['capacity'];
                            $is_available = $row['is_available'];
                            $box_color = $is_available ? 'green' : 'red';
                            echo '<div class="col-md-4 mb-4">';
                            echo '<a href="orderItem.php?table_id=' . $table_id . '" class="btn btn-primary btn-block btn-lg" style="background-color: ' . $box_color . ';justify-content: center; align-items: center; display: flex; width: 9rem; height: 9rem;">Table: ' . $table_id . '<br>Capacity: ' . $capacity . '</a>';
                            echo '</div>';
                            $table_count++;
                        }
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

