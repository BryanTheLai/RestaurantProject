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

    // Prepare the SQL query
    $sql = "INSERT INTO Items (item_id, item_name, item_type, item_category, item_price, item_description) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ssssds", $item_id, $item_name, $item_type, $item_category, $item_price, $item_description);

    // Execute the query
    if ($stmt->execute()) {
        echo "Item created successfully!";
        echo '<a href="createItem.php">Add another item</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
