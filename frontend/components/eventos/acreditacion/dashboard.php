<?php $users =(new SecurityController)->index();?> 

<a href="javascript:void(0)" id="logout" type="button" class="btn btn-secondary btn-sm" style="position: absolute; top: 6px; right:7px;">
    <span class="material-icons">exit_to_app</span> 
</a>
<div class="row mb-5">  
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="input-group"> 
            <input type="text" class="form-control buscar-empleado" id="" data-url="<?php echo URL_ROUTE?>/users/search" data-action="search-esecurity" data-result="#security-tbody" placeholder="Buscar empleado">
            <div class="input-group-text"><span class="material-icons">search</span></div>
        </div>
    </div>
    
</div>

<div class="row" id="dashboard-principal">
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th scope="col">DNI</th>
                <th scope="col" class="text-start">EMPLEADO</th> 
                <th scope="col">ACCION</th>
            </tr>
        </thead>
        <tbody id="security-tbody" data-registrador='<?php echo $_SESSION["userdoc"];?>'> 
            <?php 
                foreach ($users['users'] as $user){
                    if($user->status != -1){
                        $apellidos = explode(" ",$user->apellido); 
                        $nombres   = explode(" ",$user->nombres);
                        echo "
                            <tr>
                                <th class='text-center' scope='row'>$user->documento</th>
                                <td data-bs-toggle='popover' title='Teléfono' data-bs-content='$user->telefono'>$apellidos[0] <span class='hidden'>$apellidos[1]</span>, $nombres[0] <span class='hidden'>$nombres[1]</span></td>
                        "; 
                        //Data status 0 para cuando no se ha registrado entrada, != 0 para cuando se debe registrar salida, de este modo modificamos la tabla con el id status que se debe registrar al registrar una entrada
                        if($user->status == 0){
                            echo "
                                <td class='text-center'>
                                    <button class='io-actions btn btn-primary entrada' id='registrar-entrada' data-empleado='$user->documento' data-registrador='$_SESSION[userdoc]' data-url='".URL_ROUTE."Inouts/' data-action='registrarEntrada' data-status='0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar entrada'>
                                        Entrada
                                    </button>
                                </td>";
                        }
                        else{
                            echo "
                                <td class='text-center'>
                                    <button class='io-actions btn btn-primary' id='registrar-salida' data-empleado='$user->documento' data-registrador='$_SESSION[userdoc]' data-url='".URL_ROUTE."Inouts/' data-action='registrarSalida' data-status='$user->status' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar salida'>
                                        Salida
                                    </button>
                                </td>";
                        }	
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="<?php echo URL_ROUTE;?>/frontend/assets/js/security.js"></script>