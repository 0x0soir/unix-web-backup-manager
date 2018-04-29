<?php
$this->load->view('_/header', array(
    'menu_active' => 'dashboards_index'
));
?>
<div class="row">
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Tamaño máximo</h5>
                <p class="card-text">
                    <?= $max_size ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Tamaño usado</h5>
                <p class="card-text">
                    <?= $used_size ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Backups programados</h5>
                <p class="card-text">
                    <?= count($scripts) ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Backups realizados</h5>
                <p class="card-text">
                    <?= $backups ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
