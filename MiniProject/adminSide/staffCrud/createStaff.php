<?php include '../inc/dashHeader.php'; ?>
<?php
// Include config file
require_once "../config.php";

$input_staff_id = $staff_id_err = $staff_id = "";

// Processing form data when form is submitted
if (isset($_POST['submit'])) {
    if (empty($_POST['staff_id'])) {
        $staff_idErr = 'ID is required';
    } else {
        $staff_id = filter_input(
            INPUT_POST,
            'staff_id',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Staff</title>
    <style>
       .wrapper{ width: 1300px; padding-left: 200px ; padding-top: 80px; }
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
    <h3>Create New Staff</h3>
    <p>Please fill in Staff Information Properly</p>

    <form method="POST" action="succ_create_staff.php" class="ht-600 w-50">

        <div class="form-group">
            <label for="staff_id" class="form-label">Staff ID:</label>
            <input min=1 type="number" name="staff_id" placeholder="1" class="form-control <?php echo !$staff_idErr ?: 'is-invalid'; ?>" id="staff_id" required value="<?php echo $staff_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid staff_id.
            </div>
        </div>

        <div class="form-group">
            <label for="staff_name">Staff Name:</label>
            <input type="text" name="staff_name" placeholder="Johnny Hatsoff" id="staff_name" required class="form-control <?php echo (!empty($staff_name_err)) ? 'is-invalid' : ''; ?>"><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" name="role" id="role" placeholder="Waiter" required class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>"><br>
            <span class="invalid-feedback"></span>
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
            <input type="submit" class="btn btn-primary" value="Create Staff">
        </div>

    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
