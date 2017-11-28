<?php
$this->load->view('_/header');
?>
    <body>
        <main role="main" class="container">
            <div class="mainbox col-xl-4 col-xl-offset-3  col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-3">
                <div class="card card-body">
                    <h4 class="card-title">Admin</h4>
                    <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">

                        <div class="input-group">
                            <span class="input-group-addon" style="width: 41px;"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input id="user" type="text" class="form-control" name="user" value="" placeholder="Usuario">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Clave de acceso">
                        </div>

                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button type="submit" href="#" class="btn btn-primary" style="width: 100%;"><i class="glyphicon glyphicon-log-in"></i> Iniciar sesión</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </main>
        <div id="particles-js"></div>
    </body>
<?php
$this->load->view('_/footer', array());
?>
