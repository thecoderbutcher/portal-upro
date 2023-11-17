<div class="tab-pane fade mb-5 row" id="v-pills-asientos-egresados" role="tabpanel">
    <div class="col-12 order-md-first mb-3">
        <h2><span class="material-icons">school</span> Asistencia Egresados</h2>
    </div>
    <div class="col-5 mt-5">
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
            <input class="form-control mb-2" type="text" placeholder="Seleccionar fila" name="cantidad-filas" id="cantidadFilas" required>
            <button class="btn btn-primary col-12" type="submit" id="distribuir-btn"><span class="material-icons">grid_on</span> Distribuir</button>
        </form>
    </div>
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
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td  class="text-center">1</td>
                <td  class="text-center">A</td>
                <td  class="text-center">Si</td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td  class="text-center">1</td>
                <td  class="text-center">B</td>
                <td  class="text-center">No</td>
            </tr>
        </tbody>
    </table>
</div>