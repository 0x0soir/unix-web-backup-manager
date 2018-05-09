<?php
$this->load->view('_/header', array(
    'menu_active' => 'backups_backups'
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
                <h3 class="pull-left">Listado de copias de seguridad (Propias)</h3>
            </div>
            <div class="card-block p-4">
                <div class="col-12">
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
                        <div class="card text-white bg-danger">
                          <div class="card-body">
                            <h5 class="card-title">¡Aviso!</h5>
                            <p class="card-text">Actualmente no existen ficheros generados por ninguna copia de seguridad.</p>
                          </div>
                        </div>
                    <?php endif; ?>
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
