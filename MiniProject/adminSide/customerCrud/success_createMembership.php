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
    $member_id = $_POST["member_id"];
    $member_name = $_POST["member_name"];
    $points = $_POST["points"];
    $account_id = $_POST["account_id"];
    
    // Prepare the SQL query to check if the member_id already exists
    $check_member_query = "SELECT member_id FROM Memberships WHERE member_id = ?";
    $check_member_stmt = $conn->prepare($check_member_query);
    $check_member_stmt->bind_param("i", $member_id);
    $check_member_stmt->execute();
    $check_member_result = $check_member_stmt->get_result();

    // Prepare the SQL query to check if the account_id already exists
    $check_accountid_query = "SELECT account_id FROM Staffs WHERE account_id = ? UNION SELECT account_id FROM Memberships WHERE account_id = ?";
    $check_accountid_stmt = $conn->prepare($check_accountid_query);
    $check_accountid_stmt->bind_param("ii", $account_id, $account_id);
    $check_accountid_stmt->execute();
    $check_accountid_result = $check_accountid_stmt->get_result();

    // Prepare the SQL query to check if the account_id not exists in Accounts
    $check_account_query = "SELECT account_id FROM Accounts WHERE account_id = ?";
    $check_account_stmt = $conn->prepare($check_account_query);
    $check_account_stmt->bind_param("i", $account_id);
    $check_account_stmt->execute();
    $check_account_result = $check_account_stmt->get_result();

    // Check if the member_id already exists or if account_id doesn't exist
    if ($check_member_result->num_rows > 0) {
        $message = "Member ID already exists. Please choose another Member ID.";
        $iconClass = "fa-times-circle";
        $cardClass = "alert-danger";
        $bgColor = "#FFA7A7"; // Custom background color for error
    } elseif ($check_accountid_result->num_rows > 0) {
        $message = "Account ID already exists for another staff member or membership. Please choose another account ID.";
        $iconClass = "fa-times-circle";
        $cardClass = "alert-danger";
        $bgColor = "#FFA7A7"; // Custom background color for error
    } elseif ($check_account_result->num_rows == 0) {
        // Account ID doesn't exist in Accounts table
        $message = "Account ID doesn't exist in the Accounts table. Please choose an existing account ID that not own by anyone.";
        $iconClass = "fa-times-circle";
        $cardClass = "alert-danger";
        $bgColor = "#FFA7A7"; // Custom background color for error
    } else {
        // Prepare the SQL query for insertion
        $insert_query = "INSERT INTO Memberships (member_id, member_name, points, account_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);

        // Bind the parameters
        $stmt->bind_param("isii", $member_id, $member_name, $points, $account_id);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Membership created successfully.";
            $iconClass = "fa-check-circle";
            $cardClass = "alert-success";
            $bgColor = "#D4F4DD"; // Custom background color for success
        } else {
            $message = "Error: " . $stmt->error . " (Error code: " . $stmt->errno . ")";
            $iconClass = "fa-times-circle";
            $cardClass = "alert-danger";
            $bgColor = "#FFA7A7"; // Custom background color for error
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the check statements and the connection
    $check_member_stmt->close();
    $check_account_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <style>
        /* Your custom CSS styles for the success message card here */
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }
        i.checkmark {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        /* Additional CSS styles based on success/error message */
        .alert-success {
            /* Customize the styles for the success message card */
            background-color: <?php echo $bgColor; ?>;
        }
        .alert-success i {
            color: #5DBE6F; /* Customize the checkmark icon color for success */
        }
        .alert-danger {
            /* Customize the styles for the error message card */
            background-color: #FFA7A7; /* Custom background color for error */
        }
        .alert-danger i {
            color: #F25454; /* Customize the checkmark icon color for error */
        }
        .custom-x {
            color: #F25454; /* Customize the "X" symbol color for error */
            font-size: 100px;
            line-height: 200px;
        }
            .alert-box {
            max-width: 300px;
            margin: 0 auto;
        }

        .alert-icon {
            padding-bottom: 20px;
        }
    
    </style>
</head>
<body>
    <div class="card <?php echo $cardClass; ?>" style="display: none;">
        <div style="border-radius: 200px; height: 200px; width: 200px; background: #F8FAF5; margin: 0 auto;">
            <?php if ($iconClass === 'fa-check-circle'): ?>
                <i class="checkmark">✓</i>
            <?php else: ?>
                <i class="custom-x" style="font-size: 100px; line-height: 200px;">✘</i>
            <?php endif; ?>
        </div>
        <h1><?php echo ($cardClass === 'alert-success') ? 'Success' : 'Error'; ?></h1>
        <p><?php echo $message; ?></p>
    </div>

    <div style="text-align: center; margin-top: 20px;">Redirecting back in <span id="countdown">3</span></div>

    <script>
        // Function to show the message card as a pop-up and start the countdown
        function showPopup() {
            var messageCard = document.querySelector(".card");
            messageCard.style.display = "block";

            var i = 3;
            var countdownElement = document.getElementById("countdown");
            var countdownInterval = setInterval(function() {
                i--;
                countdownElement.textContent = i;
                if (i <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "createCust.php";
                }
            }, 1000); // 1000 milliseconds = 1 second
        }

        // Show the message card and start the countdown when the page is loaded
        window.onload = showPopup;

        // Function to hide the message card after a delay
        function hidePopup() {
            var messageCard = document.querySelector(".card");
            messageCard.style.display = "none";
            // Redirect to another page after hiding the pop-up (adjust the delay as needed)
            setTimeout(function () {
                window.location.href = "createCust.php"; // Replace with your desired URL
            }, 3000); // 3000 milliseconds = 3 seconds
        }

        // Hide the message card after 3 seconds (adjust the delay as needed)
        setTimeout(hidePopup, 3000);
    </script>
</body>
</html>

