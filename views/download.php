<?php
$this->load->view('_/header', array('NOT_INCLUDES' => TRUE));
?>
    <body class="section_login">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="logo text-center">
                            <span class="logo">TFG</span> <span class="logo logo-red">Admin</span>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h2 class="text-center">Descargar copia de seguridad</h2>
                            </div>
                            <div class="card-body">
                                <div class="loader" style="display: none;"></div>
                                <form method="POST" action="/Backups/download_backup/<?= $backup_id ?>/<?= $backup_file_id ?>" class="needs-validation" novalidate="" name="download">
                                    <?= $backup_name ?> (<?= $backup_date ?>)
                                    <br><br>
                                    <div class="form-group">
                                        <label for="password" class="d-block">Contraseña
                                        </label>
                                        <input id="download_password" type="password" class="form-control" name="download_password" tabindex="2" required="">
                                        <div class="invalid-feedback">Inserta tu contraseña</div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Descargar fichero</button>
                                        <a href="/" class="btn btn-success btn-block" tabindex="4">Volver a inicio</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center">Copyright © Jorge Parrilla</div>
                    </div>
                </div>
            </div>
        </section>

    </body>
<?php
$this->load->view('_/footer', array(
        'NOT_INCLUDES' => TRUE,
        'user' => TRUE
    )
);
?>
