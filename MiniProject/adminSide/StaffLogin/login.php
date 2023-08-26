

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
         body {
            font-family: 'Montserrat', sans-serif;
            color: white;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
        h2{
            text-align: center;
        }
    </style>
</head>
<body>
    <p>&nbsp;&nbsp;&nbsp;</p> 
    <section id="signup">
    <div class="container my-6 ">
    <a class="nav-link" href="../../customerSide/home/home.php"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a>
    <p>&nbsp;&nbsp;&nbsp;</p>
    <div class="wrapper">
    <h2>Staff Login</h2>
    <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

    <form action="login_process.php" method="post">
        <div class="form-group">
            <label for="staff_id">Staff ID:</label>
            <input type="number" id="staff_id" name="staff_id" required class="form-control <?php echo (!empty($staff_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $staff_id; ?>">
            <span class="invalid-feedback"><?php echo $staff_id_err; ?></span>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        </div>
            
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
    </form>

</body>
</html>
