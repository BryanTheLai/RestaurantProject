<?php include '../inc/dashHeader.php'; ?>
<?php
// Include config file
require_once "../config.php";

ob_start();
$input_email = $email_err = $email = "";
$input_register_date = $register_date_err = $register_date = "";
$input_phone_number = $phone_number_err = $phone_number = "";
$input_password = $password_err = $password = "";
$input_membership_id = $membership_id = "";
$input_staff_id = $staff_id = "";

// Processing form data when form is submitted
if(isset($_POST['submit'])){
    // Validate and sanitize email
    if (empty($_POST['email'])) {
        $email_err = 'Email is required';
    } else {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $email_err = 'Invalid email format';
        }
    }

    // Validate and sanitize register date
    // Validate and sanitize register date
$register_date = $_POST['register_date'];
$date_format = 'Y-m-d';

if (!empty($register_date)) {
    // Convert the register date to a DateTime object
    $register_date_obj = new DateTime($register_date);

    // Check if the date format is valid
    if (!date_format($register_date_obj, $date_format)) {
        $register_date_err = 'Invalid date format';
    }
}





    // Validate and sanitize phone number
    if (empty($_POST['phone_number'])) {
        $phone_number_err = 'Phone number is required';
    } else {
        $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING);
    }

    // Validate and sanitize password
    if (empty($_POST['password'])) {
        $password_err = 'Password is required';
    } else {
        $password = $_POST['password'];
    }

    // Sanitize membership and staff IDs
    $membership_id = $_POST['membership_id'] ?? null;
    $staff_id = $_POST['staff_id'] ?? null;

    // If there are no errors, insert the data into the database
    if (empty($email_err) && empty($register_date_err) && empty($phone_number_err) && empty($password_err)) {
        $conn = new mysqli("localhost", "root", "", "restaurantdb");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

$insert_query = "INSERT INTO Accounts  (email, register_date, phone_number, password, membership_id, staff_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("ssssss", $email, $register_date, $phone_number, $password, $membership_id, $staff_id);

        if ($stmt->execute()) {
            // Success, redirect to success page or do something else
            header("location: success_create_member_account.php");
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Member Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>

<div class="wrapper">
    <h1>Johnny's Dining & Bar</h1>
    <h3>Create New Member Account</h3>
    <p>Please fill in Account Information Properly</p>

    <form method="POST" action="success_create_member_account.php" class="ht-600 w-50">
        <div class="form-group">
            <label for="email" class="form-label">Email :</label>
            <input type="text" name="email" class="form-control <?php echo !$email_Err ?:
                'is-invalid'; ?>" id="email" required email="email" placeholder="johnny@dining.bar.com" value="<?php echo $email; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
            Please provide a valid email.
            </div>
        </div>

        <div class="form-group">
            <label for="register_date">Register Date :</label>
            <input type="date" name="register_date" id="register_date" required class="form-control <?php echo $register_date_err ? 'is-invalid' : ''; ?>" value="<?php echo $register_date; ?>"><br>
            <div class="invalid-feedback">
                <?php echo $register_date_err; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number :</label>
            <input placeholder="+013 985 3921" type="text" name="phone_number" id="phone_number" required class="form-control <?php echo $phone_number_err ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>"><br>
            <div class="invalid-feedback">
                <?php echo $phone_number_err; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Password :</label>
            <input placeholder="Cov42nkndca" type="password" name="password" id="password" required class="form-control <?php echo $password_err ? 'is-invalid' : ''; ?>"><br>
            <div class="invalid-feedback">
                <?php echo $password_err; ?>
            </div>
        </div>
   
        <div class="form-group">
            <label for="member_id">Member ID:</label>
            <input placeholder="1" min=1 type="number" name="member_id" id="member_id" class="form-control" value="<?php echo $member_id; ?>">
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-dark" value="Create Account">
        </div>
    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
