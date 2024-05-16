$(document).ready(function () {
    // VALIDATION

    $('#loginForm').submit(function (e) {
        e.preventDefault();

        $('.err_msg').text(''); // Clear all error messages
        $('.is-invalid').removeClass('is-invalid'); // Remove the invalid class from all elements
        $('.main_error').text(''); // Clear the main error message

        let formData;
        
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
                } else if (response.status === 'failed'){
                    // console.error(response);
                    handleValidation(response.message);
                    console.log("here");
                } else {
                    $('.main_error').text("There's an error occurred!");
                }
            }
        });
    });

    function handleValidation(errors) {
        
        let credentialErrors = false; 
        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
                if(key === "login_credentials") {
                $('.main_error').text(errors[key]); // Display main error message
                credentialErrors = true; // Set the flag to true
                } else {
                    let $input = $('[name="' + key + '"]');
                    $input.addClass('is-invalid');
                    $input.siblings('.err_msg').text(errors[key]);
                }
            }
        }

        if(!credentialErrors) {
            $('.main_error').text('');
        }
    }

    $('#loginForm input').on('input', function() {
        var $input = $(this);
        $input.removeClass('is-invalid');
        $input.siblings('.err_msg').text('');
    });

});