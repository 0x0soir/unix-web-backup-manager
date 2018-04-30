<?php
$this->load->view('_/header', array(
    'menu_active' => 'dashboards_index'
));
?>
<div class="row">
    <div class="col-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="database"></span> Tamaño máximo</h5>
                <h1 class="card-text text-center">
                    <?= $max_size ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="copy"></span> Tamaño usado</h5>
                <h1 class="card-text text-center">
                    <?= $used_size ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="database"></span> Backups programados</h5>
                <h1 class="card-text text-center">
                    <?= count($scripts) ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title text-center"><span data-feather="clock"></span> Backups realizados</h5>
                <h1 class="card-text text-center">
                    <?= $backups ?>
                </h1>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
