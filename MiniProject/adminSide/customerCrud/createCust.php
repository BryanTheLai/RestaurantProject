<?php include '../inc/dashHeader.php'; ?>
<?php
// Include config file
require_once "../config.php";

$input_member_name = $member_name_err = $member_name = "";
$input_points = $points_err = $points = "";

// Processing form data when form is submitted
if(isset($_POST['submit'])){
    if (empty($_POST['member_name'])) {
        $member_name_err = 'Member name is required';
    } else {
        $member_name = filter_input(
            INPUT_POST,
            'member_name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }

    if (empty($_POST['points'])) {
        $points_err = 'Points are required';
    } else {
        $points = filter_input(
            INPUT_POST,
            'points',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Membership</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>

<div class="wrapper">
    <h1>Johnny's Dining & Bar</h1>
    <h3>Create New Membership</h3>
    <p>Please fill in Membership Information Properly</p>

    <form method="POST" action="success_createMembership.php" class="ht-600 w-50">
        
        <div class="form-group">
            <label for="member_id" class="form-label">Member ID:</label>
            <input type="number" name="member_id" class="form-control <?php echo !$member_idErr ?: 'is-invalid'; ?>" id="member_id" required value="<?php echo $member_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid member_id.
            </div>
        </div>
        
        <div class="form-group">
            <label for="member_name" class="form-label">Member Name :</label>
            <input type="text" name="member_name" class="form-control <?php echo !$member_name_err ? 'is-invalid' : ''; ?>" id="member_name" required value="<?php echo $member_name; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid member name.
            </div>
        </div>

        <div class="form-group">
            <label for="points">Points :</label>
            <input type="number" name="points" id="points" required class="form-control <?php echo !$points_err ? 'is-invalid' : ''; ?>" value="<?php echo $points; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide valid points.
            </div>
        </div>

        <div class="form-group">
            <label for="account_id" class="form-label">Account ID:</label>
            <input type="number" name="account_id" class="form-control <?php echo !$account_idErr ?: 'is-invalid'; ?>" id="account_id" required value="<?php echo $account_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
                Please provide a valid account_id.
            </div>
        </div>
        
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Create Membership">
        </div>
    </form>
</div>

<?php include '../inc/dashFooter.php'; ?>
