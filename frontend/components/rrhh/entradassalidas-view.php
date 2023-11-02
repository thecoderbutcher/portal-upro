<?php 
    $IO = new InoutsController;
    $users = $IO->index();   
?>

<div class="tab-pane fade mb-5" id="v-pills-entradasalida" role="tabpanel">
    <div class="col-12 order-md-first mb-3">
        <h2><span class="material-icons">sync_alt</span> Registros de Entrada - Salida</h2>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 mb-3 order-sm-last order-md-first mt-1">
            <button class="btn btn-primary" id="btn-location"><span class="material-icons">location_on</span></button> 
            <button class="btn btn-primary" id="btn-calendar"><span class="material-icons filter">calendar_month</span></button>
            <button class="btn btn-primary" id="btn-export"><span class="material-icons filter">cloud_download</span></button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 order-first order-md-last mb-3">
            <div class="input-group"> 
                <input type="text" class="form-control buscar-empleado" id="" data-url="<?php echo URL_ROUTE?>/users/search" data-action="search-register" data-result="#inouts-tbody" placeholder="Buscar empleado">
                <div class="input-group-text"><span class="material-icons">search</span></div>
            </div>
        </div>
    </div>

    <div class="col-12 order-last">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 hide mb-2" id='listaUbicaciones'>
                <input class="form-control" list="datalistOptions" id="listaUbicacion" placeholder="Seleccionar Ubicación">
                <datalist id="datalistOptions">
                    <?php 
                        foreach($users['ubicacion'] as $ubicacion){
                            echo "<option value='$ubicacion->nombre'>";
                        }
                    ?> 
                </datalist>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 hide" id="inCalendar">
                <input type="date" class="form-control" id="calendar" min="2023-09-28">
            </div>
        </div>
    </div>  
    
    <div class="col-lg-12 col-md-12">
        <div class="align-items-center mb-2" id="icons-selected">
            <span class="material-icons">location_on</span><span id="ubicacion-seleccionada">Villa Mercedes</span>
            <span class="material-icons">calendar_month</span><span id="fecha-seleccionada">Hoy</span>
        </div>
        <table class="table table-striped" id="dashboard-principal">
            <thead class="text-center">
                <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">EMPLEADO</th>  
                    <th scope="col">ENTRADA</th>
                    <th scope="col">SALIDA</th>
                    <!-- <th scope="col">OBSERVACIONES</th> -->
                </tr>
            </thead>
            <tbody id="inouts-tbody"> 
                <?php 
                    foreach ($users['registros'] as $user){
                        $apellidos = explode(" ",$user->e_apellido); 
                        $nombres   = explode(" ",$user->e_nombres);
                        $entrada   = (explode(" ",$user->r_entrada))[1];
                        $salida    = (explode(" ",$user->r_salida))[1];
                        echo "
                            <tr class='entrada-salida-empleados'>
                                <th class='text-center' scope='row'>$user->e_documento</th>
                                <td class=''><span>$apellidos[0]</span><span class='hidden'> $apellidos[1]</span>, <span> $nombres[0]</span><span class='hidden'> $nombres[1]</span></td> 
                                <td class='text-center'>$entrada <span class='material-icons' data-bs-toggle='tooltip' data-bs-placement='top' title='$user->rin_nombres $user->rin_apellido'>account_circle</span></td>
                                <td class='text-center'>$salida <span class='material-icons' data-bs-toggle='tooltip' data-bs-placement='top' title='$user->rout_nombres $user->rout_apellido'>account_circle</span></td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>    
</div>