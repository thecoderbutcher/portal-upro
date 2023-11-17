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
    console.log(selectUbicacion.value)
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
        EgresadosIO()
    })
})

const EgresadosIO = () => {
    const actions = document.querySelectorAll('.eio-actions')
    actions.forEach((action) => {
        action.addEventListener('click', function(e){
            axios({
                method: 'post',
                url: apiUrl,
                data: {
                    action: action.getAttribute('data-action'),
                    egresado:    action.getAttribute('data-empleado'), 
                    dataStatus:  action.getAttribute('data-status') 
                }
            })
            .then(function(response){
                console.log(response.data)
                action.setAttribute('data-status',response.data)  
            })

            if(e.target.id == "registrar-entrada"){
                e.target.id = "registrar-salida"
                e.target.title = "Registrar salida"
                e.target.firstChild.textContent = "Se Retiró"
                action.setAttribute('data-action','registrarSalida')
            }
            else{
                e.target.id = "registrar-entrada"
                e.target.title = "Registrar entrada"
                e.target.firstChild.textContent = "Ingresó"
                action.setAttribute('data-action','registrarEntrada')
            }
            action.classList.toggle("entrada")
        })
    })
}