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

$sqlPasta = "SELECT * FROM items WHERE item_type = 'Pasta' ORDER BY item_type; ";
$resultPasta = mysqli_query($link, $sqlPasta);
$Pasta = mysqli_fetch_all($resultPasta, MYSQLI_ASSOC);

$sqlBurgers = "SELECT * FROM items WHERE item_type = 'Burgers & Sandwiches' ORDER BY item_type; ";
$resultBurgers = mysqli_query($link, $sqlBurgers);
$Burgers = mysqli_fetch_all($resultBurgers , MYSQLI_ASSOC);

$sqlLamb = "SELECT * FROM items WHERE item_type = 'Lamb' ORDER BY item_type; ";
$resultLamb = mysqli_query($link, $sqlLamb);
$Lamb = mysqli_fetch_all($resultLamb , MYSQLI_ASSOC);

$sqlSeafood = "SELECT * FROM items WHERE item_type = 'Seafood' ORDER BY item_type; ";
$resultSeafood = mysqli_query($link, $sqlSeafood);
$Seafood = mysqli_fetch_all($resultSeafood , MYSQLI_ASSOC);

$sqlChicken = "SELECT * FROM items WHERE item_type = 'Chicken' ORDER BY item_type; ";
$resultChicken = mysqli_query($link, $sqlChicken);
$Chicken= mysqli_fetch_all($resultChicken , MYSQLI_ASSOC);

$sqlSoup = "SELECT * FROM items WHERE item_type = 'Soup' ORDER BY item_type; ";
$resultSoup = mysqli_query($link, $sqlSoup);
$Soup= mysqli_fetch_all($resultSoup , MYSQLI_ASSOC);

$sqlSalad = "SELECT * FROM items WHERE item_type = 'Salad ' ORDER BY item_type; ";
$resultSalad  = mysqli_query($link, $sqlSalad );
$Salad = mysqli_fetch_all($resultSalad  , MYSQLI_ASSOC);

$sqlBites = "SELECT * FROM items WHERE item_type = 'Bar Bites' ORDER BY item_type; ";
$resultBites  = mysqli_query($link, $sqlBites );
$Bites = mysqli_fetch_all($resultBites  , MYSQLI_ASSOC);

$sqlSteak = "SELECT * FROM items WHERE item_type = 'Steak & Ribs' ORDER BY item_type; ";
$resultSteak  = mysqli_query($link, $sqlSteak );
$Steak = mysqli_fetch_all($resultSteak  , MYSQLI_ASSOC);

$sqlSides = "SELECT * FROM items WHERE item_type = 'Side Dishes' ORDER BY item_type; ";
$resultSides  = mysqli_query($link, $sqlSides);
$Sides = mysqli_fetch_all($resultSides , MYSQLI_ASSOC);

$sqlDesert = "SELECT * FROM items WHERE item_type = 'House Dessert' ORDER BY item_type; ";
$resultDesert  = mysqli_query($link, $sqlDesert);
$Desert = mysqli_fetch_all($resultDesert , MYSQLI_ASSOC);

$sqlKids = "SELECT * FROM items WHERE item_type = 'Shoney Kid' ORDER BY item_type; ";
$resultKids  = mysqli_query($link, $sqlKids);
$Kids = mysqli_fetch_all($resultKids , MYSQLI_ASSOC);

$sqlJuice = "SELECT * FROM items WHERE item_type = 'Chilled Juice' ORDER BY item_type; ";
$resultJuice  = mysqli_query($link, $sqlJuice);
$Juice= mysqli_fetch_all($resultJuice , MYSQLI_ASSOC);

$sqlSoda = "SELECT * FROM items WHERE item_type = 'Canned Soda' ORDER BY item_type; ";
$resultSoda  = mysqli_query($link, $sqlSoda);
$Soda= mysqli_fetch_all($resultSoda , MYSQLI_ASSOC);

$sqlColdPressedJuice = "SELECT * FROM items WHERE item_type = 'Cold Pressed Juice' ORDER BY item_type; ";
$resultColdPressedJuice  = mysqli_query($link, $sqlColdPressedJuice );
$ColdPressedJuice = mysqli_fetch_all($resultColdPressedJuice  , MYSQLI_ASSOC);

$sqlIceBlended = "SELECT * FROM items WHERE item_type = 'Fruity Ice Blended' ORDER BY item_type; ";
$resultIceBlended  = mysqli_query($link, $sqlIceBlended);
$IceBlended= mysqli_fetch_all($resultIceBlended , MYSQLI_ASSOC);

$sqlCoffee = "SELECT * FROM items WHERE item_type = 'Coffee & Chocolate' ORDER BY item_type; ";
$resultCoffee  = mysqli_query($link, $sqlCoffee);
$Coffee= mysqli_fetch_all($resultCoffee , MYSQLI_ASSOC);

$sqlTea = "SELECT * FROM items WHERE item_type = 'Tea' ORDER BY item_type; ";
$resultTea  = mysqli_query($link, $sqlTea);
$Tea= mysqli_fetch_all($resultTea , MYSQLI_ASSOC);

$sqlFlowerTea = "SELECT * FROM items WHERE item_type = 'Flower Tea' ORDER BY item_type; ";
$resultFlowerTea  = mysqli_query($link, $sqlFlowerTea);
$FlowerTea= mysqli_fetch_all($resultFlowerTea , MYSQLI_ASSOC);

$sqlFlavoredIceTea = "SELECT * FROM items WHERE item_type = 'Flavored Ice Tea' ORDER BY item_type; ";
$resultFlavoredIceTea  = mysqli_query($link, $sqlFlavoredIceTea);
$FlavoredIceTea= mysqli_fetch_all($resultFlavoredIceTea , MYSQLI_ASSOC);

$sqlFrozenFruitYogurt = "SELECT * FROM items WHERE item_type = 'Frozen Fruit Yogurt' ORDER BY item_type; ";
$resultFrozenFruitYogurt  = mysqli_query($link, $sqlFrozenFruitYogurt);
$FrozenFruitYogurt= mysqli_fetch_all($resultFrozenFruitYogurt , MYSQLI_ASSOC);

$sqlMilkshakes = "SELECT * FROM items WHERE item_type = 'Milkshakes' ORDER BY item_type; ";
$resultMilkshakes  = mysqli_query($link, $sqlMilkshakes);
$Milkshakes= mysqli_fetch_all($resultMilkshakes , MYSQLI_ASSOC);

$sqlMocktails = "SELECT * FROM items WHERE item_type = 'Mocktails' ORDER BY item_type; ";
$resultMocktails  = mysqli_query($link, $sqlMocktails);
$Mocktails= mysqli_fetch_all($resultMocktails , MYSQLI_ASSOC);

$sqlHouseWines = "SELECT * FROM items WHERE item_type = 'House Wines' ORDER BY item_type; ";
$resultHouseWines = mysqli_query($link, $sqlHouseWines);
$HouseWines= mysqli_fetch_all($resultHouseWines, MYSQLI_ASSOC);

$sqlHousePour = "SELECT * FROM items WHERE item_type = 'House Pour' ORDER BY item_type; ";
$resultHousePour  = mysqli_query($link, $sqlHousePour);
$HousePour= mysqli_fetch_all($resultHousePour , MYSQLI_ASSOC);

$sqlBeer = "SELECT * FROM items WHERE item_type = 'Beer' ORDER BY item_type; ";
$resultBeer  = mysqli_query($link, $sqlBeer);
$Beer= mysqli_fetch_all($resultBeer , MYSQLI_ASSOC);

$sqlLiquor= "SELECT * FROM items WHERE item_type = 'Liquor' ORDER BY item_type; ";
$resultLiquor  = mysqli_query($link, $sqlLiquor);
$Liquor= mysqli_fetch_all($resultLiquor , MYSQLI_ASSOC);

$sqlClassicCocktails = "SELECT * FROM items WHERE item_type = 'Classic Cocktails' ORDER BY item_type; ";
$resultClassicCocktails  = mysqli_query($link, $sqlClassicCocktails);
$ClassicCocktails= mysqli_fetch_all($resultClassicCocktails , MYSQLI_ASSOC);

$sqlHouseCocktails = "SELECT * FROM items WHERE item_type = 'House Cocktails' ORDER BY item_type; ";
$resultHouseCocktails  = mysqli_query($link, $sqlHouseCocktails);
$HouseCocktails= mysqli_fetch_all($resultHouseCocktails , MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Home</title>
</head>

<body>
  <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#hero">
            <a class="nav-link" href="../home/home.php#hero"> <h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> JOHNNY'S</h1><span class="sr-only"></span></a>
          </a>
        </div>
        <div class="nav-list">
          <div class="hamburger">
            <div class="bar"></div>
          </div>
          <ul>
            <li><a href="#hero" data-after="Home">Home</a></li>
            <li><a href="#services" data-after="Service">Reservation</a></li>
            <li><a href="#projects" data-after="Projects">Menu</a></li>
            <li><a href="#about" data-after="About">About</a></li>
            <li><a href="#contact" data-after="Contact">Contact</a></li>
            <li><a href="../signup/signup.php" data-after="SignUp">Sign Up</a></li>
            
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->


  <!-- Hero Section  -->
  <section id="hero" style='background-color: black;'>
    <div class="hero container">
      <div>
          <h1><strong><h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> JOHNNY'S</h1><span></span></strong></h1>
          <h1><strong style="color:white;">DINING & BAR<span></span></strong></h1>
        <a href="#projects" type="button" class="cta">MENU</a>
      </div>
    </div>
  </section>
  <!-- End Hero Section  -->

  <!-- Service Section -->
  <section id="services">
    <div class="services container">
      <div class="service-top">
        <h1 class="section-title">Reser<span>v</span>ation</h1>
        <p></p>
      </div>
      <div class="service-bottom">
        <div class="service-item">
          <div class="icon"><img src="../image/https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>name</h2>
          <p>-------ruybffffffffdisfyudsbigfusdfvdioffidufhsdhuifdvfhudusfhsodviiiiiiiiiiiihuf-------------------------------------</p>
        </div>
        <div class="service-item">
          <div class="icon"><img src="../image/https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>phone num</h2>
          <p>-----------fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff----------d</p>
        </div>
       
        
    </div>
  </section>
  <!-- End Service Section -->
  
  
  <!-- menu Section -->
  <section id="projects">
    <div class="projects container">
      <div class="projects-header">
        <h1 class="section-title">Me<span>n</span>u</h1>
      </div>
     
        
       <select>
      <option>Choose Menu Category</option>
      <option value="yellow">MAIN DISHES</option>
      <option value="red">SIDE DISHES</option>
      <option value="green">DRINKS</option>
       <option value="blue">ALL CATEGORY</option>
    </select>
        
    <div class="yellow msg"> 
      <h1>MAIN DISHES</h1>
       <p>&nbsp;&nbsp;&nbsp;</p> 
      <?php foreach ($mainDishes as $item): ?>
        <p><?php echo $item['item_name']; ?> &nbsp;&nbsp;&nbsp;RM<?php echo $item['item_price']; ?></p>
      <?php endforeach; ?>
      </div>
      
      
    <div class="red msg">
      <h1>SIDE DISHES</h1>
       <p>&nbsp;&nbsp;&nbsp;</p> 
      <?php foreach ($sides as $item): ?>
        <p><?php echo $item['item_name']; ?> &nbsp;&nbsp;&nbsp;RM<?php echo $item['item_price']; ?></p>
      <?php endforeach; ?>
    </div>
      
      
    <div class="green msg">
      <h1>DRINKS</h1>
       <p>&nbsp;&nbsp;&nbsp;</p> 
      <?php foreach ($drinks as $item): ?>
        <p><?php echo $item['item_name']; ?>&nbsp;&nbsp;&nbsp; RM<?php echo $item['item_price']; ?></p>
      <?php endforeach; ?>
    </div>
      
      
       <div class="blue msg">
           <h1>MAIN DISHES</h1>
            <p>&nbsp;&nbsp;&nbsp;</p> 
           <?php foreach ($mainDishes as $item): ?>
        <p><?php echo $item['item_name']; ?>&nbsp;&nbsp;&nbsp; RM<?php echo $item['item_price']; ?></p>
      <?php endforeach; ?>
        
         <p>&nbsp;&nbsp;&nbsp;</p> 
         <p>&nbsp;&nbsp;&nbsp;</p> 
  
           <h1>SIDE DISHES</h1>
            <p>&nbsp;&nbsp;&nbsp;</p> 
      <?php foreach ($sides as $item): ?>
        <p><?php echo $item['item_name']; ?>&nbsp;&nbsp;&nbsp; RM<?php echo $item['item_price']; ?></p>
      <?php endforeach; ?>
        
          <p>&nbsp;&nbsp;&nbsp;</p> 
          <p>&nbsp;&nbsp;&nbsp;</p> 
          
      <h1>DRINKS</h1>
       <p>&nbsp;&nbsp;&nbsp;</p> 
      <?php foreach ($drinks as $item): ?>
        <p><?php echo $item['item_name']; ?> &nbsp;&nbsp;&nbsp;RM<?php echo $item['item_price']; ?></p>
      <?php endforeach; ?>
    </div>
          
      </div>
    </div>
  </section>
  <!-- End Projects Section -->

  <!-- About Section -->
  <section id="about">
    <div class="about container">
      <div class="col-left">
        <div class="about-img">
         <img src="../image/Johnny's logo.png" alt=""/>
        </div>
      </div>
      <div class="col-right">
        <h1 class="section-title">About <span>Us</span></h1>
        <h2>Johnny's DINING & BAR Company History:</h2>
 <p>Johnny's Dining & Bar is a well-established Western food establishment in the city's heart. Johnny's Dining & Bar has become a popular choice for customers looking to celebrate special occasions or simply enjoy a relaxing meal, with a focus on providing delicious meals and a friendly dining experience.
 </p>
 <p>Johnny's Dining & Bar, as a Western restaurant, offers a diverse menu that caters to a variety of tastes. The menu includes a wide range of options such as bar bites, salads, soups and a variety of main courses. Customers can savour succulent options such as steak and ribs, chicken, lamb, seafood, burgers and sandwiches, pasta, and a variety of delectable side dishes. The menu has been carefully curated to offer a balance of classic favourites and innovative creations, ensuring that every palate is satisfied.
 </p>
 <p>Johnny's Dining & Bar's ability to accommodate customers is one of its distinguishing features. Johnny's Dining & Bar strives to create an inviting and comfortable dining environment, whether guests prefer to walk in or make reservations in advance. The restaurant recognises the significance of creating memorable experiences, particularly for those celebrating special occasions. Johnny's Dining & Bar is a popular choice for families, couples, and groups of friends because of its attentive staff and welcoming atmosphere.
 </p>
 <p>Johnny's Dining & Bar has an inviting outdoor bar that is open seven days a week from 11:00 AM to 10:00 PM in addition to the indoor dining area.This outdoor space provides a relaxed setting for patrons to unwind and socialise while sipping on their favourite drinks and nibbling on bar bites. The bar serves a wide range of beverages, including cocktails, wines, beers and non-alcoholic options.
 </p>
     <a href="#" class="cta">Download Resume</a>
      </div>
    </div>
  </section>
  <!-- End About Section -->

  
  
  
  
  
  
  <!-- Contact Section -->
  <section id="contact">
    <div class="contact container">
      <div>
        <h1 class="section-title">Contact <span>info</span></h1>
      </div>
      <div class="contact-items">
        <div class="contact-item">
          <i class="fa-sharp fa-solid fa-phone fa-beat"></i>
          <div class="contact-info">
              <i class="fa-sharp fa-solid fa-phone fa-beat"></i>
              <div class='icon'><img src="../image/icons8-phone-100.png" alt=""/></div>
            <h1>Phone</h1>
            <h2>+60 886 8786</h2>
          </div>
        </div>
          
          
          
        <div class="contact-item"> 
          <div class="contact-info">
              <div class='icon'><img src="../image/icons8-email-100.png" alt=""/></div>
            <h1>Email</h1>
            <h2>johnny's_Bar&Grill@gmail.com</h2> 
          </div>
        </div>
          
          
        <div class="contact-item">
            <div class="contact-info">
                <div class='icon'> <img src="../image/icons8-home-address-100.png" alt=""/></div>
                
               
            <h1>Address</h1>
            <h2>Lot 52, Ground Floor, Jalan Gaya, No.1, Lorong Ewan, Kota Kinabalu, Malaysia, 88000</h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact Section -->

  
  
  
  
  <!-- Footer -->
  <section id="footer">
    <div class="footer container">
      <div class="brand">
          <h1>JOHNNY'S DINING & BAR</h1>
      </div>
      <h2>Your Complete Web Solution</h2>
      <div class="social-icon">
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/facebook-new.png" /></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/instagram-new.png" /></a>
        </div>
      </div>
      <p>Copyright © 2023 JOHNNY's. All rights reserved</p>
    </div>
  </section>
  <!-- End Footer -->
  <script src="../js/app.js"></script>
   <style type="text/css">
      .msg {
        margin-top: 25px;
        padding: 25px;
        display: none;
        color: black;
      }
      .yellow {
        background: #fff;
      }
      .green {
        background: #fff;
      }
      .red {
        background: #fff;
      }

      /* Styling the select button */
      select {
        font-size: 16px;
        padding: 10px;
        border: 1px solid #ff0000; /* Red border */
        outline: none;
        cursor: pointer;
        transition: border-color 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        color: #000; /* Black text */
        background-color: #fff; /* White background */
        border-radius: 0; /* No border radius (sharp corners) */
      }

      /* Style the option text in the select dropdown */
      option {
        font-size: 16px;
      }

      /* Hover effect */
      select:hover {
        background-color: #ff0000; /* Red background on hover */
        color: black; /* black text on hover */
      }

      /* Use CSS Grid to create three columns */
      .msg {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Three columns with equal width */
        grid-gap: 20px; /* Adjust the gap between items */
      }

      /* Style the menu item content */
      .msg p {
        margin: 5px 0;
      }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var val = $(this).attr("value");
                if(val){
                    $(".msg").not("." + val).hide();
                    $("." + val).show();
                } else{
                    $(".msg").hide();
                }
            });
        }).change();
    });
    </script>

</body>

</html>