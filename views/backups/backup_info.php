<?php
$this->load->view('_/header', array(
    'menu_active' => 'backups_scripts'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Información del backup</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="/Backups/scripts" class="btn btn-sm btn-primary"><span data-feather="skip-back"></span> Volver al listado</a>
      </div>
    </div>
</div>
<?= $this->load->get_notifications() ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Información básica</h3>
            </div>
            <div class="card-block p-4">
                <?= $this->load->view('_forms/_new_backup', array('backup_info' => $backup_info)) ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Copias realizadas</h3>
            </div>
            <div class="card-block p-4">
                <?php if (isset($backup_files) && (count($backup_files) > 0)): ?>
                    <?php foreach($backup_files as $file): ?>
                        <div class="row backup-file">
                            <div class="col-1 backup-file-image">
                                <img src="/assets/images/<?= str_replace('.', '_', $file->type) ?>_archive_icon.png" />
                            </div>
                            <div class="col-9 backup-file-info">
                                <h5>Extensión del fichero: <?= $file->type ?></h5>
                                <h5>Fecha de generación: <?= $file->created_at ?></h5>
                                <h5>Tamaño: <?= get_bytes_correct_format($file->size) ?></h5>
                            </div>
                            <div class="col-2 backup-file-links">
                                <a href="<?= $file->download_link() ?>" class="btn btn-sm btn-block btn-success"><span data-feather="download"></span> Descargar</a>
                                <a href="<?= $file->remove_link() ?>" class="btn btn-sm btn-block btn-danger"><span data-feather="delete"></span> Eliminar</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card text-white bg-info">
                      <div class="card-body">
                        <h5 class="card-title">¡Aviso!</h5>
                        <p class="card-text">Actualmente no existen ficheros generados para esta copia de seguridad programada.</p>
                      </div>
                    </div>
                <?php endif; ?>
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
                <?php if (isset($backup_logs) && (count($backup_logs) > 0)): ?>
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
                                <?php foreach($backup_logs as $history): ?>
                                    <tr>
                                        <td><?= $history->history ?></td>
                                        <td><?= $history->ip ?></td>
                                        <td><?= $history->created_at ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="card text-white bg-info">
                      <div class="card-body">
                        <h5 class="card-title">¡Aviso!</h5>
                        <p class="card-text">Actualmente no existen datos históricos generados para esta copia de seguridad programada.</p>
                      </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_modals/_select_directory', array());
?>
<?php
$this->load->view('_/footer', array(
    'js_scripts' => TRUE
));
?>
