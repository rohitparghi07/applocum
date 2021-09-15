$(document).ready(function () {
        
        //login form jquery validation
        $('#login-form').validate({
            rules: {
                email: {
                    required: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                user_name: {
                    required: "Please enter a user name",
                    remote:"Please enter valid user name"
                },
                password: {
                    required: "Please provide a password",
                },
            
            },
            errorElement: 'label',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        // message remove after 3 second
        setTimeout(() => {
            $("#headerMsg").empty();
        }, 8000);
    });