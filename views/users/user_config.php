<?php
$this->load->view('_/header', array(
    'menu_active' => 'users_users'
));
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center p-4 mb-3 main_section_header">
    <h1>Preferencias</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="/Users/users" class="btn btn-sm btn-primary"><span data-feather="skip-back"></span>Volver a inicio</a>
      </div>
    </div>
</div>
<?= $this->load->get_notifications() ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Notificaciones</h3>
            </div>
            <div class="card-block p-4">
                <form action="/Users/user_config_save/<?= $user_info->id ?>" method="post">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Memoria insuficiente</label>
                        <div class="col-10">
                            <input <?= $user_info->send_memory_mails == TRUE ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="memory" type="checkbox">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Nueva copia realizada</label>
                        <div class="col-10">
                            <input <?= $user_info->send_backup_done_mails == TRUE ? 'checked' : '' ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" name="new_backup" type="checkbox">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rgpd-check" name="rgpd-check" <?= $user_info->rgpd_status == TRUE ? 'checked' : '' ?>>
                        <label class="form-check-label" for="rgpd-check">Acepto recibir comunicaciones según lo establecido en la <a href="<?= WEBSITE_HOST ?>dashboards/rgpd" target="_blank">política de privacidad</a></label>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('_/footer', array());
?>
