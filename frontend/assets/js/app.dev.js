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
            url: form.getAttribute('data-url'),
            data:{
                nombre: form.nombres.value,
                apellido: form.apellido.value,
                documento: form.documento.value,
                email: form.email.value,
                telefono: form.telefono.value,
                area: form.area.value,
                rol:form.rol.value
            }
        })
        .then(function(response){
            table = document.querySelector('#users-table').children
            const newuser = `
                <tr>
                    <th scope='row'>${form.documento.value}</th>
                    <td>${form.apellido.value}</td>
                    <td>${form.nombres.value}</td>
                    <td>${form.telefono.value}</td>
                    <td>${form.email.value}</td>
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
            registerIO()
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

const deshabilitarEmpleado = () => { 
    const botonesDeshabilitar = document.querySelectorAll(".action-disable");

    botonesDeshabilitar.forEach((boton) => {
        boton.addEventListener("click", function() {
            axios({
                method: 'post',
                url: apiUrl,
                data: {
                    action: 'deshabilitar',
                    documento: this.getAttribute("data-user")
                }
            })
            .then(function(response){
                console.log("deshabilitado")
            })
        });
    });
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


