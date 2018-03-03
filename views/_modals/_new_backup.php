<div class="modal fade new_backup_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo backup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="loader new_backup_loader" style="display: none;"></div>
                <form id="new_backup_form" method="post" action="/backups/backup_save">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="recipient-name" class="col-form-label"><span data-feather="info"></span> Tipo:</label>
                            <select class="form-control" name="type">
                                <option value="0">Diario</option>
                                <option value="1">Semanal</option>
                                <option value="2">Mensual</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="zap"></span> Estado:</label>
                            <select class="form-control" name="status">
                                <option value="0">Funcionando</option>
                                <option value="1">Pausado</option>
                                <option value="2">Eliminado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="calendar"></span> Fecha de inicio:</label>
                            <input size="16" name="start_date" type="text" value="" class="form-control form_datetime" placeholder="Haga click para desplegar el selector" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="calendar"></span> Fecha de fin:</label>
                            <input size="16" name="end_date" type="text" value="" class="form-control form_datetime" placeholder="Haga click para desplegar el selector" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="folder"></span> Directorio origen:</label>
                            <input size="16" name="source_directory" type="text" value="" class="form-control" placeholder="Haga click para ver los directorios disponibles" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="folder"></span> Directorio destino:</label>
                            <input size="16" name="target_directory" type="text" value="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="file-minus"></span> Excluir extensiones:</label>
                            <textarea class="form-control" name="excluded_extensions"></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="message-text" class="col-form-label"><span data-feather="folder-minus"></span> Excluir directorios:</label>
                            <textarea class="form-control" name="excluded_directories"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success btn-sm" id="new_backup_submit">Crear</button>
            </div>
        </div>
    </div>
</div>
