document.addEventListener("DOMContentLoaded", function() {
    salir()  
})

const title = document.querySelector('#titleAcreditaciones')
const selectUbicacion = document.querySelector('#ubicacion-egresados')

selectUbicacion.addEventListener('change', (e) => {
    title.innerHTML = "Lista de " + selectUbicacion.options[selectUbicacion.selectedIndex].innerText;
    axios({
        method: 'post',
        url: apiUrl,
        data:{
            action: 'egresadosUbicacion',
            eventoID: e.target.value
        }
    })
    .then((response) => {
        const egresadosTBody = document.querySelector('#egresados-acreditaciones')
        egresadosTBody.innerHTML = response.data;
        EgresadosIO()
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
            evento_id: selectUbicacion.value
        }
    })
    .then((response) => {
        const egresadosTBody = document.querySelector('#egresados-acreditaciones')
        egresadosTBody.innerHTML = response.data;
    })
})

const EgresadosIO = () => {
    console.log("in")
    const actions = document.querySelectorAll('.eio-actions')
    actions.forEach((action) => {
        action.addEventListener('click', function(e){
            console.log("e.target.value")
            /* axios({
                method: 'post',
                url: apiUrl,
                data: {
                    action: action.getAttribute('data-action'),
                    egresado:    action.getAttribute('data-empleado'), 
                    dataStatus:  action.getAttribute('data-status') 
                }
            })
            .then(function(response){
                action.setAttribute('data-status',response.data)  
            })
            if(e.target.id == "registrar-entrada"){
                e.target.id = "registrar-salida"
                e.target.title = "Registrar salida"
                e.target.firstChild.textContent = "Salida"
                action.setAttribute('data-action','registrarSalida')

            } 
            action.classList.toggle("entrada")*/
        })
    })
}