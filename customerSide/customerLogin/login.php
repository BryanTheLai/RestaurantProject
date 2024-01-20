<?php
// Include your database connection code here
require_once '../config.php';
session_start();

// Define variables for email and password
$email = $password = "";
$email_err = $password_err = "";

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before checking authentication
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT * FROM Accounts WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                // Check if a matching record was found.
                if (mysqli_num_rows($result) == 1) {
                    // Fetch the result row
                    $row = mysqli_fetch_assoc($result);

                    
                   // Verify the password
                    if ($password === $row["password"]) {
                        // Password is correct, start a new session and redirect the user to a dashboard or home page.
                        $_SESSION["loggedin"] = true;
                        $_SESSION["email"] = $email;

                        // Query to get membership details
                        $sql_member = "SELECT * FROM Memberships WHERE account_id = " . $row['account_id'];
                        $result_member = mysqli_query($link, $sql_member);

                        if ($result_member) {
                            $membership_row = mysqli_fetch_assoc($result_member);

                            if ($membership_row) {
                                $_SESSION["account_id"] = $membership_row["account_id"];
                                header("location: ../home/home.php"); // Redirect to the home page
                                exit;
                            } else {
                                // No membership details found
                                $password_err = "No membership details found for this account.";
                            }
                        } else {
                            // Error in membership query
                            $password_err = "Error fetching membership details: " . mysqli_error($link);
                        }
                    } else {
                        // Password is incorrect
                        $password_err = "Invalid password. Please try again.";
                    }


                } else {
                    // No matching records found
                    $email_err = "No account found with this email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        


/* Style for the container within login.php */
.login-container {
  padding: 50px; /* Adjust the padding as needed */
  border-radius: 10px; /* Add rounded corners */
  margin: 100px auto; /* Center the container horizontally */
  max-width: 500px; /* Set a maximum width for the container */
}



        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* Remove default margin */
            background-color:black;
             background-image: url('../image/loginBackground.jpg'); /* Set the background image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
        }

        .login_wrapper {
            width: 400px; /* Adjust the container width as needed */
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-family: 'Montserrat', serif;
        }

        p {
            font-family: 'Montserrat', serif;
        }

        .form-group {
            margin-bottom: 15px; /* Add space between form elements */
        }

        ::placeholder {
            font-size: 12px; /* Adjust the font size as needed */
        }
        
        .text-danger{
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="login-container">
    <div class="login_wrapper">
        <a class="nav-link" href="../home/home.php#hero"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a>
    
        <div class="wrapper">
           
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter User Email" required>
                <span class="text-danger"><?php echo $email_err; ?></span>
            </div>

           <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter User Password" required>
    <span class="text-danger"><?php echo $password_err; ?></span>
</div>
            <button class="btn btn-dark" style="background-color:black;" type="submit" name="submit" value="Login">Login</button>
            
        </form>

            <p style="margin-top:1em; color:white;">Don't have an account? <a href="register.php" style="">Proceed to Register</a></p>
        </div>
    </div>
    </div>
</body>
</html>
