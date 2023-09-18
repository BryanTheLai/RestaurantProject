<?php include '../inc/dashHeader.php'; ?>
<?php
// Include config file
require_once "../config.php";

// Define variables and initialize them
$member_id = $member_name = $points = $account_id = "";
$member_id_err = $member_name_err = $points_err = "";

?>
<head>
    <meta charset="UTF-8">
    <title>Create New Membership</title>
    <style>
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px; }
        /* Style the select input */
        #account_id {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        /* Style the default option */
        #account_id option {
            color: #333;
        }

        /* Style the selected option */
        #account_id option:checked {
            background-color: #007bff;
            color: #fff;
        }

        /* Style the select when it's required and empty */
        #account_id:required:invalid {
            color: #999;
            border-color: #f00; /* Red border for validation */
        }

        /* Style the select when it's required and filled */
        #account_id:required:valid {
            border-color: #28a745; /* Green border for validation */
            color: #333;
        }
    </style>
</head>

<div class="wrapper">
    <h1>Johnny's Dining & Bar</h1>
    <h3>Create New Membership</h3>
    <p>Please fill in Membership Information Properly</p>

    <form method="POST" action="success_createMembership.php" class="ht-600 w-50">
        
        <div class="form-group">
            <label for="member_id" class="form-label">Member ID:</label>
            <input min=1 type="number" name="member_id" placeholder="99" class="form-control <?php echo $member_id_err ? 'is-invalid' : ''; ?>" id="member_id" required value="<?php echo $member_id; ?>"><br>
            <div class="invalid-feedback">
                Please provide a valid member_id.
            </div>
        </div>
        
        <div class="form-group">
            <label for="member_name" class="form-label">Member Name :</label>
            <input type="text" name="member_name" placeholder="Johnny" class="form-control <?php echo $member_name_err ? 'is-invalid' : ''; ?>" id="member_name" required value="<?php echo $member_name; ?>"><br>
            <div class="invalid-feedback">
                Please provide a valid member name.
            </div>
        </div>

        <div class="form-group">
            <label for="points">Points :</label>
            <input type="number" name="points" id="points" required class="form-control <?php echo $points_err ? 'is-invalid' : ''; ?>" value="<?php echo $points; ?>"><br>
            <div class="invalid-feedback">
                Please provide valid points.
            </div>
        </div>

        <div class="form-group">
            <label for="account_id" class="form-label">Account ID:</label>
            <select id="account_id" name="account_id" required>
                <option value="">Select an account</option>
                <?php
                // Assuming you have a database connection established
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "restaurantdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to retrieve accounts that don't exist in Staffs and Memberships tables
                $query = "SELECT A.account_id
                          FROM Accounts A
                          LEFT JOIN Staffs S ON A.account_id = S.account_id
                          LEFT JOIN Memberships M ON A.account_id = M.account_id
                          WHERE S.account_id IS NULL AND M.account_id IS NULL";

                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['account_id'] . "'>" . $row['account_id'] . "</option>";
                }

                $conn->close();
                ?>
            </select>
        </div><br>
        
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Create Membership">
        </div>
    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
