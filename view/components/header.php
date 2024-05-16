<?php
require_once 'processes/database-connection.php';

$current_url = "$_SERVER[REQUEST_URI]";

$sqlmainDishes = "SELECT * FROM Menu WHERE item_category = 'Main Dishes' ORDER BY item_type; ";
$mainDishes = fetch_all($sqlmainDishes);

$sqldrinks = "SELECT * FROM Menu WHERE item_category = 'Drinks' ORDER BY item_type;";
$drinks = fetch_all($sqldrinks);

$sqlsides = "SELECT * FROM Menu WHERE item_category = 'Side Snacks' ORDER BY item_type; ";
$sides = fetch_all($sqlsides);

// Check if the user is logged in
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     echo '<div class="user-profile">';
//     echo 'Welcome, ' . $_SESSION["member_name"] . '!';
//     echo '<a href="../customerProfile/profile.php">Profile</a>';
//     echo '</div>';
// }


session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- FOR REVIEWS PAGE -->
    <link rel="stylesheet" href="../css/stars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    
    <title><?=( $current_url === '/home' || $current_url === '/' )? 'Home' : 'Reviews'?></title> 
</head>

<body>
    <!-- Header -->

    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a class="nav-link" href="/">
                        <h1 class="text-center" style="font-family:Copperplate; color:whitesmoke;"> JOHNNY'S</h1><span
                            class="sr-only"></span>
                    </a>
                </div>
                <div class="nav-list">
                    <div class="hamburger">
                        <div class="bar"></div>
                    </div>
                    <div class="navbar-container">

                        <div class="navbar">
                            <ul>
                                <li><a href="<?= ($current_url === '/home' || $current_url === '/') ? "#hero" : "/" ?>" data-after="Home">Home</a></li>
<?php
if ($current_url === '/home' || $current_url === '/') {
?>
                                <li><a href="#projects" data-after="Projects">Menu</a></li>
                                <li><a href="#about" data-after="About">About</a></li>
                                <li><a href="#contact" data-after="Contact">Contact</a></li>
<?php
}
?>
                                <li><a href="/reviews" data-after="Reviews">Reviews</a></li>
                                <li><a href="/reservation"
                                        data-after="Service">Reservation</a></li>
                                <li><a href="/staff-login" data-after="Staff">Staff</a></li>



                                <div class="dropdown">
                                    <button class="dropbtn">ACCOUNT <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-content">

<?php
// Get the member_id from the query parameters
$account_id = $_SESSION['account_id'] ?? null; // Change this to the way you obtain the member ID

// Create a query to retrieve the member's information
//$query = "SELECT member_name, points FROM memberships WHERE account_id = $account_id";

// Execute the query
//$result = mysqli_query($link, $query);

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $account_id != null) {
    $query = "SELECT member_name, points FROM memberships WHERE account_id = $account_id";

// Execute the query
    // If logged in, show "Logout" link
    // Check if the query was successful
        // Fetch the member's information
        $row = fetch_record($query);
        
        if ($row) {
            $member_name = $row['member_name'];
            $points = $row['points'];
            
            // Calculate VIP status
            $vip_status = ($points >= 1000) ? 'VIP' : 'Regular';
            
            // Define the VIP tooltip text
            $vip_tooltip = ($vip_status === 'Regular') ? ($points < 1000 ? (1000 - $points) . ' points to VIP ' : 'You are eligible for VIP') : '';
?>          
            <!-- Output the member's information -->
            <p class='logout-link' style='font-size:1.3em; margin-left:15px; padding:5px; color:white; '><?= $member_name ?></p>
            <p class='logout-link' style='font-size:1.3em; margin-left:15px;padding:5px;color:white; '><?= $points ?> Points </p>
            <p class='logout-link' style='font-size:1.3em; margin-left:15px;padding:5px; color:white; '><?= $vip_status ?>
<?php            
            // Add the tooltip only for Regular status
            if ($vip_status === 'Regular') {
?>
<?php                
                echo " <span class='tooltip'>$vip_tooltip</span>";
            }
?>

            </p>;
<?php
        } else {
            echo "Member not found.";
        }
?>

            <a class="logout-link" style="color: white; font-size:1.3em;" href="/logout">Logout</a>
<?php
} else {
    // If not logged in, show "Login" link
?>
           <a class="signin-link" style="color: white; font-size:15px;" href="/register">Sign Up </a>
           <a class="login-link" style="color: white; font-size:15px; " href="/login">Log In</a>

<?php
}
?>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->