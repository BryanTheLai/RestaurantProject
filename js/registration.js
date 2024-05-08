$(document).ready(function () {

    $("#register-user input[data-validate='true']").on('input change focusout', function(e) {
        validate($(this).attr('name'), $(this).val());
    });

    $("#register-user").submit(function (e) { 
        e.preventDefault();
        
        $('.main_success, .main_error').text('')
        $('#register-user input[data-validate="true"]').trigger('change');
        if($('#register-user').hasClass('was-validated') !== true){
            return false;
        }
        $("#submit").attr('disabled', true);

        $.ajax({
            type: "POST",
            url: "../processes/Customers/processRegistration.php",
            data: $(this).serialize(),
            dataType: "json",
            error: err => {
                console.error(err);
                $('.main_error').text("An error occurred while saving the data");
                $("#submit").attr('disabled', false);
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('.main_success').html(`<p> ${response.message} </p>`);
                    $('#register-user').removeClass('was-validated');
                    $('#register-user .is-valid').removeClass('is-validated');
                    $('#register-user')[0].reset();
                } else if (response.status === 'error') {
                    if (!!response.error) {
                        $('.main-error').text(response.errors.error_msg);
                    } else {
                        $('.main-error').text("An error occurred.");
                    }
                } else {
                    $('.main-error').text("An error occurred.");
                }
                $("#submit").attr('disabled', false);
            }
        });        
    });



    function validate($field='', $value=''){
        $field = $field.trim();
        $value = $value.trim();


        if($field == "" || $field == null){
            console.error("Input Field Validation Failed: Given Field Name is empty.");
            return false;
        }

        $(`[name="${$field}"]`).removeClass('is-valid is-invalid');
        $("#submit").attr('disabled', true);


        $.ajax({
            type: "POST",
            url: "../processes/Customers/validateRegistration.php",
            data: {field: $field, value: $value},
            dataType: "json",
            error: err=>{
                console.error(err);
                $(`[name="${$field}"]`).addClass('is-invalid');
                $(`[name="${$field}"]`).closest('.err_msg').text("An error occurred while validating the data.");
                $(`[name="${$field}"]`).closest('.input-field').addClass('d-none')
            },
            success: function (response) {
                if(response.status === 'success') {
                    $(`[name="${$field}"]`).addClass('is-valid');
                    $(`[name="${$field}"]`).siblings('.err_msg').text('');
                } else if(response.status === 'failed') {
                    $(`[name="${$field}"]`).addClass('is-invalid');
                    if(!!response.error){
                        $(`[name="${$field}"]`).siblings('.err_msg').text(response.error);
                    } else {
                        $(`[name="${$field}"]`).siblings('.err_msg').text("The given value is invalid.");
                    }
                } else {
                    $(`[name="${$field}"]`).addClass('is-invalid')
                    $(`[name="${$field}"]`).closest('.err_msg').text("The given value is invalid.");
                }

                $(`[name="${$field}"]`).siblings('.input-loader').addClass('d-none');
                check_form_validity();
            }
        });

    }

    function check_form_validity(){
        if($('#register-user .is-invalid').length > 0){
            $("#submit").attr('disabled', true)
        }else{
            $("#submit").attr('disabled', false)
        }
        $('#register-user input[data-validate="true"]').each(function(){
            if($(this).hasClass('is-invalid'))
            return false;
        })
        if($('#register-user input[data-validate="true"]').length == $('#register-user .is-valid').length){
            $('#register-user').addClass('was-validated')
        }
    }



});