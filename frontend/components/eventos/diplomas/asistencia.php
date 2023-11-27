<div class="tab-pane fade mb-5 row" id="v-pills-asientos-egresados" role="tabpanel">
    <div class="col-12 order-md-first mb-3">
        <h2><span class="material-icons">school</span> Asistencia Egresados</h2>
    </div> 
    <form name="consultar-egresados" class="col-12">
        <select class="form-select form-select mt-2 mb-2" name="eventoID">
            <option selected disabled>Seleeccionar ubicación</option>
            <!-- <option value="1">Candelaria</option>
            <option value="2">Quines</option>
            <option value="3">San Martin</option>
            <option value="4">La Calera</option>
            <option value="5">Buena Esperanza</option> -->
            <option value="6">Tilisarao</option>
            <option value="7">Merlo</option>
            <option value="8">San Luis</option>
            <option value="9">Justo Daract</option>
            <option value="10">Villa Mercedes</option>
        </select>
        <input class="form-control mt-2 mb-2" type="text" placeholder="Seleccionar fila" name="fila" id="fila" required>
        <button class="btn btn-primary" type="submit" id="consultar-btn"><span class="material-icons">grid_on</span> Constultar</button>
    </form> 
    <table class="table table-striped col-12 mt-5">
        <thead>
            <tr>
                <th scope="col" class="text-center">DNI</th>
                <th scope="col" class="text-center">NOMBRE & APELLIDO</th>
                <th scope="col" class="text-center">CARRERA</th>
                <th scope="col" class="text-center">FILA</th>
                <th scope="col" class="text-center">ASIENTO</th>
                <th scope="col" class="text-center">ACREDITADO</th>
            </tr>
        </thead>
        <tbody id="egresados-tbody"></tbody>
    </table>
</div>