<div class="modal fade new_select_directory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccionar directorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height:400px; overflow:auto;">
                <div class="loader new_select_directory_loader"></div>
                <div id="loaded_directories">
                    <div class="alert alert-dark" role="alert">
                        <h6 class="modal-title">Directorio actual: <span class="actual_directory"></span></h6>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                      <thead>
                        <tr>
                          <th scope="col">Directorio</th>
                          <th scope="col">Tamaño</th>
                          <th scope="col">Última modificación</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" id="new_select_directory_close">Volver a edición</button>
                <button type="button" class="btn btn-success btn-sm" id="new_select_directory_use">Usar directorio actual</button>
            </div>
        </div>
    </div>
</div>
