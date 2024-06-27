<?php
// Check if setup has already been completed
if (file_exists('setup_completed.flag')) {
    echo "Setup has already been completed. The SQL setup won't run again.";
} else {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');

<<<<<<< Updated upstream
    // Create Connection
    $link = new mysqli(DB_HOST, DB_USER, DB_PASS);
=======

switch($request){
    case '':
        case '/':
            case '/home':
                require __DIR__ . '/view/home.php';
                break;
>>>>>>> Stashed changes

    // Check Connection
    if ($link->connect_error) {
        die('Connection Failed: ' . $link->connect_error);
    }

    // Create the 'restaurantdb' database if it doesn't exist
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS restaurantdb";
    if ($link->query($sqlCreateDB) === TRUE) {
        echo "Database 'restaurantdb' created successfully.<br>";
    } else {
        echo "Error creating database: " . $link->error . "<br>";
    }

<<<<<<< Updated upstream
    // Switch to using the 'restaurantdb' database
    $link->select_db('restaurantdb');

    // Execute SQL statements from "restaurantdb.txt"
    function executeSQLFromFile($filename, $link) {
        $sql = file_get_contents($filename);

        // Execute the SQL statements
        if ($link->multi_query($sql) === TRUE) {
            echo "SQL statements executed successfully.";
            // Set the flag to indicate setup is complete
            file_put_contents('setup_completed.flag', 'Setup completed successfully.');
        } else {
            echo "Error executing SQL statements: " . $link->error;
        }
    }

    // Execute SQL statements from "restaurantdb.txt"
    executeSQLFromFile('restaurantdb.txt', $link);

    // Close the database connection
    $link->close();
=======
    // FOR WRITING REVIEWS
    case '/reviews':
        require __DIR__ . '/view/reviews.php';
        break;
    case '/write-reviews':
        require __DIR__ . '/view/Customers/write-reviews.php';
        break;

    // For Reservations
    case '/reservation':
        require __DIR__ . '/customerSide/CustomerReservation/reservePage.php';
        break;

    case '/availability':
        require __DIR__ . '/customerSide/CustomerReservation/availability.php';
        break;
>>>>>>> Stashed changes
}
?>

<a href="customerSide/home/home.php">Home</a>
