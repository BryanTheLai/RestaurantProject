<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','restaurantdb');

//Create Connection
$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check COnnection
if($link->connect_error){ //if not Connection
die('Connection Failed'.$link->connect_error);//kills the Connection OR terminate execution
}

$sqlmainDishes = "SELECT * FROM menu WHERE item_category = 'Main Dishes' ORDER BY item_type; ";
$resultmainDishes = mysqli_query($link, $sqlmainDishes);
$mainDishes = mysqli_fetch_all($resultmainDishes, MYSQLI_ASSOC);

$sqldrinks = "SELECT * FROM menu WHERE item_category = 'Drinks' ORDER BY item_type; ";
$resultdrinks = mysqli_query($link, $sqldrinks);
$drinks = mysqli_fetch_all($resultdrinks, MYSQLI_ASSOC);

$sqlsides = "SELECT * FROM menu WHERE item_category = 'Side Snacks' ORDER BY item_type; ";
$resultsides = mysqli_query($link, $sqlsides);
$sides = mysqli_fetch_all($resultsides, MYSQLI_ASSOC);

$sqlPasta = "SELECT * FROM menu WHERE item_type = 'Pasta' ORDER BY item_type; ";
$resultPasta = mysqli_query($link, $sqlPasta);
$Pasta = mysqli_fetch_all($resultPasta, MYSQLI_ASSOC);

$sqlBurgers = "SELECT * FROM menu WHERE item_type = 'Burgers & Sandwiches' ORDER BY item_type; ";
$resultBurgers = mysqli_query($link, $sqlBurgers);
$Burgers = mysqli_fetch_all($resultBurgers , MYSQLI_ASSOC);

$sqlLamb = "SELECT * FROM menu WHERE item_type = 'Lamb' ORDER BY item_type; ";
$resultLamb = mysqli_query($link, $sqlLamb);
$Lamb = mysqli_fetch_all($resultLamb , MYSQLI_ASSOC);

$sqlSeafood = "SELECT * FROM menu WHERE item_type = 'Seafood' ORDER BY item_type; ";
$resultSeafood = mysqli_query($link, $sqlSeafood);
$Seafood = mysqli_fetch_all($resultSeafood , MYSQLI_ASSOC);

$sqlChicken = "SELECT * FROM menu WHERE item_type = 'Chicken' ORDER BY item_type; ";
$resultChicken = mysqli_query($link, $sqlChicken);
$Chicken= mysqli_fetch_all($resultChicken , MYSQLI_ASSOC);

$sqlSoup = "SELECT * FROM menu WHERE item_type = 'Soup' ORDER BY item_type; ";
$resultSoup = mysqli_query($link, $sqlSoup);
$Soup= mysqli_fetch_all($resultSoup , MYSQLI_ASSOC);

$sqlSalad = "SELECT * FROM menu WHERE item_type = 'Salad ' ORDER BY item_type; ";
$resultSalad  = mysqli_query($link, $sqlSalad );
$Salad = mysqli_fetch_all($resultSalad  , MYSQLI_ASSOC);

$sqlBites = "SELECT * FROM menu WHERE item_type = 'Bar Bites' ORDER BY item_type; ";
$resultBites  = mysqli_query($link, $sqlBites );
$Bites = mysqli_fetch_all($resultBites  , MYSQLI_ASSOC);

$sqlSteak = "SELECT * FROM menu WHERE item_type = 'Steak & Ribs' ORDER BY item_type; ";
$resultSteak  = mysqli_query($link, $sqlSteak );
$Steak = mysqli_fetch_all($resultSteak  , MYSQLI_ASSOC);

$sqlSides = "SELECT * FROM menu WHERE item_type = 'Side Dishes' ORDER BY item_type; ";
$resultSides  = mysqli_query($link, $sqlSides);
$Sides = mysqli_fetch_all($resultSides , MYSQLI_ASSOC);

$sqlDesert = "SELECT * FROM menu WHERE item_type = 'House Dessert' ORDER BY item_type; ";
$resultDesert  = mysqli_query($link, $sqlDesert);
$Desert = mysqli_fetch_all($resultDesert , MYSQLI_ASSOC);

$sqlKids = "SELECT * FROM menu WHERE item_type = 'Shoney Kid' ORDER BY item_type; ";
$resultKids  = mysqli_query($link, $sqlKids);
$Kids = mysqli_fetch_all($resultKids , MYSQLI_ASSOC);

$sqlJuice = "SELECT * FROM menu WHERE item_type = 'Chilled Juice' ORDER BY item_type; ";
$resultJuice  = mysqli_query($link, $sqlJuice);
$Juice= mysqli_fetch_all($resultJuice , MYSQLI_ASSOC);

$sqlSoda = "SELECT * FROM menu WHERE item_type = 'Canned Soda' ORDER BY item_type; ";
$resultSoda  = mysqli_query($link, $sqlSoda);
$Soda= mysqli_fetch_all($resultSoda , MYSQLI_ASSOC);

$sqlColdPressedJuice = "SELECT * FROM menu WHERE item_type = 'Cold Pressed Juice' ORDER BY item_type; ";
$resultColdPressedJuice  = mysqli_query($link, $sqlColdPressedJuice );
$ColdPressedJuice = mysqli_fetch_all($resultColdPressedJuice  , MYSQLI_ASSOC);

$sqlIceBlended = "SELECT * FROM menu WHERE item_type = 'Fruity Ice Blended' ORDER BY item_type; ";
$resultIceBlended  = mysqli_query($link, $sqlIceBlended);
$IceBlended= mysqli_fetch_all($resultIceBlended , MYSQLI_ASSOC);

$sqlCoffee = "SELECT * FROM menu WHERE item_type = 'Coffee & Chocolate' ORDER BY item_type; ";
$resultCoffee  = mysqli_query($link, $sqlCoffee);
$Coffee= mysqli_fetch_all($resultCoffee , MYSQLI_ASSOC);

$sqlTea = "SELECT * FROM menu WHERE item_type = 'Tea' ORDER BY item_type; ";
$resultTea  = mysqli_query($link, $sqlTea);
$Tea= mysqli_fetch_all($resultTea , MYSQLI_ASSOC);

$sqlFlowerTea = "SELECT * FROM menu WHERE item_type = 'Flower Tea' ORDER BY item_type; ";
$resultFlowerTea  = mysqli_query($link, $sqlFlowerTea);
$FlowerTea= mysqli_fetch_all($resultFlowerTea , MYSQLI_ASSOC);

$sqlFlavoredIceTea = "SELECT * FROM menu WHERE item_type = 'Flavored Ice Tea' ORDER BY item_type; ";
$resultFlavoredIceTea  = mysqli_query($link, $sqlFlavoredIceTea);
$FlavoredIceTea= mysqli_fetch_all($resultFlavoredIceTea , MYSQLI_ASSOC);

$sqlFrozenFruitYogurt = "SELECT * FROM menu WHERE item_type = 'Frozen Fruit Yogurt' ORDER BY item_type; ";
$resultFrozenFruitYogurt  = mysqli_query($link, $sqlFrozenFruitYogurt);
$FrozenFruitYogurt= mysqli_fetch_all($resultFrozenFruitYogurt , MYSQLI_ASSOC);

$sqlMilkshakes = "SELECT * FROM menu WHERE item_type = 'Milkshakes' ORDER BY item_type; ";
$resultMilkshakes  = mysqli_query($link, $sqlMilkshakes);
$Milkshakes= mysqli_fetch_all($resultMilkshakes , MYSQLI_ASSOC);

$sqlMocktails = "SELECT * FROM menu WHERE item_type = 'Mocktails' ORDER BY item_type; ";
$resultMocktails  = mysqli_query($link, $sqlMocktails);
$Mocktails= mysqli_fetch_all($resultMocktails , MYSQLI_ASSOC);

$sqlHouseWines = "SELECT * FROM menu WHERE item_type = 'House Wines' ORDER BY item_type; ";
$resultHouseWines = mysqli_query($link, $sqlHouseWines);
$HouseWines= mysqli_fetch_all($resultHouseWines, MYSQLI_ASSOC);

$sqlHousePour = "SELECT * FROM menu WHERE item_type = 'House Pour' ORDER BY item_type; ";
$resultHousePour  = mysqli_query($link, $sqlHousePour);
$HousePour= mysqli_fetch_all($resultHousePour , MYSQLI_ASSOC);

$sqlBeer = "SELECT * FROM menu WHERE item_type = 'Beer' ORDER BY item_type; ";
$resultBeer  = mysqli_query($link, $sqlBeer);
$Beer= mysqli_fetch_all($resultBeer , MYSQLI_ASSOC);

$sqlLiquor= "SELECT * FROM menu WHERE item_type = 'Liquor' ORDER BY item_type; ";
$resultLiquor  = mysqli_query($link, $sqlLiquor);
$Liquor= mysqli_fetch_all($resultLiquor , MYSQLI_ASSOC);

$sqlClassicCocktails = "SELECT * FROM menu WHERE item_type = 'Classic Cocktails' ORDER BY item_type; ";
$resultClassicCocktails  = mysqli_query($link, $sqlClassicCocktails);
$ClassicCocktails= mysqli_fetch_all($resultClassicCocktails , MYSQLI_ASSOC);

$sqlHouseCocktails = "SELECT * FROM menu WHERE item_type = 'House Cocktails' ORDER BY item_type; ";
$resultHouseCocktails  = mysqli_query($link, $sqlHouseCocktails);
$HouseCocktails= mysqli_fetch_all($resultHouseCocktails , MYSQLI_ASSOC);


// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo '<div class="user-profile">';
    echo 'Welcome, ' . $_SESSION["member_name"] . '!';
    echo '<a href="../customerProfile/profile.php">Profile</a>';
    echo '</div>';
    
}

session_start();
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
          <a class="nav-link" href="../home/home.php#hero">
            <h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> JOHNNY'S</h1><span class="sr-only"></span>
          </a>
        </a>
      </div>
      <div class="nav-list">
        <div class="hamburger">
          <div class="bar"></div>
        </div>
        <ul>
          <li><a href="#hero" data-after="Home">Home</a></li>
          <li><a href="../CustomerReservation/reservePage.php" data-after="Service">Reservation</a></li>
          <li><a href="#projects" data-after="Projects">Menu</a></li>
          <li><a href="#about" data-after="About">About</a></li>
          <li><a href="#contact" data-after="Contact">Contact</a></li>
          
        
    <!-- Check if the user is logged in -->
<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
   <li><a href="../customerLogin/logout.php" data-after="LogOut">Log Out</a></li>
   <li>
    <a href="../customerProfile/profile.php" class="profile-link">
      <?php echo $_SESSION["member_name"] . ' - 1000 Points'; ?>
    </a>
  </li>

<?php else: ?>
  <li><a href="../customerLogin/register.php" data-after="SignUp">Sign Up</a></li>
  <li><a href="../customerLogin/login.php" data-after="LogIn">Log In</a></li>
<?php endif; ?>
<li><a href="../../adminSide/StaffLogin/login.php" data-after="Staff">Staff</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- End Header -->
<!-- Hero Section with Video Background and Text Overlay -->
<section id="hero" style="position: relative;">
    <video autoplay loop muted playsinline poster="your-poster-image.jpg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        <source src="../image/video (2160p).mp4" type="video/mp4">
        <!-- Add additional source elements for other video formats if needed -->
    </video>
    <div class="hero container" style="position: relative; z-index: 1;">
        <div>
            <h1><strong><h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> JOHNNY'S</h1><span></span></strong></h1>
            <h1><strong style="color:white;">DINING & BAR<span></span></strong></h1>
            <a href="#projects" type="button" class="cta">MENU</a>
        </div>
    </div>
</section>
<!-- End Hero Section -->
  
  
  
  <!-- menu Section -->
  <section id="projects">
    <div class="projects container">
      <div class="projects-header">
        <h1 class="section-title">Me<span>n</span>u</h1>
      </div>
     
        
       <select id="menu-category" class="menu-category">
      <option>CHOOSE MENU CATEGORY</option>
      <option value="yellow">MAIN DISHES</option>
      <option value="red">SIDE DISHES</option>
      <option value="green">DRINKS</option>
       <option value="blue">ALL CATEGORY</option>
    </select>
        
    <div class="yellow msg"> 
     
        <div></div>
      <div class="mainDish">
           <h1 style="text-align:center">MAIN DISHES</h1>
          <?php foreach ($mainDishes as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">RM<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
        
      </p>
    <?php endforeach; ?>
      </div>
    </div>
      
      
    <div class="red msg">
        <div></div>
      <div class="sideDish">
           <h1 style="text-align:center">SIDE DISHES</h1>
          <?php foreach ($sides as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">RM<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
    </div>
        
      
      
    <div class="green msg">
        <div></div>
      <div class="drinks">
           <h1 style="text-align:center">DRINKS</h1>
          <?php foreach ($drinks as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">RM<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <span class="item_type"><i><img src="<?php echo $item['item_img']; ?>" alt=""></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
    </div>
      
      
       <div class="blue msg">
           
           
      <div class="mainDish">
           <h1 style="text-align:center">MAIN DISHES</h1>
          <?php foreach ($mainDishes as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">RM<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
             
           
     
      <div class="sideDish">
           <h1 style="text-align:center">SIDE DISHES</h1>
          <?php foreach ($sides as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">RM<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
            
      
      <div class="drinks">
           <h1 style="text-align:center">DRINKS</h1>
          <?php foreach ($drinks as $item): ?>
      <p>
        <span class="item-name"> <strong><?php echo $item['item_name']; ?></strong></span>
        <span class="item-price">RM<?php echo $item['item_price']; ?></span><br>
        <span class="item_type"><i><?php echo $item['item_type']; ?></i></span>
        <hr>
      </p>
    <?php endforeach; ?>
      </div>
          
      </div>
    </div>
  </section>
  <!-- End menu Section -->


  
  <!-- About Section -->
<section id="about" style="background-image: url('../image/aboutusBackground.jpg'); background-size: cover; background-position: center;">
  <div class="about container">
    <div class="col-right">
        <h1 class="section-title" style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">About <span>Us</span></h1>
        <h2>Johnny's DINING & BAR Company History:</h2>
 <p>Johnny's Dining & Bar is a well-established Western food establishment in the city's heart. Johnny's Dining & Bar has become a popular choice for customers looking to celebrate special occasions or simply enjoy a relaxing meal, with a focus on providing delicious meals and a friendly dining experience.
 </p>
 <p>Johnny's Dining & Bar, as a Western restaurant, offers a diverse menu that caters to a variety of tastes. The menu includes a wide range of options such as bar bites, salads, soups and a variety of main courses. Customers can savour succulent options such as steak and ribs, chicken, lamb, seafood, burgers and sandwiches, pasta, and a variety of delectable side dishes. The menu has been carefully curated to offer a balance of classic favourites and innovative creations, ensuring that every palate is satisfied.
 </p>
 <p>Johnny's Dining & Bar's ability to accommodate customers is one of its distinguishing features. Johnny's Dining & Bar strives to create an inviting and comfortable dining environment, whether guests prefer to walk in or make reservations in advance. The restaurant recognises the significance of creating memorable experiences, particularly for those celebrating special occasions. Johnny's Dining & Bar is a popular choice for families, couples, and groups of friends because of its attentive staff and welcoming atmosphere.
 </p>
 <p>Johnny's Dining & Bar has an inviting outdoor bar that is open seven days a week from 11:00 AM to 10:00 PM in addition to the indoor dining area.This outdoor space provides a relaxed setting for patrons to unwind and socialise while sipping on their favourite drinks and nibbling on bar bites. The bar serves a wide range of beverages, including cocktails, wines, beers and non-alcoholic options.
 </p>
    
      </div>
    </div>
  </section>
  <!-- End About Section -->

  
  
  
  
 <!-- Contact Section -->
<section id="contact" style="background-image: url('../image/aboutusBackground.jpg'); background-size: cover; background-position: center;">
  <div class="contact container">
    <div>
      <h1 class="section-title">Contact <span>info</span></h1>
    </div>
    <div class="contact-items">
      <div class="contact-item contact-item-bg">
        <i class="fa-sharp fa-solid fa-phone fa-beat"></i>
        <div class="contact-info">
          <i class="fa-sharp fa-solid fa-phone fa-beat"></i>
          <div class='icon'><img src="../image/icons8-phone-100.png" alt=""/></div>
          <h1>Phone</h1>
          <h2>+60 886 8786</h2>
        </div>
      </div>
      
      <div class="contact-item contact-item-bg"> 
        <div class="contact-info">
          <div class='icon'><img src="../image/icons8-email-100.png" alt=""/></div>
          <h1>Email</h1>
          <h2>johnny's_Bar&Grill@gmail.com</h2> 
        </div>
      </div>
      
      <div class="contact-item contact-item-bg">
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
        font-family: 'Montserrat', sans-serif;
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
   .menu-category {
  font-size: 24px;
  padding: 10px;
  border: 2px solid black; /* Red border */
  outline: none;
  cursor: pointer;
  transition: border-color 0.3s ease, background-color 0.3s ease, color 0.3s ease;
  color: #000; /* Black text */
  background-color: #fff; /* White background */
  border-radius: 0; /* No border radius (sharp corners) */
}

/* Style the option text in the select dropdown */
.menu-category option {
  font-size: 20px;
}

/* Hover effect */
.menu-category:hover {
  background-color: black; /* Red background on hover */
  color: white; /* Black text on hover */
}

      /* Use CSS Grid to create three columns */
      .msg {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Three columns with equal width */
        grid-gap: 24px; /* Adjust the gap between items */
      }

      /* Style the menu item content */
      .msg p {
        margin: 5px 0;
      }
      
    .item-name {
  display: inline-block; /* Ensure items are displayed on separate lines */
  width: 100%; /* Adjust the width as needed */
  float: left;
}

.item-price {
  display: inline-block; /* Ensure prices are displayed on separate lines */
  width: 30%; /* Adjust the width as needed */
  float: right;
}

.user-profile {
    display: flex;
    align-items: center;
    color: white;
    margin-right: 20px;
}

.user-profile a {
    margin-left: 10px;
    color: white;
    text-decoration: none;
}

/* Style for the profile link */
.profile-link {
  border: 1px solid #fff; /* Smaller border style and color */
  padding: 3px 8px; /* Smaller padding inside the border */
  border-radius: 3px; /* Rounded corners for the border */
  text-decoration: none; /* Remove the default underline */
  color: #fff; /* Text color */
  margin-left: auto; /* Automatically push the link to the right */
  margin-right: 10px; /* Add a small right margin for spacing */
}

/* Style for the "About Us" section content */
/* Style for the "About Us" section content */
#about {
  padding: 100px 0; /* Adjust the padding as needed */
  background-image: url('../image/aboutusBackground.jpg');
  background-size: 150%; /* Cover the entire section with the background image */
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed; /* Fixed background to stay in place */
  color: white; /* Set text color to white */
  text-align: center; /* Center the text */
  position: relative; /* Set the position to relative for centering */
  height: 150%; /* Set the section height to the viewport height */
  overflow: hidden; /* Hide any overflowing content */
}


#about .section-title {
  font-size: 36px; /* Adjust the font size */
  text-align: center;
  margin-bottom: 20px;
}

#about .col-left {
  /* Styles for the left column (if needed) */
}

#about .col-right {
  background-color: rgba(0, 0, 0, 0.7); /* Add a semi-transparent black background */
  padding: 20px;
  border-radius: 5px;
  /* Other styles for the right column */
}

#about .col-right h2 {
  font-size: 24px; /* Adjust the font size */
  color: white; /* Text color for the right column */
}

#about .col-right p {
  font-size: 18px; /* Adjust the font size */
  color: white; /* Text color for the right column */
}


/* Style for the "Contact" section */
#contact {
  background-image: url('../image/aboutusBackground.jpg');
  background-size: 150%; /* Increase the size of the background image (e.g., 150%) */
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed; /* Fixed background to stay in place */
  color: white; /* Set text color to white */
  text-align: center; /* Center the text */
  position: relative; /* Set the position to relative for centering */
  height: 100vh; /* Set the section height to the viewport height */
  overflow: hidden;
  padding: 100px 0; /* Adjust the padding as needed */
}


#contact .section-title {
  color: white;
}


#contact .col-right {
  background-color: rgba(0, 0, 255, 0.5); /* Semi-transparent blue background */
  padding: 20px;
  border-radius: 5px;
}


#contact .col-right h2 {
  font-size: 24px; /* Adjust the font size */
  color: white; /* Text color for the right column */
}

#contact .col-right p {
  font-size: 18px; /* Adjust the font size */
  color: white; /* Text color for the right column */
}

/* Style for the contact-item containers */
.contact-item-bg {
  background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black background */
  padding: 20px;
  border-radius: 5px;
  margin-bottom: 20px; /* Add margin between contact items */
}

.contact-item-bg h1,
.contact-item-bg h2 {
  color: white; /* Text color for the contact items */
}

.contact-item-bg i {
  color: #fff; /* Icon color */
}

.contact-item-bg .icon img {
  width: 80px; /* Adjust the width of the icon images */
  height: 80px; /* Adjust the height of the icon images */
}

/* Add other styles for the contact items as needed */


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
    
    
    
    
    
    

  $(document).ready(function(){
    // Function to filter menu items based on search input
    function filterMenuItems(searchTerm) {
      $(".item-name").each(function() {
        var itemName = $(this).text().toLowerCase();
        if (itemName.includes(searchTerm)) {
          $(this).closest(".msg").show();
        } else {
          $(this).closest(".msg").hide();
        }
      });
    }
    
    // Search button click event
    $("#search-button").click(function() {
      var searchTerm = $("#search-input").val().toLowerCase();
      filterMenuItems(searchTerm);
    });
    
    // Search input keyup event
    $("#search-input").keyup(function() {
      var searchTerm = $(this).val().toLowerCase();
      filterMenuItems(searchTerm);
    });
  });


    </script>

</body>

</html>