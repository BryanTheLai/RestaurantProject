<?php 

// require_once '../config.php';
// session_start();

// if($_SERVER["REQUEST_METHOD"] == "POST") {
    // // Validate email
    // if (empty(trim($_POST["email"]))) {
    //     $email_err = "Please enter your email.";
    // } else {
    //     $email = trim($_POST["email"]);
    // }

    // // Validate password
    // if (empty(trim($_POST["password"]))) {
    //     $password_err = "Please enter your password.";
    // } else {
    //     $password = trim($_POST["password"]);
    // }

    // // Check input errors before checking authentication
    // if (empty($email_err) && empty($password_err)) {
    //     // Prepare a select statement
    //     $sql = "SELECT * FROM Accounts WHERE email = ?";

    //     if ($stmt = mysqli_prepare($link, $sql)) {
    //         // Bind variables to the prepared statement as parameters
    //         mysqli_stmt_bind_param($stmt, "s", $param_email);

    //         // Set parameters
    //         $param_email = $email;

    //         // Attempt to execute the prepared statement
    //         if (mysqli_stmt_execute($stmt)) {
    //             // Get the result
    //             $result = mysqli_stmt_get_result($stmt);

    //             // Check if a matching record was found.
    //             if (mysqli_num_rows($result) == 1) {
    //                 // Fetch the result row
    //                 $row = mysqli_fetch_assoc($result);

                    
    //                // Verify the password
    //                 if ($password === $row["password"]) {
    //                     // Password is correct, start a new session and redirect the user to a dashboard or home page.
    //                     $_SESSION["loggedin"] = true;
    //                     $_SESSION["email"] = $email;

    //                     // Query to get membership details
    //                     $sql_member = "SELECT * FROM Memberships WHERE account_id = " . $row['account_id'];
    //                     $result_member = mysqli_query($link, $sql_member);

    //                     if ($result_member) {
    //                         $membership_row = mysqli_fetch_assoc($result_member);

    //                         if ($membership_row) {
    //                             $_SESSION["account_id"] = $membership_row["account_id"];
    //                             header("location: ../home/home.php"); // Redirect to the home page
    //                             exit;
    //                         } else {
    //                             // No membership details found
    //                             $password_err = "No membership details found for this account.";
    //                         }
    //                     } else {
    //                         // Error in membership query
    //                         $password_err = "Error fetching membership details: " . mysqli_error($link);
    //                     }
    //                 } else {
    //                     // Password is incorrect
    //                     $password_err = "Invalid password. Please try again.";
    //                 }


    //             } else {
    //                 // No matching records found
    //                 $email_err = "No account found with this email.";
    //             }
    //         } else {
    //             echo "Oops! Something went wrong. Please try again later.";
    //         }

    //         // Close the statement
    //         mysqli_stmt_close($stmt);
    //     }
    // }
    // }

?>