<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="login-container">
    <div class="login_wrapper">
        <a class="nav-link" href="/"> <h1 class="text-center" style="font-family:Copperplate; color:white;"> JOHNNY'S</h1><span class="sr-only"></span></a>
    
        <div class="wrapper">
            <div class="alert msg-field alert-danger mb-3 rounded-0 main_error"></div>

            <form id="loginForm">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter User Email">
                    <div class="alert p-1 msg-field alert-danger rounded-0 mt-2 err_msg email-error"></div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter User Password">
                    <div class="alert p-1 msg-field alert-danger rounded-0 mt-2 err_msg password-error"></div>
                </div>
                    <button class="btn btn-dark" style="background-color:black;" type="submit" name="submit" value="Login">Login</button>
            </form>

            <p id="registration-link">Don't have an account? <a href="/register">Proceed to Register</a></p>
        </div>
    </div>
    </div>

    <script src="/js/login.js"></script>
</body>
</html>
