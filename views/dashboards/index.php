<?php
$this->load->view('_/header');
?>
    <body>
        <div class="full-container">
            <div class="bar">
                <div class="left">
                    <div class="text-center">
                        <a href="index.html" class="logo">TFG</a>
                        <a href="index.html" class="logo logo-red">Backups</a>
                    </div>
                </div>
                <div class="">
                    <nav class="navbar navbar-expand-md navbar-light bg-faded">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <!-- pendiente -->
                            </ul>
                            <span class="navbar-text" style="position: relative;">
                                <a class="nav-link dropdown-toggle" href="#/" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= get_actual_username() ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="userDropdownMenu" style="right: 0;margin-left: -100px;">
                                  <a class="dropdown-item" href="#">Perfil</a>
                                  <a class="dropdown-item" href="#">Ajustes</a>
                                  <a class="dropdown-item" href="#">Cerrar sesión</a>
                                </div>
                            </span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </body>
<?php
$this->load->view('_/footer', array());
?>
