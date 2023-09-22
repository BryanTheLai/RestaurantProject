<?php
session_start(); // Ensure session is started
?>
<?php  include '../inc/dashHeader.php'?>
<?php
// Include config file
require_once "../config.php";
 
$input_table_id = $table_id_err = $table_id = "";
 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
    if (empty($_POST['table_id'])) {
    $$table_id = 'ID is required';
  } else {
    // $table_id = filter_var($_POST['table_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $table_id = filter_input(
      INPUT_POST,
      'table_id',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
    
}
?>
<head>
    <meta charset="UTF-8">
    <title>Create New Table</title>
    <style>
        .wrapper{ width: 1300px; padding-left: 200px; padding-top: 80px  }
    </style>
</head>

 <div class="wrapper" >
    <h3>Create New Table</h1>
    <p>Please fill in the Table Information  </p>
    
<form method="POST" action="succ_create_table.php" class="ht-600 w-50">
    
        <div class="form-group">
            <label for="table_id" class="form-label">Table ID :</label>
            <input type="number" name="table_id" class="form-control <?php echo !$$table_id ?:
                    'is-invalid'; ?>" id="table_id" required table_id="table_id" placeholder="1" min=1 value="<?php echo $table_id; ?>"><br>
            <div id="validationServerFeedback" class="invalid-feedback">
            Please provide a valid table id.
            </div>
        </div>
    
        <div class="form-group"> 
            <label for="capacity">Capacity :</label>
            <input placeholder="8" type="number" name="capacity" min=1 id="capacity" required class="form-control <?php echo (!empty($capacity)) ? 'is-invalid' : ''; ?>" ><br>
            <span class="invalid-feedback"></span>
        </div>

        
        
        <div class="form-group">
            <input type="submit" class="btn btn-dark" value="Create table">
        </div>    
        
    
 </form>
 </div>
 
