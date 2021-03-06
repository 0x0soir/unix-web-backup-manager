<?php
$this->load->view('_/header', array(
    'menu_active' => 'backups_all_scripts'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Backups</h1>
</div>
<?= $this->load->get_notifications() ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="pull-left">Listado de tareas programadas (Todas)</h3>
            </div>
            <div class="card-block p-4">
                <?php if (isset($scripts) && (count($scripts) > 0)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de fin</th>
                                    <th class="text-center"><span data-feather="file"></span> Directorio</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($scripts as $backup): ?>
                                    <tr>
                                        <td><?= $backup->id ?></td>
                                        <td><?= $backup->get_type_text() ?></td>
                                        <td><?= $backup->get_state_text() ?></td>
                                        <td><?= get_real_date($backup->start_date)?></td>
                                        <td><?= get_real_date($backup->end_date) ?></td>
                                        <td><?= $backup->source_directory ?></td>
                                        <td align="right" class="p-0 pt-1">
                                            <a href="/Backups/backup/<?= $backup->id ?>" class="btn btn-primary btn-sm">Información</a>
                                            <a href="/Backups/backup_delete/<?= $backup->id ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">¡Aviso!</h5>
                            <p class="card-text">Actualmente no existen scripts programados.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->load->view('_modals/_new_backup') ?>
<?= $this->load->view('_modals/_select_directory', array()) ?>
<?php
$this->load->view('_/footer', array(
    'js_scripts' => TRUE
));
?>
