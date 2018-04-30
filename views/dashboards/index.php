<?php
$this->load->view('_/header', array(
    'menu_active' => 'dashboards_index'
));
?>
<div class="row">
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="database"></span> Tamaño máximo</h5>
                <h1 class="card-text text-center">
                    <?= $max_size ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="copy"></span> Tamaño usado</h5>
                <h1 class="card-text text-center">
                    <?= $used_size ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="database"></span> Backups programados</h5>
                <h1 class="card-text text-center">
                    <?= count($scripts) ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="clock"></span> Backups realizados</h5>
                <h1 class="card-text text-center">
                    <?= $backups ?>
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="pull-left">Tamaño disponible</h3>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $size_percent ?>%;" aria-valuenow="<?= $size_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= round($size_percent) ?>%</div>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= 100-$size_percent ?>%" aria-valuenow="<?= round(100-$size_percent) ?>" aria-valuemin="0" aria-valuemax="100"><?= round(100-$size_percent) ?>%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
