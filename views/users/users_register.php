<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_register'
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
                <h3 class="pull-left">Solicitudes de registro</h3>
            </div>
            <div class="card-block p-4">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= $user->email ?></td>
                                    <td align="right" class="p-0 pt-1">
                                        <a href="/Users/user_accept/<?= $user->id ?>" class="btn btn-primary btn-sm">Aceptar</a>
                                        <a href="/Users/user_delete/<?= $user->id ?>" class="btn btn-danger btn-sm">Rechazar</a>
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
