<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurantdb";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $item_id = $_POST["item_id"];
    $item_name = $_POST["item_name"];
    $item_type = $_POST["item_type"];
    $item_category = $_POST["item_category"];
    $item_price = $_POST["item_price"];
    $item_description = $_POST["item_description"];

    // Prepare the SQL query to check if the item_id already exists
    $check_query = "SELECT item_id FROM Items WHERE item_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $item_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    // Check if the item_id already exists
    if ($check_result->num_rows > 0) {
        echo "Error: The item_id is already in use. Please choose a different item_id.";
        echo "\nClick here to ";
        echo '<a href="createItem.php">Add item again.</a>';
    } else {
        // Prepare the SQL query for insertion
        $insert_query = "INSERT INTO Items (item_id, item_name, item_type, item_category, item_price, item_description) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);

        // Bind the parameters
        $stmt->bind_param("ssssds", $item_id, $item_name, $item_type, $item_category, $item_price, $item_description);

        // Execute the query
        if ($stmt->execute()) {
            echo "Item created successfully! ";
            echo '<a href="createItem.php">Add another item</a>';
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the check statement and the connection
    $check_stmt->close();
    $conn->close();
}
?>
