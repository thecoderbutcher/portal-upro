<!-- Modal Carga Masiva -->
<div class="modal fade" id="carga-masiva" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Carga masiva de empleados</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="form-carga-masiva">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cvsFile" class="form-label">Seleccionar archivo .csv</label>
                        <input class="form-control mb-2" type="file" id="csvFile" name="csv_file" accept=".csv" required>
                        <small>Los archivos .csv deben respetar el formato pre establecido</small>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cerrar</button>
                    <button type="submit" id="cm-btn" class="btn btn-primary" data-bs-dismiss="modal">Subir</button>
                </div>
            </form>
        </div>
    </div> 
</div> 

<!-- Modal Create User-->
<div class="modal fade" id="agregar-empleado" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="agregar-empleado">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="apellido" class="form-control" id="in-apellidos" placeholder="Ingresar apellidos" required>
                        <label for="floatingInput">Apellidos</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nombres" class="form-control" id="in-nombres" placeholder="Ingresar nombres" required>
                        <label for="floatingInput">Nombres</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="documento" class="form-control" id="in-documento" placeholder="Ingresar documento" required>
                        <label for="floatingInput">Nº Documento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="in-email" placeholder="Ingresar email" required>
                        <label for="floatingInput">ejemplo@mail.com</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="telefono" class="form-control" id="in-telefono" placeholder="Ingresar telefono" required>
                        <label for="floatingInput">Teléfono</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="area" class="form-select" aria-label="Default select example">
                            <option selected disabled>Seleccionar area</option>
                            <?php 
                                foreach($users['areas'] as $area){
                                    echo "
                                        <option value='$area->id'>$area->nombre</option>
                                    ";
                                }
                            ?>
                        </select>
                        <label for="floatingInput">Area</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="ubicacion" class="form-select" aria-label="Default select example">
                            <option selected disabled>Seleccionar ubicación</option>
                            <?php 
                                foreach($users['ubicacion'] as $ubicacion){
                                    echo "
                                        <option value='$ubicacion->id'>$ubicacion->nombre</option>
                                    ";
                                }
                            ?>
                        </select>
                        <label for="floatingInput">Ubicación</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modasl" id="save-user" name="save-user">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar User-->
<div class="modal fade" id="editar-empleado" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar datos del empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="agregar-empleado">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="apellido" class="form-control" id="in-apellidos" placeholder="Ingresar apellidos" required>
                        <label for="floatingInput">Apellidos</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="nombres" class="form-control" id="in-nombres" placeholder="Ingresar nombres" required>
                        <label for="floatingInput">Nombres</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="documento" class="form-control" id="in-documento" placeholder="Ingresar documento" required>
                        <label for="floatingInput">Nº Documento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="in-email" placeholder="Ingresar email" required>
                        <label for="floatingInput">ejemplo@mail.com</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="telefono" class="form-control" id="in-telefono" placeholder="Ingresar telefono" required>
                        <label for="floatingInput">Teléfono</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="area" class="form-select" aria-label="Default select example">
                            <option selected disabled>Seleccionar area</option>
                            <?php 
                                foreach($users['areas'] as $area){
                                    echo "
                                        <option value='$area->id'>$area->nombre</option>
                                    ";
                                }
                            ?>
                        </select>
                        <label for="floatingInput">Area</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="ubicacion" class="form-select" aria-label="Default select example">
                            <option selected disabled>Seleccionar ubicación</option>
                            <?php 
                                foreach($users['ubicacion'] as $ubicacion){
                                    echo "
                                        <option value='$ubicacion->id'>$ubicacion->nombre</option>
                                    ";
                                }
                            ?>
                        </select>
                        <label for="floatingInput">Ubicación</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modasl" id="save-user" name="save-user">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>