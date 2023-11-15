document.addEventListener("DOMContentLoaded", function() {
    salir() 
    procesarCsvEgresados()
})

const procesarCsvEgresados = () => {
    const form = document.forms['form-carga-masiva-egresados']
    form.addEventListener('submit', e =>{
        e.preventDefault();

        const data   = document.querySelector('#csvEgresadosFile').files[0];
        const modal  = document.querySelector('#cargar-egresados')
        const reader = new FileReader()
        
        reader.onload = function(event){
            const elements = event.target.result;
            cargamasivaEgresados(elements);
        }
        reader.readAsText(data);
    })
}

const cargamasivaEgresados = (data) => {
    const csvElements = data.split(/\r?\n|\r/);
    axios({
        method: 'post', 
        url: apiUrl,
        data: {
            action: 'cargaMasivaEgresados',
            csv_file: csvElements
        }
    })
    .then(function(response){
        console.log(response + ": Done!")
    }) 
}   

const formDistribuir = document.forms['distribuir'];
formDistribuir.addEventListener('submit',(e) => {
    e.preventDefault();
    axios({
        method: 'post',
        url: apiUrl,
        data:{
            action: 'distribuir',
            cantidad_fila: formDistribuir.cantidadFilas.value,
            cantidad_asientos: formDistribuir.cantidadAsientos.value,
            ubicacion_id: formDistribuir.eventoID.value
        }
    })
    .then((response) => {
        console.log(response)
    }) 
})

const selectUbicacionEgresados = document.querySelector('#ubicacion-egresados')
selectUbicacionEgresados.addEventListener('change', (e) =>{
    axios({
        method: 'post',
        url: apiUrl,
        data:{
            action: 'egresadosUbicacion',
            eventoID: e.target.value
        }
    })
    .then((response) => {
        const egresadosTBody = document.querySelector('#egresados-posiciones')
        egresadosTBody.innerHTML = response.data;
    })
})

const buscarEgresado = document.querySelector('#buscar-egresados')
buscarEgresado.addEventListener('keyup', (e) => {
    axios({
        method: 'post',
        url: apiUrl,
        data: {
            action: 'buscarEgresado',
            value: e.target.value,
            evento_id: selectUbicacionEgresados.value
        }
    })
    .then((response) => {
        const egresadosTBody = document.querySelector('#egresados-posiciones')
        egresadosTBody.innerHTML = response.data;
    })
})