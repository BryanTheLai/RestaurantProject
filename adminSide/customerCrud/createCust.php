<?php
session_start(); // Ensure session is started
?>
<?php include '../inc/dashHeader.php'; ?>
<?php
// Include config file
require_once "../config.php";


// Define variables and initialize them
$member_id = $member_name = $points = $account_id = "";
$member_id_err = $member_name_err = $points_err = "";
$input_account_id = $account_iderr = $account_id = "";
$input_email = $email_err = $email = "";
$input_register_date = $register_date_err = $register_date = "";
$input_phone_number = $phone_number_err = $phone_number = "";
$input_password = $password_err = $password = "";

// Function to get the next available account ID
function getNextAvailableAccountID($conn) {
    $sql = "SELECT MAX(account_id) as max_account_id FROM Accounts";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $next_account_id = $row['max_account_id'] + 1;
    return $next_account_id;
}

// Function to get the next available Member ID
function getNextAvailableMemberID($conn) {
    $sql = "SELECT MAX(member_id) as max_member_id FROM Memberships";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $next_member_id = $row['max_member_id'] + 1;
    return $next_member_id;
}

// Get the next available Member ID
$next_member_id = getNextAvailableMemberID($link);

// Get the next available account ID
$next_account_id = getNextAvailableAccountID($link);
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Membership</title>
    <style>
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px; }
        /* Style the select input */
        #account_id {
            width: 100%;
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
    <h3>Create New Membership</h3>
    <p>Please fill in Membership Information</p>

    <form method="POST" action="success_createMembership.php" class="ht-600 w-50">
        
        <div class="form-group">
            <label for="member_id" class="form-label">Member ID:</label>
            <input min="1" type="number" name="member_id" placeholder="1" class="form-control <?php echo $member_id_err ? 'is-invalid' : ''; ?>" id="member_id" required value="<?php echo $next_member_id; ?>" readonly><br>
            <div class="invalid-feedback">
                Please provide a valid member_id.
            </div>
        </div>
        
        <div class="form-group">
            <label for="member_name" class="form-label">Member Name :</label>
            <input type="text" name="member_name" placeholder="Johnny Hatsoff" class="form-control <?php echo $member_name_err ? 'is-invalid' : ''; ?>" id="member_name" required value="<?php echo $member_name; ?>"><br>
            <div class="invalid-feedback">
                Please provide a valid member name.
            </div>
        </div>

        <div class="form-group">
            <label for="points">Points :</label>
            <input type="number" name="points" id="points" placeholder="1234" required class="form-control <?php echo $points_err ? 'is-invalid' : ''; ?>" value="<?php echo $points; ?>"><br>
            <div class="invalid-feedback">
                Please provide valid points.
            </div>
        </div>

        <div class="form-group">
            <label for="account_id" class="form-label">Account ID:</label>
            <input min="1" type="number" name="account_id" placeholder="99" class="form-control <?php echo !$account_idErr ?: 'is-invalid'; ?>" id="account_id" required value="<?php echo $next_account_id; ?>" readonly><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid account_id.
            </div>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">Email :</label>
            <input type="text" name="email" placeholder="johnny12@dining.bar.com" class="form-control <?php echo !$emailErr ?: 'is-invalid'; ?>" id="email" required value="<?php echo $email; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid email.
            </div>
        </div>

        <div class="form-group">
            <label for="register_date">Register Date :</label>
            <input type="date" name="register_date" id="register_date" required class="form-control <?php echo !$register_date_err ?: 'is-invalid';?>" value="<?php echo $register_date; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid register date.
            </div>
        </div>

        <div class="form-group">
            <label for="phone_number" class="form-label">Phone Number:</label>
            <input type="text" name="phone_number" placeholder="+60101231234" class="form-control <?php echo !$phone_numberErr ?: 'is-invalid'; ?>" id="phone_number" required value="<?php echo $phone_number; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid phone number.
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" name="password" placeholder="johnny1234@" id="password" required class="form-control <?php echo !$password_err ?: 'is-invalid' ; ?>" value="<?php echo $password; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid password.
            </div>
        </div>
        
        <div class="form-group mb-5">
            <input type="submit" name="submit" class="btn btn-dark" value="Create Membership">
        </div>
    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
