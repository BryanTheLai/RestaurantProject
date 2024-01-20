<?php include '../inc/dashHeader.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Staff to an Account</title>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>
<body>
    <div class="wrapper">
    <h1>Johnny's Dining & Bar</h1>
    <h3>Assign Staff to an Account</h3>
    <p>Please choose an Account to Assign for the Staff Properly</p>
    
    <form action="update_staff.php" method="post" class="ht-600 w-50">
        
        <div class="form-group">
        <label for="account_id" class="form-label">Account ID:</label>
        <select id="account_id" name="account_id" required>
            <option value="">Select an account</option>
            <?php
            require_once "../config.php";


            // Query to retrieve accounts without staff assigned
            $accountQuery = "SELECT account_id FROM Accounts WHERE staff_id IS NULL";
            $accountResult = $conn->query($accountQuery);

            while ($row = $accountResult->fetch_assoc()) {
                echo "<option value='" . $row['account_id'] . "'>" . $row['account_id'] . "</option>";
            }

            $conn->close();
            ?>
        </select>
        </div>
        
        <br>
        <div class="form-group">
        <label for="staff_id" class="form-label">Staff ID:</label>
        <select id="staff_id" name="staff_id" required>
            <option value="">Select a staff</option>
            <?php
            // Assuming you have a database connection established
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve staffs not used by any account
            $staffQuery = "SELECT staff_id FROM Staffs WHERE staff_id NOT IN (SELECT staff_id FROM Accounts WHERE staff_id IS NOT NULL)";
            $staffResult = $conn->query($staffQuery);

            while ($row = $staffResult->fetch_assoc()) {
                echo "<option value='" . $row['staff_id'] . "'>" . $row['staff_id'] . "</option>";
            }

            $conn->close();
            ?>
        </select>
        </div>
        <br>
        
        <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Assign Account to Staff">
        </div>
    </form>
    </div>
</body>
</html>
