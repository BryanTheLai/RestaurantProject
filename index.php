<?php
// Check if setup has already been completed
if (file_exists('setup_completed.flag')) {
    echo "Setup has already been completed. The SQL setup won't run again.If not created,open this project in the file explorer and delete setup_completed.flag.It should be next to the index.php file.";
} else {
    require_once 'customerSide/config.php';
    // Create the 'restaurantdb' database if it doesn't exist
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS restaurantdb";    // Change 'restaurantdb' to your actual database name 
    if ($link->query($sqlCreateDB) === TRUE) {
        echo "Database 'restaurantdb' created successfully.<br>";
    } else {
        echo "Error creating database: " . $link->error . "<br>";
    }

    // Switch to using the 'restaurantdb' database
    $link->select_db('restaurantdb'); // Change 'restaurantdb' to your actual database name 

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
}
?>

<a href="customerSide/home/home.php">Home</a>
