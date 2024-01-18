<?php include '../inc/dashHeader.php'; ?>
<?php
// Include config file
require_once "../config.php";

$input_account_id = $account_iderr = $account_id = "";
$input_email = $email_err = $email = "";
$input_register_date = $register_date_err = $register_date = "";
$input_phone_number = $phone_number_err = $phone_number = "";
$input_password = $password_err = $password = "";

?>
<head>
    <meta charset="UTF-8">
    <title>Create New Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px; }
    </style>
</head>

<div class="wrapper">
    <h1>Johnny's Dining & Bar</h1>
    <h3>Create New Account</h3>
    <p>Please fill in Account Information Properly</p>

    <form method="POST" action="success_create_staff_Account.php" class="ht-600 w-50">
        
        <div class="form-group">
            <label for="account_id" class="form-label">Account ID:</label>
            <input min=1 type="number" name="account_id" placeholder="99" class="form-control <?php echo !$account_idErr ?: 'is-invalid'; ?>" id="account_id" required value="<?php echo $account_id; ?>"><br>
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
        
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-dark" value="Create Account">
        </div>
    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
