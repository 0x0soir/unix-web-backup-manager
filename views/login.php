<?php
$this->load->view('_/header', array('NOT_INCLUDES' => TRUE));
?>
    <body class="section_login">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex align-self-center justify-content-center col-lg-12 p-0 ">
                    <div class="col-10 col-sm-10 col-md-7 col-lg-4 login-form login-form-green green-font p-4">
                        <h4 class="d-flex justify-content-center">Iniciar sesión</h4>
                        <div class="loader" style="display: none;"></div>
                        <form id="login_form">
                            <div class="form-group">
                                <input type="text" class="form-control dark-input-text" name="username" placeholder="Introducir nombre de usuario">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Introducir contraseña">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Iniciar sesión">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php
$this->load->view('_/footer', array(
        'NOT_INCLUDES' => TRUE,
        'user' => TRUE
    )
);
?>
