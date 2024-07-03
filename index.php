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

    // ADMIN SIDE
    case '/staff-login':
        require __DIR__ . '/view/Admins/StaffLogin/login.php';
        break;
    case '/staff-login/success':
        require __DIR__ . '/view/Admins/StaffLogin/login_process.php';
        break;

    case '/staff-logout':
        require __DIR__ . '/view/Admins/StaffLogin/logout.php';
        break;
    
    // ADMIN PANELS
    case '/staff-panel':
        require __DIR__ . '/view/Admins/panel/pos-panel.php';
        break;
    case '/staff/bills-panel':
        require __DIR__ . '/view/Admins/panel/sales-panel.php';
        break;
    case '/staff/table-panel':
        require __DIR__ . '/view/Admins/panel/table-panel.php';
        break;
    case '/staff/menu-panel':
        require __DIR__ . '/view/Admins/panel/menu-panel.php';
        break;
    case '/staff/reservations':
        require __DIR__ . '/view/Admins/panel/reservation-panel.php';
        break;
    case '/staff/customers':
        require __DIR__ . '/view/Admins/panel/customer-panel.php';
        break;
    case '/staff/staff-panel':
        require __DIR__ . '/view/Admins/panel/staff-panel.php';
        break;
    case '/staff/account-panel':
        require __DIR__ . '/view/Admins/panel/account-panel.php';
        break;
    case '/staff/kitchen-panel':
        require __DIR__ . '/view/Admins/panel/kitchen-panel.php';
        break;
    case '/staff/sales-panel':
        require __DIR__ . '/view/Admins/panel/sales-panel.php';
        break;
    case '/staff/statistics-panel':
        require __DIR__ . '/view/Admins/panel/statistics-panel.php';
        break;
    case '/staff/profiles-panel':
        require __DIR__ . '/view/Admins/panel/profiles-panel.php';
        break;

    default :
        http_response_code(404);
        require __DIR__ . '/view/404.php';
        break;
}

?>