;$(document).ready(function() {

    $('#login_form').on('submit', function(event){
        var url = "/users/login";
        event.preventDefault();


        setTimeout(function(){
            $('#login_form').fadeOut('slow', function(){
                $('#login_form').siblings('.loader').fadeIn();
            });
        }, 200);

        $.ajax({
            type: "POST",
            url: url,
            data: $("#login_form").serialize(),
            success: function(data)
            {
                var data_json = jQuery.parseJSON(data);
                if (data_json.loggin_status != true) {

                    swal('¡Ops!', 'Se ha producido un error con tu usuario o contraseña.', 'error');

                    setTimeout(function(){
                        $('#login_form').siblings('.loader').fadeOut('slow', function(){
                            $('#login_form').fadeIn();
                        });
                    }, 500);

                } else {
                    swal({
                        title: "¡Bien!",
                        text: "Has iniciado sesión correctamente.",
                        type: "success",
                        icon: "success",
                        timer: 1500
                    }).then(
                        (value) => {
                            window.location = data_json.url;
                        }
                    );
                }
            }
        });
    });

    $('#register_form').on('submit', function(event){
        var url = "/users/register_data";
        event.preventDefault();

        $('#register_form').fadeOut('slow', function(){
            $('#register_form').siblings('.loader').fadeIn();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: $("#register_form").serialize(),
            success: function(data)
            {
                var data_json = jQuery.parseJSON(data);
                if (data_json.register_status != true) {

                    swal('¡Ops!', 'Se ha producido un error al registrar tu cuenta.', 'error');

                    setTimeout(function(){
                        $('#register_form').siblings('.loader').fadeOut('slow', function(){
                            $('#register_form').fadeIn();
                        });
                    }, 500);

                } else {
                    swal({
                        title: "¡Bien!",
                        text: "Tu cuenta ha sido registrada correctamente, la solicitud de registro debe ser revisada por el administrador del sistema.",
                        type: "success",
                        icon: "success",
                        timer: 10000
                    }).then(
                        (value) => {
                            window.location = data_json.url;
                        }
                    );
                }
            }
        });
    });
});
