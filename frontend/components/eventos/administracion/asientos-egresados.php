<div class="tab-pane fade mb-5" id="v-pills-asientos-egresados" role="tabpanel">
    <div class="col-12 order-md-first mb-3">
        <h2><span class="material-icons">person_pin_circle</span> Asientos de Egresados</h2>
    </div>
    <acticle class="row mt-5">
        <section class="col-6 mb-3">
            <select class="form-select form-select mb-3" aria-label=".form-select-lg example" id="ubicacion-egresados">
                <option selected disabled>Seleccionar ubicación</option>
                <!-- <option value="1">Egresados Candelaria</option>
                <option value="2">Egresados Quines</option>
                <option value="3">Egresados San Martin</option>
                <option value="4">Egresados La Calera</option>
                <option value="5">Egresados Buena Esperanza</option> -->
                <option value="6">Egresados Tilisarao</option>
                <option value="7">Egresados Merlo</option>
                <option value="8">Egresados San Luis</option>
                <option value="9">Egresados Justo Daract</option>
                <option value="10">Egresados Villa Mercedes</option>
            </select>
        </section>
        <section class="col-6 mb-3">
        <div class="input-group"> 
            <input type="text" class="form-control buscar-egresados" id="buscar-egresados" placeholder="Buscar egresado">
            <div class="input-group-text"><span class="material-icons">search</span></div>
        </div>
        </section>
        <section class="col-12">
            <h4>Listado de egresados</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Apellido & Nombre</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Fila</th>
                        <th scope="col">Asiento</th>
                    </tr>
                </thead>
                <tbody id="egresados-posiciones"></tbody>
            </table>
        </section>
    </acticle>
</div>