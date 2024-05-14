<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/login.css">

</head>
<body>
    <div class="login-container">
    <div class="login_wrapper">
        <a class="nav-link" href="/"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a>
    
        <div class="wrapper">
           
            <form action="login.php" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter User Email" required>
                
                </div>

            <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter User Password" required>
                </div>
                    <button class="btn btn-dark" style="background-color:black;" type="submit" name="submit" value="Login">Login</button>
                
            </form>

            <p id="registration-link">Don't have an account? <a href="/register">Proceed to Register</a></p>
        </div>
    </div>
    </div>
</body>
</html>
