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
        console.log(response + "LALALALALLA")
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