const apiUrl = document.querySelector('.container-fluid').getAttribute('data-url');

const activeButtonLateral = () => {
    buttons = document.querySelector('.btn-lateral-action')
    buttons.forEach((button) =>{
        button.addEventListener('click', function(e){
            button.classList.toggle('active')
        })
    })
}

const salir = () => {
    salirBtn = document.querySelector('#logout')
    salirBtn.addEventListener('click', () => {
        axios({
            method:'post',
            url: apiUrl,
            data:{
                action: 'salir'
            }
        }).then(() =>{ 
            window.location.reload();
        })
    }) 
}

const registrarEmpleado = () => {
    form = document.forms["agregar-empleado"]
    form.addEventListener('submit',function(e){ 
        e.preventDefault()
        axios({
            method:'post',
            url: apiUrl,
            data:{
                action: 'create',
                nombre: form.nombres.value,
                apellido: form.apellido.value,
                documento: form.documento.value,
                email: form.email.value,
                telefono: form.telefono.value,
                area: form.area.value,
                ubicacion: form.ubicacion.value
            }
        })
        .then(function(response){
            table = document.querySelector('#empleados-tbody').children
            const newuser = `
                <tr>
                    <th scope='row'>${form.documento.value}</th>
                    <td>${form.apellido.value}, ${form.nombres.value}</td>
                    <td class='text-center'>${form.email.value}</td>
                    <td class='text-center'>${form.telefono.value}</td>
                    <td>${form.area.options[(form.area).selectedIndex].textContent}</td>
                </tr> 
            `
            table[1].insertAdjacentHTML("beforebegin",newuser)
        }) 
    })
}

const registerIO = () => {
    const actions = document.querySelectorAll('.io-actions')
    actions.forEach((action) => {
        action.addEventListener('click', function(e){
            axios({
                method: 'post',
                url: apiUrl,
                data: {
                    action: action.getAttribute('data-action'),
                    empleado:    action.getAttribute('data-empleado'),
                    registrador: document.querySelector('#security-tbody').getAttribute('data-registrador'),
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
            else{
                e.target.id = "registrar-entrada"
                e.target.firstChild.title = "Registrar entrada"
                e.target.firstChild.textContent = "Entrada"
                action.setAttribute('data-action','registrarEntrada')
            }
            action.classList.toggle("entrada")
        })
    })
}

const viewlocation = () => {
    btnLocation = document.querySelector('#btn-location');
    btnLocation.addEventListener('click', () => {
        const ubi = document.querySelector('#listaUbicaciones')
        ubi.classList.toggle('hide')
    })
}
const viewCalendar = () => {
    btnCalendar = document.querySelector('#btn-calendar');
    btnCalendar.addEventListener('click', () => {
        const cal = document.querySelector('#inCalendar');
        cal.classList.toggle('hide')
    })
}

const cambiarEstadoEmpleado = () => { 
    const botonesDeshabilitar = document.querySelectorAll(".status-change");

    botonesDeshabilitar.forEach((boton) => {
        boton.addEventListener("click", function (e) {
            const actionSelected = this.getAttribute("data-action")
            const btnCambiarEstado =  e.target.parentNode
        
            axios({
                method: 'post',
                url: apiUrl,
                data: {
                    action: actionSelected,
                    documento: this.getAttribute("data-user")
                }
            })
            .then(function(response){
                
                if(actionSelected === 'deshabilitar'){
                    e.target.textContent = 'restart_alt';
                    btnCambiarEstado.setAttribute('data-action', 'habilitar');
                    btnCambiarEstado.classList.remove('btn-warning')
                    btnCambiarEstado.classList.add('btn-success')
                    btnCambiarEstado.setAttribute('title', (btnCambiarEstado.getAttribute('title')).replace('Suspender','Habilitar'))
                }
                else{
                    e.target.textContent = 'warning';
                    btnCambiarEstado.setAttribute('data-action', 'deshabilitar');
                    btnCambiarEstado.classList.remove('btn-success')
                    btnCambiarEstado.classList.add('btn-warning')
                    btnCambiarEstado.setAttribute('title', (btnCambiarEstado.getAttribute('title')).replace('Habilitar','Suspender'))
                }
            })
        });
    });
}
const buscarEmpleado = () => {
    empleado = document.querySelector('.buscar-empleado')
    empleado.addEventListener('keyup', function(){ 
        containerResult = this.getAttribute('data-result'); 
        axios({
            method: 'post',
            url: apiUrl,
            data:{
                action: this.getAttribute('data-action'),
                value: this.value
            }
        })
        .then(function(response){ 
            document.querySelector(containerResult).innerHTML = response.data
            registerIO();
            cambiarEstadoEmpleado()
        })
    })
}
const filtroFechaUbicacion = (ubicacion, fecha) => {
    axios({
        method: 'post',
        url: apiUrl,
        data:{
            action: 'filtrarFechaUbicacion',
            location: 1,
            date: fecha,
            location: ubicacion
        }
    })
    .then(function(response){ 
        document.querySelector('#ubicacion-seleccionada').innerHTML = (ubicacion == "" ? "Villa Mercedes" : ubicacion)
        document.querySelector('#fecha-seleccionada').innerHTML = (fecha == "" ? "Hoy" : fecha)
        document.querySelector("#inouts-tbody").innerHTML = response.data 
    })
}

const procesarCsv = () => {
    const form = document.forms['form-carga-masiva']
    form.addEventListener('submit', e =>{
        e.preventDefault();

        const data   = document.querySelector('#csvFile').files[0];
        const modal  = document.querySelector('#carga-masiva')
        const reader = new FileReader()
        
        reader.onload = function(event){
            const elements = event.target.result;
            cargamasiva(elements);
        }
        reader.readAsText(data);
        modal.addEventListener('hidden.bs.modal', event => {
            const toast = new bootstrap.Toast('.toast')
            toast.show();
        })
    })
}

const cargamasiva = (data) => {
    const csvElements = data.split(/\r?\n|\r/);
    axios({
        method: 'post', 
        url: apiUrl,
        data: {
            action: 'cargaMasiva',
            csv_file: csvElements
        }
    })
    .then(function(response){
        const toastContainer = document.querySelector('#toast-container')
        toastContainer.insertAdjacentHTML('afterbegin',response.data)
    }) 
}    
