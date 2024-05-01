<?php 
session_start();
if(isset($_SESSION['logged_account_id'])) {
    header("Location: ../panel/pos-panel.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
         body {
            font-family: 'Montserrat', sans-serif;
            color: white;
            background-color: #1C1427;
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

    
    <div class="wrapper">
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

    <form action="login_process.php" method="post" >
        <div class="form-group">
            <label for="account_id">Staff Account ID</label>
            <input type="number" id="account_id" name="account_id" placeholder="Enter Account ID" required class="form-control <?php echo (!empty($account_id)) ? 'is-invalid' : ''; ?>" value="<?php echo $account_id; ?>">
            <span class="invalid-feedback"><?php echo $account_id; ?></span>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        </div>
            
            <div class="form-group">
                <button class="btn btn-light" type="submit" name="submit" value="Login">Login</button>
            </div>
    </form>
    </div>
</body>
</html>
