<form id="new_backup_form" method="post" action="/backups/backup_save/<?= isset($backup_info) ? $backup_info->id : '' ?>">
    <div class="row">
        <div class="form-group col-6">
            <label for="recipient-name" class="col-form-label"><span data-feather="info"></span> Tipo:</label>
            <select class="form-control" name="type">
                <?php if (isset($backup_info)): ?>
                    <?php foreach ($backup_info->get_types() as $type_key => $type_value): ?>
                        <option value="<?= $type_key ?>" <?= $type_value == $backup_info->get_type_text() ? 'selected' : '' ?>><?= $type_value ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach (((object) new Backup())->get_types() as $type_key => $type_value): ?>
                        <option value="<?= $type_key ?>"><?= $type_value ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="zap"></span> Estado:</label>
            <select class="form-control" name="state">
                <?php if (isset($backup_info)): ?>
                    <?php foreach ($backup_info->get_states() as $type_key => $type_value): ?>
                        <option value="<?= $type_key ?>" <?= $type_value == $backup_info->get_state_text() ? 'selected' : '' ?>><?= $type_value ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach (((object) new Backup())->get_states() as $type_key => $type_value): ?>
                        <option value="<?= $type_key ?>"><?= $type_value ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="calendar"></span> Fecha de inicio:</label>
            <input size="16" name="start_date" type="text" value="<?= isset($backup_info) ? get_real_date($backup_info->start_date) : '' ?>" class="form-control form_datetime" placeholder="Haga click para desplegar el selector" readonly>
        </div>
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="calendar"></span> Fecha de fin:</label>
            <input size="16" name="end_date" type="text" value="<?= isset($backup_info) ? get_real_date($backup_info->end_date) : '' ?>" class="form-control form_datetime" placeholder="Haga click para desplegar el selector" readonly>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="message-text" class="col-form-label"><span data-feather="folder"></span> Directorio origen:</label>
            <input size="16" name="source_directory" type="text" value="<?= isset($backup_info) ? $backup_info->source_directory : '' ?>" class="form-control" placeholder="Haga click para ver los directorios disponibles" readonly>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Excluir extensiones:</label>
            <textarea class="form-control" name="excluded_extensions"><?= isset($backup_info) ? $backup_info->excluded_extensions : '' ?></textarea>
        </div>
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="folder-minus"></span> Excluir directorios:</label>
            <textarea class="form-control" name="excluded_directories"><?= isset($backup_info) ? $backup_info->excluded_directories : '' ?></textarea>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 alert alert-info">
            <span data-feather="command"></span> Ctrl+click (command+click en Mac) para seleccionar múltiples elementos.
        </div>
        <div class="form-group col-4 col-md-2">
            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Horas:</label>
            <select multiple="" size="10" name="selectHours[]" class="form-control">
                <?php for ($i = 0; $i <= 23; $i++): ?>
                    <option value="<?= $i ?>" <?= isset($backup_info) ? in_array($i, $backup_info->get_cronjob_hours()) ? 'selected' : '' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group col-4 col-md-2">
            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Minutos:</label>
            <select multiple="" size="10" name="selectMinutes[]" class="form-control">
                <?php for ($i = 0; $i <= 59; $i++): ?>
                    <option value="<?= $i ?>" <?= isset($backup_info) ? in_array($i, $backup_info->get_cronjob_minutes()) ? 'selected' : '' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group col-4 col-md-2">
            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Días:</label>
            <select multiple="" size="10" name="selectDays[]" class="form-control">
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <option value="<?= $i ?>" <?= isset($backup_info) ? in_array($i, $backup_info->get_cronjob_days()) ? 'selected' : '' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group col-6 col-md-3">
            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Meses:</label>
            <select multiple="" size="10" name="selectMonths[]" class="form-control">
                <option value="1" <?= isset($backup_info) ? in_array("1", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Enero</option>
                <option value="2" <?= isset($backup_info) ? in_array("2", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Febrero</option>
                <option value="3" <?= isset($backup_info) ? in_array("3", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Marzo</option>
                <option value="4" <?= isset($backup_info) ? in_array("4", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Abril</option>
                <option value="5" <?= isset($backup_info) ? in_array("5", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Mayo</option>
                <option value="6" <?= isset($backup_info) ? in_array("6", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Junio</option>
                <option value="7" <?= isset($backup_info) ? in_array("7", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Julio</option>
                <option value="8" <?= isset($backup_info) ? in_array("8", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Agosto</option>
                <option value="9" <?= isset($backup_info) ? in_array("9", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Septiembre</option>
                <option value="10" <?= isset($backup_info) ? in_array("10", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Octubre</option>
                <option value="11" <?= isset($backup_info) ? in_array("11", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Noviembre</option>
                <option value="12" <?= isset($backup_info) ? in_array("12", $backup_info->get_cronjob_months()) ? 'selected' : '' : '' ?>>Diciembre</option>
            </select>
        </div>
        <div class="form-group col-6 col-md-3">
            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Días de la semana:</label>
            <select multiple="" size="10" name="selectWeekDays[]" class="form-control">
                <option value="0" <?= isset($backup_info) ? in_array("0", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Domingo</option>
                <option value="1" <?= isset($backup_info) ? in_array("1", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Lunes</option>
                <option value="2" <?= isset($backup_info) ? in_array("2", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Martes</option>
                <option value="3" <?= isset($backup_info) ? in_array("3", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Miércoles</option>
                <option value="4" <?= isset($backup_info) ? in_array("4", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Jueves</option>
                <option value="5" <?= isset($backup_info) ? in_array("5", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Viernes</option>
                <option value="6" <?= isset($backup_info) ? in_array("6", $backup_info->get_cronjob_week_days()) ? 'selected' : '' : '' ?>>Sábado</option>
            </select>
        </div>
    </div>
    <?= isset($backup_info) ? '<button type="submit" class="btn btn-success">Actualizar datos</button>' : '' ?>
</form>
