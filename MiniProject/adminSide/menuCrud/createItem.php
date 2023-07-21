<?php  include 'menuHeader.php'?>
<?php
// Include config file
require_once "../config.php";
 
$input_item_price = $item_price_err = $item_price = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    
    
    // Validate item_price
    $input_item_price = trim($_POST["item_price"]);
    if(empty($input_item_price)){
        $item_price_err = "Please enter the item_price amount.";     
    } elseif(!ctype_digit($input_item_price)){
        $item_price_err = "Please enter a positive integer value.";
    } else{
        $item_price = $input_item_price;
    }
  
    // Close connection
    mysqli_close($link);
}
?>
 

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add item record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
             
                        
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" item_id="item_price" class="form-control <?php echo (!empty($item_price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $item_price; ?>">
                            <span class="invalid-feedback"><?php echo $item_price_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    
<?php  include 'menuFooter.php'?>
