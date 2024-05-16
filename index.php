<?php 
$request = $_SERVER['REQUEST_URI'];

switch($request){
    case '':
        case '/':
            case '/home':
                require __DIR__ . '/view/home.php';
                break;

    // FOR USER REGISTRATION/LOGIN/LOGOUT
    case '/register':
        require __DIR__ . '/view/Customers/register.php';
        break;

    case '/login':
        require __DIR__ . '/view/Customers/login.php';
        break;
    case '/logout':
        require __DIR__ . '/processes/Customers/logout.php';
        break;

    // FOR WRITING REVIEWS
    case '/reviews':
        require __DIR__ . '/view/reviews.php';
        break;
    case '/write-reviews':
        require __DIR__ . '/view/Customers/write-reviews.php';
        break;
}

?>