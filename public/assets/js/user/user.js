;$(document).ready(function() {

    $('#login_form').on('submit', function(event){
        var url = "/user/login";
        event.preventDefault();

        $('#login_form').fadeOut('slow');
        $('#login_form').siblings('.loader').fadeIn();

        $.ajax({
            type: "POST",
            url: url,
            data: $("#login_form").serialize(),
            success: function(data)
            {
                var data_json = jQuery.parseJSON(data);
                if (data_json.loggin_status != true) {
                    $('.section_login').find('.green-font').addClass('red-font').removeClass('green-font');
                    $('.section_login').find('.login-form').addClass('login-form-red').removeClass('login-form-green');

                    swal('¡Ops!', 'Se ha producido un error con tu usuario o contraseña.', 'error');

                    $('#login_form').siblings('.loader').fadeOut('slow', function(){
                        $('#login_form').fadeIn();
                    });
                } else {
                    swal('¡Bien!', 'Has iniciado sesión correctamente.', 'success').then((value) => {
                        window.location = data_json.url;
                    });
                }
            }
        });
    });
});
