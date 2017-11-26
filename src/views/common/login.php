<?php
$this->load->view('_/header');
?>
    <body>
        <main role="main" class="container">
            <div class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                <div class="card card-body vertical-align-center">
                    <h4 class="card-title">Admin</h4>
                    <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="user" type="text" class="form-control" name="user" value="" placeholder="Usuario">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Clave de acceso">
                        </div>

                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Iniciar sesión</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </body>
<?php
$this->load->view('_/footer', array());
?>
