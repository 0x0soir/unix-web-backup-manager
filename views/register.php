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
                                <h2 class="text-center">Registro de cuenta</h2>
                            </div>
                            <div class="card-body">
                                <div id="login-loader" class="loader" style="display: none;"></div>
                                <form method="POST" action="#" class="needs-validation" novalidate="" id="register_form">
                                    <div class="form-group">
                                        <label for="email">Usuario</label>
                                        <input id="username" type="text" class="form-control" name="username" tabindex="1" required="true" autofocus="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="2" required="true" autofocus="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Contraseña</label>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="3" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Repite la contraseña</label>
                                        <input id="password2" type="password" class="form-control" name="password2" tabindex="4" required="true">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Solicitar registro</button>
                                    </div>
                                    <div class="form-group">
                                        <a href="/Users/index" class="btn btn-warning btn-block"><< Iniciar sesión</a>
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
