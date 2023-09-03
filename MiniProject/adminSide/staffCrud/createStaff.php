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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px  }
    </style>
</head>

<div class="wrapper">
    <h1>Johnny's Dining & Bar</h1>
    <h3>Create New Staff</h3>
    <p>Please fill in Staff Information Properly</p>

    <form method="POST" action="succ_create_staff.php" class="ht-600 w-50">

        <div class="form-group">
            <label for="staff_id" class="form-label">Staff ID:</label>
            <input type="number" name="staff_id" class="form-control <?php echo !$staff_idErr ?: 'is-invalid'; ?>" id="staff_id" required value="<?php echo $staff_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid staff_id.
            </div>
        </div>

        <div class="form-group">
            <label for="staff_name">Staff Name:</label>
            <input type="text" name="staff_name" id="staff_name" required class="form-control <?php echo (!empty($staff_name_err)) ? 'is-invalid' : ''; ?>"><br>
            <span class="invalid-feedback"></span>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" name="role" id="role" required class="form-control <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?>"><br>
            <span class="invalid-feedback"></span>
        </div>
        
        <div class="form-group">
            <label for="account_id" class="form-label">Account ID:</label>
            <input type="number" name="account_id" class="form-control <?php echo !$account_idErr ?: 'is-invalid'; ?>" id="account_id" required value="<?php echo $account_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid account_id.
            </div>
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Create Staff">
        </div>

    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
