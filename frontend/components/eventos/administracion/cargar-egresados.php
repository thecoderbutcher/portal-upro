<div class="tab-pane fade mb-5" id="v-pills-cargar-egresados" role="tabpanel">
    <div class="col-12 order-md-first mb-3">
        <h2><span class="material-icons">upload</span> Cargar Egresados</h2>
    </div>  
    <div class="d-grid gap-2 col-6 mx-auto justify-content-center mt-5"> 
        <h4 class="text-center">Cargar egresado con CSV</h4> 
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cargar-egresados" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar egresados"><span class="material-icons">person_add</span> Cargar egresados</button>
        <small>Los archivos .csv deben respetar el formato pre establecido</small>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto justify-content-center mt-5"> 
        <h4 class="text-center mt-5">Distribuir egresado</h4>
        <form name="distribuir">
            <select class="form-select form-select mt-2 mb-2" name="eventoID">
                <option selected disabled>Seleeccionar ubicación</option>
                <option value="6">Buena Esperanza</option>
                <option value="8">Candelaria</option>
                <option value="13">Justo Daract</option>
                <option value="11">La Calera</option>
                <option value="9">Merlo</option>
                <option value="5">Quines</option>
                <option value="14">San Luis</option>
                <option value="12">San Martin</option>
                <option value="7">Tilisarao</option>
                <option value="1">Villa Mercedes</option>
            </select>
            <input class="form-control mb-2" type="text" placeholder="Cantidad de Filas" name="cantidad-filas" id="cantidadFilas" required>
            <input class="form-control mb-2" type="text" placeholder="Cantidad de Asientos" name="cantidadAsientos" id="cantidad-asientos" required>
            <button class="btn btn-primary col-12" type="submit" id="distribuir-btn"><span class="material-icons">grid_on</span> Distribuir</button>
            <small>Distribuir al finalizar la carga de todos los egresados de cada ubicacion</small>
        </form>
    </div>
</div>
<?php require_once 'modal-components.php'?>