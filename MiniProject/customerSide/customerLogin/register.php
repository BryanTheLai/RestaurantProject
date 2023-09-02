<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $phone_number = "";
$username_err = $password_err = $confirm_password_err = $email_err = $phone_number_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT account_id FROM Accounts WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Validate phone number
    if(empty(trim($_POST["phone_number"]))){
        $phone_number_err = "Please enter your phone number.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($phone_number_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Accounts (username, password, email, phone_number) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $param_phone_number);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_phone_number = $phone_number;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
         body {
             font-family: 'Times New Roman', serif;
            color: white;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            width: 560px;
            padding: 20px;
        }
        h2{
            text-align: center;
              font-family: 'Times New Roman', serif;
        }
        
        p{
              font-family: 'Times New Roman', serif;
        }
        ::placeholder {
        font-size: 12px; /* Adjust the font size as needed */
    }
    </style>
</head>
<body>
   

    <section id="signup">
        <div class="container my-6 ">
	<a class="nav-link" href="../home/home.php#hero"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a>
    

    <div class="wrapper">
        <h2>Sign Up</h2>
        
        <p style="text-align: center;">Please fill this form to create an account.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username <i class="fa fa-user"></i></label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Enter Username">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            
            <div class="form-group">
                <label>Password <i class="fa fa-key"></i></label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>"placeholder="Enter Password">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            
            
            <div class="form-group">
                <label>Confirm Password <i class="fa fa-key"></i></label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"placeholder="Enter Comfirm Password">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email <i class="fa fa-envelope"></i></label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"placeholder="Enter email">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Phone Number <i class="fa fa-phone"></i></label>
                <input type="tel" name="phone_number" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>"placeholder="Enter Phone Number">
                <span class="invalid-feedback"><?php echo $phone_number_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
