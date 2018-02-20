<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_users'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Información de usuario</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="/Users/users" class="btn btn-sm btn-primary">Volver al listado</a>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Información básica</h3>
            </div>
            <div class="card-block p-4">
                <form action="/Users/user_save/<?= $user_info->id ?>" method="post">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Nombre de usuario</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="<?= $user_info->username ?>" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Correo electrónico</label>
                        <div class="col-10">
                            <input class="form-control" type="email" value="<?= $user_info->email ?>" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Última sesión</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="<?= $user_info->last_login ?>" name="last_login" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Fecha de registro</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="<?= $user_info->created_at ?>" name="reg_date" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Última edición</label>
                        <div class="col-10">
                            <input class="form-control" type="text" value="<?= $user_info->updated_at ?>" name="mod_date" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Nueva contraseña</label>
                        <div class="col-10">
                            <input class="form-control" type="password" name="password">
                            <small class="form-text text-muted">Rellenar únicamente si se desea actualizar la contraseña.</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Historial</h3>
            </div>
            <div class="card-block p-4">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><span data-feather="list"></span> Historial</th>
                                <th><span data-feather="globe"></span> IP</th>
                                <th><span data-feather="clock"></span> Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($user_history as $history): ?>
                                <tr>
                                    <td><?= $history->history ?></td>
                                    <td><?= $history->ip ?></td>
                                    <td><?= $history->created_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
