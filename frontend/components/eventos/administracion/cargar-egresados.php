<div class="tab-pane fade mb-5" id="v-pills-cargar-egresados" role="tabpanel">
    <div class="order-md-first mb-4">
        <h2><span class="material-icons">people_outline</span> Registros de Empleados</h2>
    </div>
    <div class="row"> 
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3 order-sm-last order-md-first mt-1">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregar-empleado" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Agregar empleado"><span class="material-icons">person_add</span></button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carga-masiva" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Carga masiva empleado"><span class="material-icons">cloud_upload</span></button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 order-first order-md-last mb-3">
            <div class="input-group"> 
                <input type="text" class="form-control buscar-empleado" id="" data-url="<?php echo URL_ROUTE?>/users/search" data-action="search-empleados" data-result="#empleados-tbody" placeholder="Buscar empleado">
                <div class="input-group-text"><span class="material-icons">search</span></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <table class="table table-striped" id="dashboard-principal">
            <thead class="text-center">
                <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">EMPLEADO</th>  
                    <th scope="col">EMAIL</th>
                    <th scope="col">TELÉFONO</th>
                    <th scope="col">AREA</th>
                    <th scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody id="empleados-tbody"> 
                
            </tbody>
        </table>
    </div>    
</div> 