<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','restaurantDB');

//Create Connection
$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($link->connect_error){ //if not Connection
die('Connection Failed'.$link->connect_error);//kills the Connection OR terminate execution
}

$sqlmainDishes = 'SELECT * FROM items WHERE item_category = "Main Dishes"; ';
$resultmainDishes = mysqli_query($link, $sqlmainDishes);
$mainDishes = mysqli_fetch_all($resultmainDishes, MYSQLI_ASSOC);

$sqldrinks = 'SELECT * FROM items WHERE item_category = "Drinks"; ';
$resultdrinks = mysqli_query($link, $sqldrinks);
$drinks = mysqli_fetch_all($resultdrinks, MYSQLI_ASSOC);

$sqlsides = 'SELECT * FROM items WHERE item_category = "Side Snacks"; ';
$resultsides = mysqli_query($link, $sqlsides);
$sides = mysqli_fetch_all($resultsides, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Shoney's Menu</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-o8cuXfAPcIxWlDMQ3kOcYn9Jp6B8qtkZOr8NOEW8i/i3h6zCsgQciC3XxvVCNikw" crossorigin="anonymous"></script>



<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
          <?php foreach ($mainDishes as $item): ?>
            <div class="card mb-2" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $item['item_name']; ?></h5>
                <h6 class="card-subtitle mb-1 text-muted">RM <?php echo $item['item_price']; ?></h6>
                <p class="card-text"><?php echo $item['item_description']; ?></p>
                <p class="card-text">Type: <?php echo $item['item_type']; ?></p>
              </div>
            </div>
            <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>


