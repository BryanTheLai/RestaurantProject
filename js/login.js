$(document).ready(function () {
    // VALIDATION

    $('#loginForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "../processes/Customers/login-process.php",
            data: $(this).serialize(),
            dataType: "json",
            error: function(err){
                console.error(err);
            },
            success: function (response) {
                if (response.status === 'success') {
                    console.log("success!");
                    window.location.href = '/home'; // This should head back to home
                } else if (response.status === 'failed' ){
                    // console.error(response);
                    for (const key in response.message) {
                        if(key === "email") {
                            console.log(key, response.message[key]);
                        }

                        if (key === "password"){
                            console.log(key, response.message[key]);
                        }

                        if (key === "login_credentials"){
                            console.log(key, response.message[key]);
                        }
                    }
                } else {
                    console.log("Error! There's an internal error happened");
                }
            }
        });
    })

});