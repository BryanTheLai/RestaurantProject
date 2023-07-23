<?php  include 'menuHeader.php'?>
<?php
// Include config file
require_once "../config.php";
 
$input_item_id = $item_id_err = $item_id = "";
 
// Processing form data when form is submitted
if(isset($_POST['submit'])){
    if (empty($_POST['item_id'])) {
    $item_idErr = 'ID is required';
  } else {
    // $item_id = filter_var($_POST['item_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $item_id = filter_input(
      INPUT_POST,
      'item_id',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }
    
}
?>
 <p class="lead text-center">Create Item</p>
<form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="ht-600 w-50">
    <div class=" pt-6">
        <label for="item_id" class="form-label">item_id</label>
        <input type="text" class="form-control <?php echo !$item_idErr ?:
          'is-invalid'; ?>" id="item_id" item_id="item_id" placeholder="Enter your item_id" value="<?php echo $item_id; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          Please provide a valid item_id.
        </div>
    </div>
 </form>
    
<?php  include 'menuFooter.php'?>
