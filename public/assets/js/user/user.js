;$(document).ready(function() {

    $('#login_form').on('submit', function(event){
        var url = "/users/login";
        event.preventDefault();

        $('#login_form').fadeOut('slow', function(){
            $('#login_form').siblings('.loader').fadeIn();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: $("#login_form").serialize(),
            success: function(data)
            {
                var data_json = jQuery.parseJSON(data);
                if (data_json.loggin_status != true) {

                    swal('¡Ops!', 'Se ha producido un error con tu usuario o contraseña.', 'error');

                    $('#login_form').siblings('.loader').fadeOut('slow', function(){
                        $('#login_form').fadeIn();
                    });
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
});
