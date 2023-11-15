<?php $users =(new EventController)->index();?> 

<a href="javascript:void(0)" id="logout" type="button" class="btn btn-secondary btn-sm" style="position: absolute; top: 6px; right:7px;">
    <span class="material-icons">exit_to_app</span> 
</a>
<div class="row mb-5">  
        <h3 class="mt-3 mb-4" id="titleAcreditaciones">Lista de [Seleccionar]</h3>
        <section class="col-xs-12 col-sm-12 col-md-6">
            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" id="ubicacion-egresados">
                <option selected disabled>Seleccionar ubicación</option>
                <option value="1">Egresados Candelaria</option>
                <option value="2">Egresados Quines</option>
                <option value="3">Egresados San Martin</option>
                <option value="4">Egresados La Calera</option>
                <option value="5">Egresados Buena Esperanza</option>
                <option value="6">Egresados Tilisarao</option>
                <option value="7">Egresados Merlo</option>
                <option value="8">Egresados San Luis</option>
                <option value="9">Egresados Justo Daract</option>
                <option value="10">Egresados Villa Mercedes</option>
            </select>
        </section>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="input-group"> 
            <input type="text" class="form-control buscar-egresados" id="buscar-egresados" data-action="search-esecurity" data-result="#security-tbody" placeholder="Buscar egresado">
            <div class="input-group-text"><span class="material-icons">search</span></div>
        </div>
    </div>
    
</div>
<div class="row" id="dashboard-principal">
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th scope="col" class="text-center">DNI</th>
                <th scope="col" class="text-start">EGRESADO</th> 
                <th scope="col" class="text-start">CARRERA</th> 
                <th scope="col" class="text-center">FILA</th> 
                <th scope="col" class="text-center">ASIENTO</th> 
                <th scope="col">ACCION</th>
            </tr>
        </thead>
        <tbody id="egresados-acreditaciones"></tbody>
    </table>
</div>
<script type="text/javascript" src="<?php echo URL_ROUTE;?>/frontend/assets/js/acreditaciones.js"></script>