;$(document).ready(function() {

    function decodeEntities(encodedString) {
        var textArea = document.createElement('textarea');

        textArea.innerHTML = encodedString;

        return textArea.value;
    }

    function get_directories_to_table(target_dir) {
        var url = "/backups/get_directories";

        $('.new_select_directory_loader').fadeIn();
        $('#loaded_directories').hide();

        $.ajax({
            type: "POST",
            url: url,
            data: {target_dir: target_dir},
            success: function(data)
            {
                var data_json = jQuery.parseJSON(data);

                if (data_json.status == 1) {
                    $('#loaded_directories tbody').html(decodeEntities(data_json.directories));
                    feather.replace();

                    $('#loaded_directories .actual_directory').text(data_json.actual_directory);

                    $('.new_select_directory_loader').fadeOut('slow', function(){
                        $('#loaded_directories').fadeIn();
                    });
                } else {
                    swal('¡Ops!', 'Se ha producido un error al cargar los directorios.', 'error');

                    $('.new_select_directory').fadeOut('slow', function(){
                        $('#new_backup_modal').fadeIn();
                    });
                }
            }
        });
    }

    $(document).on('click', '#new_select_directory_use', function(e){
        $('[name=source_directory]').val($('#loaded_directories .actual_directory').text());

        $('.new_select_directory').modal('hide');
        $('.new_backup_modal').modal('show');
    });

    $(document).on('click', '[name=source_directory]', function(e) {
        $('.new_backup_modal').modal('hide');
        $('.new_select_directory').modal('show');

        get_directories_to_table();
    });

    $(document).on('click', '#loaded_directories tbody tr', function(){
        get_directories_to_table($(this).attr('data-path'));
    });

    $(document).on('click', '#new_backup_submit', function(e){
        var url = "/backups/backup_save";

        $('#new_backup_form').fadeOut('slow', function(){
            $('.new_backup_loader').fadeIn();
        });

        $.ajax({
            type: "POST",
            url: url,
            data: $("#new_backup_form").serialize(),
            success: function(data)
            {
                var data_json = jQuery.parseJSON(data);

                if (data_json.status == 1) {
                    $('.new_backup_modal').modal('hide');

                    swal({
                        title: "¡Bien!",
                        text: "El backup se ha programado correctamente.",
                        type: "success",
                        icon: "success",
                        timer: 1500
                    }).then(
                        (value) => {
                            window.location = window.location;
                        }
                    );
                } else {
                    swal('¡Ops!', 'Se ha producido un error al guardar el backup, revisa que has rellenado los campos correctamente.', 'error');

                    $('.new_backup_loader').fadeOut('slow', function(){
                        $('#new_backup_form').fadeIn();
                    });
                }
            }
        });

        e.preventDefault();
    });

});
