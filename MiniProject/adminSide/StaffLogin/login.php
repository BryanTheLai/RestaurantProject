

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
            border-color: #41403e;
            height:40px;
            width:66px;
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
    <p>&nbsp;&nbsp;&nbsp;</p> 
    <section id="signup">
    <div class="container my-6 ">
    <a class="nav-link" href="../../customerSide/home/home.php"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a>
    <p>&nbsp;&nbsp;&nbsp;</p>
    <div class="wrapper">
    <h2 class="text-center" style="font-family: serif; color:white;">Staff Login</h2>
    <p class="text-center" style="font-family: serif; color:white;">Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

    <form action="login_process.php" method="post" style=" font-family: serif;">
        <div class="form-group">
            <label for="account_id">Account ID :</label>
            <input type="number" id="account_id" name="account_id" placeholder="Enter Account ID" required class="form-control <?php echo (!empty($account_id)) ? 'is-invalid' : ''; ?>" value="<?php echo $account_id; ?>">
            <span class="invalid-feedback"><?php echo $account_id; ?></span>
        </div>
        
        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        </div>
            
            <div class="form-group">
                <button type="submit" name="submit" value="Login">Login</button>
            </div>
    </form>
    </div>
</body>
</html>