<?php 
    $RRHH = new RRHHController;
    $users = $RRHH->index();
?> 
<div class="tab-pane fade mb-5" id="v-pills-empleados" role="tabpanel">
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
    <div id="toast-container"></div>

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
                <?php 
                    foreach ($users['users'] as $user){
                        $apellidos = explode(" ",$user->apellido); 
                        $nombres   = explode(" ",$user->nombres);
                        $button = $user->status == -1 ? "<button class='btn-icons btn btn-success status-change' data-action='habilitar' data-user='$user->documento' data-bs-toggle='tooltip' data-bs-placement='top' title='Habilitar a $apellidos[0]'><span class='material-icons'>restart_alt</span></button>" : "<button class='btn-icons btn btn-warning status-change' data-action='deshabilitar' data-user='$user->documento' data-bs-toggle='tooltip' data-bs-placement='top' title='Suspender a $apellidos[0]'><span class='material-icons'>warning</span></button>";
                        echo "
                            <tr>
                                <th class='text-center' scope='row'>$user->documento</th>
                                <td class=''><span>$apellidos[0]</span><span class='hidden'> $apellidos[1]</span>, <span> $nombres[0]</span><span class='hidden'> $nombres[1]</span></td> 
                                <td class='text-center'>$user->email</td>
                                <td class='text-center'>$user->telefono</td>
                                <td>$user->area_nombre</td>
                                <td>
                                    <button class='btn-icons btn btn-secondary' data-user='$user->documento' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar a $apellidos[0]'><span class='material-icons' style='font-size: 18px'>edit</span></button>
                                    $button
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>    
</div> 
