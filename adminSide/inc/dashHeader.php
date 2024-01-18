
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../panel/pos-panel.php">Johnny's Staff Panel</a>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main</div>
                            <a class="nav-link" href="../panel/pos-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                                Point of Sale 
                            </a>
                            <a class="nav-link" href="../panel/bill-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                                Bills
                            </a>
                            <a class="nav-link" href="../panel/table-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table-cells"></i></div>
                                Table
                            </a>
                            <a class="nav-link" href="../panel/menu-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-utensils"></i></div>
                                Menu
                            </a>
                            <a class="nav-link" href="../panel/reservation-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Reservations
                            </a>
                            <a class="nav-link" href="../panel/customer-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-person-shelter"></i></div>
                                Members
                            </a>
                            <a class="nav-link" href="../panel/staff-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-people-group"></i></div>
                                Staff
                            </a>
                            <a class="nav-link" href="../panel/account-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-eye"></i></div>
                                View All Accounts
                            </a>
                            <a class="nav-link" href="../panel/kitchen-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-kitchen-set"></i></div>
                                Kitchen
                            </a>
                            <div class="sb-sidenav-menu-heading">Report & Analytics</div>
                            <a class="nav-link" href="../panel/sales-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-fire"></i></div>
                                Items Sales
                            </a>
                            <a class="nav-link" href="../panel/statistics-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Revenue Statistics
                            </a>
                            <a class="nav-link" href="../panel/profiles-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Member Profiles
                            </a>
                            <a class="nav-link" href="../StaffLogin/logout.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
                                Log out
                            </a>
                            
                            
                            
                        </div>
                    </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                                <?php
                                // Check if the session variables are set
                                if (isset($_SESSION['logged_account_id']) && isset($_SESSION['logged_staff_name'])) {
                                    // Display the logged-in staff ID and name
                                    echo "Staff ID: " . $_SESSION['logged_account_id'] . "<br>";
                                    echo "Staff Name: " . $_SESSION['logged_staff_name'];
                                    
                                } else {
                                    // If session variables are not set, display a default message or handle as needed
                                    echo "Not logged in";
                                }
                                ?>
                        </div>
                </nav>
            </div>
        </<div>
            <div id="content-for-template">Content</div> 
        
        <script src="../js/scripts.js" type="text/javascript"></script>
