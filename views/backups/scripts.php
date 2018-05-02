<?php
$this->load->view('_/header', array(
    'menu_active' => 'backups_scripts'
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
                <h3 class="pull-left">Listado de tareas programadas (Propias)</h3>
                <div class="pull-right btn-group">
                    <button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".new_backup_modal"><span data-feather="plus"></span> Añadir</button>
                    <a href="/Backups/pause_all_scripts" class="btn btn-sm btn-outline-secondary"><span data-feather="pause"></span> Pausar todos</a>
                    <a href="/Backups/play_all_scripts" class="btn btn-sm btn-outline-secondary"><span data-feather="refresh-ccw"></span> Reanudar todos</a>
                </div>
            </div>
            <div class="card-block p-4">
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
