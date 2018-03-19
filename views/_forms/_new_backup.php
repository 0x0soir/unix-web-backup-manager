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
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="folder"></span> Directorio origen:</label>
            <input size="16" name="source_directory" type="text" value="<?= isset($backup_info) ? $backup_info->source_directory : '' ?>" class="form-control" placeholder="Haga click para ver los directorios disponibles" readonly>
        </div>
        <div class="form-group col-6">
            <label for="message-text" class="col-form-label"><span data-feather="folder"></span> Directorio destino:</label>
            <input size="16" name="target_directory" type="text" value="<?= isset($backup_info) ? $backup_info->target_directory : '' ?>" class="form-control">
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
    <?= isset($backup_info) ? '<button type="submit" class="btn btn-success">Actualizar datos</button>' : '' ?>
</form>
