<!-- Modal Carga Masiva -->
<div class="modal fade" id="cargar-egresados" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Carga masiva de egresados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="form-carga-masiva-egresados">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cvsFile" class="form-label">Seleccionar archivo .csv</label>
                        <input class="form-control mb-2" type="file" id="csvEgresadosFile" name="csv_file" accept=".csv" required>
                        <small>Los archivos .csv deben respetar el formato pre establecido</small>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
                    <button type="submit" id="cme-btn" class="btn btn-primary" data-bs-dismiss="modal">Subir</button>
                </div>
            </form>
        </div>
    </div> 
</div> 
