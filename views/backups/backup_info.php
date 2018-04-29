<?php
$this->load->view('_/header', array(
    'menu_active' => 'backups_scripts'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Información del backup</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="/Backups/backups" class="btn btn-sm btn-primary">Volver al listado</a>
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
                <?php foreach($backup_files as $file): ?>
                    <div class="row backup-file">
                        <div class="col-1 backup-file-image">
                            <img src="/assets/images/tar_archive_icon.png" />
                        </div>
                        <div class="col-11 backup-file-info">
                            <h5>Formato: <?= $file->type ?></h5>
                        </div>
                    </div>
                <?php endforeach; ?>
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
