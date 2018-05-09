<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_users'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Usuarios</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="/Users/users" class="btn btn-sm btn-primary"><span data-feather="skip-back"></span>Volver al listado</a>
      </div>
    </div>
</div>
<?= $this->load->get_notifications() ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Nuevo usuario</h3>
            </div>
            <div class="card-block p-4">
                <form action="/Users/user_save" method="post" autocomplete="off">
                    <input id="username" style="display:none" type="text" name="fakeusernameremembered">
                    <input id="password" style="display:none" type="password" name="fakepasswordremembered">

                    <div class="form-group row">
                        <label class="col-2 col-form-label">Nombre de usuario</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Correo electrónico</label>
                        <div class="col-10">
                            <input class="form-control" type="email" value="" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Tamaño máximo permitido</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="" name="max_size" autocomplete="nope">
                            <small class="form-text text-muted">Expresado en bytes, es el tamaño máximo que podrá usar el usuario al generar copias.</small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Contraseña de acceso</label>
                        <div class="col-10">
                            <input class="form-control" type="password" name="password" autocomplete="new-password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Crear usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
