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
                                <h2 class="text-center">Iniciar sesión</h2>
                            </div>
                            <div class="card-body">
                                <div id="login-loader" class="loader" style="display: none;"></div>
                                <form method="POST" action="#" class="needs-validation" novalidate="" id="login_form">
                                    <div class="form-group">
                                        <label for="email">Usuario</label>
                                        <input id="username" type="text" class="form-control" name="username" tabindex="1" required="" autofocus="">
                                        <div class="invalid-feedback">Inserta tu nombre de usuario</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="d-block">Contraseña
                                            <div class="float-right">
                                                <a href="forgot.html">¿Contraseña olvidada?</a>
                                            </div>
                                        </label>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required="">
                                        <div class="invalid-feedback">Inserta tu contraseña</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Recordarme</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" tabindex="4">Iniciar sesión</button>
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
