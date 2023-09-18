<?php
// Include your database connection code here (not shown in this example).
require_once "config.php"; // Make sure to replace "config.php" with your actual database connection file.
session_start();

// Define variables and initialize them to empty values
$email = $member_name = $password = $phone_number = "";
$email_err = $member_name_err = $password_err = $phone_number_err = "";

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate member name
    if (empty(trim($_POST["member_name"]))) {
        $member_name_err = "Please enter your member name.";
    } else {
        $member_name = trim($_POST["member_name"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phone_number"]))) {
        $phone_number_err = "Please enter your phone number.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }

    // Check input errors before inserting into the database
    if (empty($email_err) && empty($member_name_err) && empty($password_err) && empty($phone_number_err)) {
        // Start a transaction
        mysqli_begin_transaction($link);

        // Prepare an insert statement for Accounts table
        $sql_accounts = "INSERT INTO Accounts (email, password, phone_number, register_date) VALUES (?, ?, ?, NOW())";
        if ($stmt_accounts = mysqli_prepare($link, $sql_accounts)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt_accounts, "sss", $param_email, $param_password, $param_phone_number);

            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $param_phone_number = $phone_number;

            // Attempt to execute the prepared statement for Accounts table
            if (mysqli_stmt_execute($stmt_accounts)) {
                // Get the last inserted account_id
                $last_account_id = mysqli_insert_id($link);

                // Prepare an insert statement for Memberships table
                $sql_memberships = "INSERT INTO Memberships (member_name, points, account_id) VALUES (?, ?, ?)";
                if ($stmt_memberships = mysqli_prepare($link, $sql_memberships)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt_memberships, "sii", $param_member_name, $param_points, $last_account_id);

                    // Set parameters for Memberships table
                    $param_member_name = $member_name;
                    $param_points = 0; // You can set an initial value for points

                    // Attempt to execute the prepared statement for Memberships table
                    if (mysqli_stmt_execute($stmt_memberships)) {
                        // Commit the transaction
                        mysqli_commit($link);

                        // Registration successful, redirect to the login page
                        header("location: register_process.php");
                        exit;
                    } else {
                        // Rollback the transaction if there was an error
                        mysqli_rollback($link);
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close the statement for Memberships table
                    mysqli_stmt_close($stmt_memberships);
                }
            } else {
                // Rollback the transaction if there was an error
                mysqli_rollback($link);
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the statement for Accounts table
            mysqli_stmt_close($stmt_accounts);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: 'Georgia', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* Remove default margin */    
            background-color: black;
             background-image: url('../image/loginBackground.jpg'); /* Set the background image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white; /* Set text color to white */
            }


        
/* Style for the container within login.php */
.register-container {
  padding: 50px; /* Adjust the padding as needed */
  border-radius: 10px; /* Add rounded corners */
  margin: 100px auto; /* Center the container horizontally */
  max-width: 500px; /* Set a maximum width for the container */
}
        .register_wrapper {
            width: 400px; /* Increase the container width */
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-family: 'Georgia', serif;
        }

        p {
            font-family: 'Georgia', serif;
        }

        .form-group {
            margin-bottom: 15px; /* Add space between form elements */
        }

        ::placeholder {
            font-size: 12px; /* Adjust the font size as needed */
        }

        /* Add flip animation class to all Font Awesome icons */
        .fa-flip {
            animation: fa-flip 3s infinite;
        }

        /* Keyframes for the flip animation */
        @keyframes fa-flip {
            0% {
                transform: scale(1) rotateY(0);
            }
            50% {
                transform: scale(1.2) rotateY(180deg);
            }
            100% {
                transform: scale(1) rotateY(360deg);
            }
        }
        
                button, select {
            background-color: #5A5A5A;
            color: white;
            border: 2px solid black;
            padding: 3px 10px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            touch-action: manipulation;
            font-family: serif;
            height:40px;
            border-color: #41403e;
            box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
            transition: background-color 0.3s, color 0.3s, border 0.3s;
        }

        /* Style buttons and selects on hover */
        button:hover, select:hover {
            background-color: white;
            color: black;
            border: 2px solid black;
            box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
            transform: translate3d(0, 2px, 0);
        }
        
        .button:focus {
          box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
        }
    </style>
</head>
<body>
    <div class="register-container">
    <div class="register_wrapper"> <!-- Updated class name -->
        <a class="nav-link" href="../home/home.php#hero"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a><br>
        <h2 class="text-center" style="font-family: serif; color:white;">Registration Form</h2>
        <p class="text-center" style="font-family: serif; color:white;">Please fill this form to create an account.</p>
     
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                <label>Member Name</label>
                <input type="text" name="member_name" class="form-control" placeholder="Enter Member Name" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number" required>
            </div>

            <button type="submit" name="register" value="Register">Register</button>
           
        </form>

        <p style="font-family: serif; color:white;">Already have an account? <a href="../customerLogin/login.php" style="color: #A5A5A5">Proceed to login page</a></p>
    </div>
    </div>
</body>
</html>



