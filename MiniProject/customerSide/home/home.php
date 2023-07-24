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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>My Website</title>
</head>

<body>
  <!-- Header -->
  <section id="header">
    <div class="header container">
      <div class="nav-bar">
        <div class="brand">
          <a href="#hero">
            <h1>Shoney's</h1>
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
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- End Header -->


  <!-- Hero Section  -->
  <section id="hero">
    <div class="hero container">
      <div>
          <h1><strong style="color:goldenrod;">SHONEY'S<span></span></strong></h1>
          <h1><strong style="color:goldenrod;">DINING & BAR<span></span></strong></h1>
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
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
        <div class="service-item">
          <div class="icon"><img src="https://img.icons8.com/bubbles/100/000000/services.png" /></div>
          <h2>Web Design</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis rerum, magni voluptatem sed
            architecto placeat beatae tenetur officia quod</p>
        </div>
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
      <div class="all-projects">
          
        <div class="project-item">
          <div class="project-info">
              <h1> <strong> SHONEY'S PLATTER</strong></h1>
            <h2>﻿RM188</h2>
            <p>Serves 4-6 persons
Generous serving of grilled Jumbo Shrimps, Fried Calamari, Chicken & Vegetable Skewers, Southern Fried Chicken, Lamb Chops, Beef Sausage, our famous BBQ Ribs accompanied with Vegetables of the day, Buttered Corn & Cajun Potato Cubes.
</p>
          </div>
          <div class="project-img">
            <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
        <div class="project-item">
          <div class="project-info">
            <h1>BAR BITES</h1>
               <?php foreach ($Bites as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
            <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
        <div class="project-item">
          <div class="project-info">
              <h1>SALAD</h1>
                <?php foreach ($Salad as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
              
              <h1>SOUP </h1>
                 <?php foreach ($Soup as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
        <div class="project-item">
          <div class="project-info">
            <h1>STEAK & RIB</h1>
            
                    <?php foreach ($Steak as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
        <div class="project-item">
          <div class="project-info">
            <h1>CHICKEN</h1>
           
        <?php foreach ($Chicken as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
            <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
            <div class="project-item">
          <div class="project-info">
            <h1>LAMB</h1>  
          <?php foreach ($Lamb as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
  
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
            <div class="project-item">
          <div class="project-info">
            <h1>SEAFOOD</h1>
            
               <?php foreach ($Seafood as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
          
            <div class="project-item">
          <div class="project-info">
            <h1>BURGERS & SANDWICHES</h1>
             <?php foreach ($Burgers as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>


          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
            <div class="project-item">
          <div class="project-info">
            <h1>PASTA</h1>
            <?php foreach ($Pasta as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>

          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          
            <div class="project-item">
          <div class="project-info">
            <h1>SIDE DISHES</h1>
            <?php foreach ($Sides as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          <div class="project-item">
          <div class="project-info">
            <h1>HOUSE DESERT</h1>
            <?php foreach ($Desert as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          <div class="project-item">
          <div class="project-info">
            <h1>SHONEY'S KIDS</h1>
            <?php foreach ($Kids as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
          <h1 class="section-title">Drinks</h1>
          
            <div class="project-item">
          <div class="project-info">
            <h1>CHILLED JUICE</h1>
            <?php foreach ($Juice as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
            </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
           <div class="project-item">
          <div class="project-info">
            <h1>CANNED SODA</h1>
            <?php foreach ($Soda as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
        </div>
          
           <div class="project-item">
          <div class="project-info">
            <h1>CANNED SODA</h1>
            <?php foreach ($Soda as $item): ?>
                <p><?php echo $item['item_name']; ?> RM<?php echo $item['item_price']; ?><p>
                <?php endforeach; ?>
          </div>
          <div class="project-img">
             <img src="image/344398852_973575807343422_1569924326631336402_n.jpg" alt="img">
          </div>
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
         <img src="image/shoney's logo.png" alt=""/>
        </div>
      </div>
      <div class="col-right">
        <h1 class="section-title">About <span>Us</span></h1>
        <h2>SHONEY'S DINING & BAR Company History:</h2>
 <p>Shoney's Dining & Bar is a well-established Western food establishment in the city's heart. Shoney's Dining & Bar has become a popular choice for customers looking to celebrate special occasions or simply enjoy a relaxing meal, with a focus on providing delicious meals and a friendly dining experience.
 </p>
 <p>Shoney's Dining & Bar, as a Western restaurant, offers a diverse menu that caters to a variety of tastes. The menu includes a wide range of options such as bar bites, salads, soups and a variety of main courses. Customers can savour succulent options such as steak and ribs, chicken, lamb, seafood, burgers and sandwiches, pasta, and a variety of delectable side dishes. The menu has been carefully curated to offer a balance of classic favourites and innovative creations, ensuring that every palate is satisfied.
 </p>
 <p>Shoney's Dining & Bar's ability to accommodate customers is one of its distinguishing features. Shoney's Dining & Bar strives to create an inviting and comfortable dining environment, whether guests prefer to walk in or make reservations in advance. The restaurant recognises the significance of creating memorable experiences, particularly for those celebrating special occasions. Shoney's Dining & Bar is a popular choice for families, couples, and groups of friends because of its attentive staff and welcoming atmosphere.
 </p>
 <p>Shoney's Dining & Bar has an inviting outdoor bar that is open seven days a week from 11:00 AM to 10:00 PM in addition to the indoor dining area.This outdoor space provides a relaxed setting for patrons to unwind and socialise while sipping on their favourite drinks and nibbling on bar bites. The bar serves a wide range of beverages, including cocktails, wines, beers and non-alcoholic options.
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
              <div class='icon'><img src="image/icons8-phone-100.png" alt=""/></div>
            <h1>Phone</h1>
            <h2>+60 886 8786</h2>
          </div>
        </div>
          
          
          
        <div class="contact-item"> 
          <div class="contact-info">
              <div class='icon'><img src="image/icons8-email-100.png" alt=""/></div>
            <h1>Email</h1>
            <h2>shoney's_Bar&Grill@gmail.com</h2> 
          </div>
        </div>
          
          
        <div class="contact-item">
            <div class="contact-info">
                <div class='icon'> <img src="image/icons8-home-address-100.png" alt=""/></div>
                
               
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
          <h1>SHONEY'S DINING & BAR</h1>
      </div>
      <h2>Your Complete Web Solution</h2>
      <div class="social-icon">
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/facebook-new.png" /></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/instagram-new.png" /></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/twitter.png" /></a>
        </div>
        <div class="social-item">
          <a href="#"><img src="https://img.icons8.com/bubbles/100/000000/behance.png" /></a>
        </div>
      </div>
      <p>Copyright © 2023 SHONEY's. All rights reserved</p>
    </div>
  </section>
  <!-- End Footer -->
  <script src="../js/app.js"></script>
</body>

</html>