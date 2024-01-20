<?php
// Include your database connection code here
require_once '../config.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit;
}

// Fetch the user's profile information
$user_id = $_SESSION['account_id'];

$query = "SELECT m.member_name, m.points, a.email, a.phone_number, a.register_date
          FROM Memberships AS m
          INNER JOIN Accounts AS a ON m.account_id = a.account_id
          WHERE m.account_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    echo 'Error: ' . $stmt->error;
    // Handle the error gracefully
}

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h2>User Profile</h2>
    <p>Welcome, <?php echo $row['member_name']; ?>!</p>
    <p>Email: <?php echo $row['email']; ?></p>
    <p>Phone Number: <?php echo $row['phone_number']; ?></p>
    <p>Points: <?php echo $row['points']; ?></p>
    <p>Register Date: <?php echo $row['register_date']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
