<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_users'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Usuarios</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Última conexión</th>
                        <th class="text-center"><span data-feather="file"></span> Backups realizados</th>
                        <th class="text-center"><span data-feather="command"></span> Backups programados</th>
                        <th class="text-right">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->last_login ? $user->last_login : 'Nunca' ?></td>
                            <td align="center"><span class="badge badge-success">0</span></td>
                            <td align="center"><span class="badge badge-dark">0</span></td>
                            <td align="right" class="p-0 pt-1">
                                <button type="button" class="btn btn-primary btn-sm">Información</button>
                                <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
