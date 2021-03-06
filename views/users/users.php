<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_users'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Usuarios</h1>
</div>
<?= $this->load->get_notifications() ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="pull-left">Listado de usuarios</h3>
                <div class="pull-right btn-group">
                    <a href="/Users/user_new" class="btn btn-sm btn-outline-secondary"><span data-feather="plus"></span> Añadir</a>
                </div>
            </div>
            <div class="card-block p-4">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Última conexión</th>
                                <th class="text-center"><span data-feather="file"></span> Backups programados</th>
                                <th class="text-center"><span data-feather="command"></span> Backups realizados</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->last_login ? $user->last_login->format('Y-m-d H:i:s') : 'Nunca' ?></td>
                                    <td align="center"><span class="badge badge-success"><?= count($user->backups) ?></span></td>
                                    <td align="center"><span class="badge badge-dark"><?= array_key_exists($user->id, $user_backup_files_count) ? $user_backup_files_count[$user->id] : '0' ?></span></td>
                                    <td align="right" class="p-0 pt-1">
                                        <a href="/Users/user/<?= $user->id ?>" class="btn btn-primary btn-sm">Información</a>
                                        <a href="/Users/user_delete/<?= $user->id ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
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
