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

$sqlmainDishes = "SELECT * FROM items WHERE item_category = 'Main Dishes' ORDER BY item_type; ";
$resultmainDishes = mysqli_query($link, $sqlmainDishes);
$mainDishes = mysqli_fetch_all($resultmainDishes, MYSQLI_ASSOC);

$sqldrinks = "SELECT * FROM items WHERE item_category = 'Drinks' ORDER BY item_type; ";
$resultdrinks = mysqli_query($link, $sqldrinks);
$drinks = mysqli_fetch_all($resultdrinks, MYSQLI_ASSOC);

$sqlsides = "SELECT * FROM items WHERE item_category = 'Side Snacks' ORDER BY item_type; ";
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>




<div class="btn-group btn-group-toggle sticky-top" data-toggle="buttons">
      <h5 class="mb-0">
        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#MainDishPanel" aria-expanded="true" aria-controls="MainDishPanel">
          Main Dishes
        </button>
      </h5>

      <h5 class="mb-0">
        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#SideDishPanel" aria-expanded="true" aria-controls="SideDishPanel">
          Side Dishes
        </button>
      </h5>


      <h5 class="mb-0">
        <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#DrinksPanel" aria-expanded="true" aria-controls="DrinksPanel">
          Drinks
        </button>
      </h5>
</div>


   

    <div id="MainDishPanel " class="collapse show " aria-labelledby="headingOne" >
        <div class="mx-auto w-25 ">
            <div class="card-body ">
                <?php foreach ($mainDishes as $item): 
                    if($item['item_type'] == 'Burgers & Sandwiches')?>
                  <div class="shadow p-3 mb-5 bg-white rounded " style="width: 18rem;"> 
                    <div class="card-body ">
                      <h5 class="card-title" ><?php echo $item['item_name']; ?></h5>
                      <h6 class="card-subtitle mb-1 text-muted">RM <?php echo $item['item_price']; ?></h6>
                        <ul class="list-group list-group-flush ">
                          <li class="list-group-item"><?php echo $item['item_description']; ?></li>
                          <li class="list-group-item">Type: <?php echo $item['item_type']; ?></li>
                        </ul>
                    </div>
                  </div>
                  <?php endforeach; ?>
            </div>
          </div>
      </div>


    <div id="SideDishPanel" class="collapse hide" aria-labelledby="headingOne" >
        <div class="row">
            <div class="card-body col">
                <?php foreach ($sides as $item): ?>
                  <div class="card mb-2" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title" ><?php echo $item['item_name']; ?></h5>
                      <h6 class="card-subtitle mb-1 text-muted">RM <?php echo $item['item_price']; ?></h6>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><?php echo $item['item_description']; ?></li>
                          <li class="list-group-item">Type: <?php echo $item['item_type']; ?></li>
                        </ul>
                    </div>
                  </div>
                  <?php endforeach; ?>
            </div>
          </div>
      </div>


    <div id="DrinksPanel" class="collapse hide" aria-labelledby="headingOne" >
        <div class="row">
            <div class="card-body col">
                <?php foreach ($drinks as $item): ?>
                  <div class="card mb-2" style="width: 18rem;">
                    <div class="card-body">
                      <h5 class="card-title" ><?php echo $item['item_name']; ?></h5>
                      <h6 class="card-subtitle mb-1 text-muted">RM <?php echo $item['item_price']; ?></h6>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item"><?php echo $item['item_description']; ?></li>
                          <li class="list-group-item">Type: <?php echo $item['item_type']; ?></li>
                        </ul>
                    </div>
                  </div>
                  <?php endforeach; ?>
            </div>
          </div>
      </div>
    
  


