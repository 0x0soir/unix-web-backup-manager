<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_users'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Notificación</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block p-4">
                <div class="alert alert-success"><?= $message ?></div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
