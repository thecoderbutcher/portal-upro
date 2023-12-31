document.addEventListener("DOMContentLoaded", function() {
    buscarEmpleado() 
    viewlocation()
    viewCalendar() 
    cambiarEstadoEmpleado()
    registrarEmpleado()
    procesarCsv()
    //activeButtonLateral()
    salir()

    const calendario = document.querySelector('#calendar');
    const ubicacion = document.querySelector('#listaUbicacion');

    /* Limite de fecha en el calendario */
    date = new Date();
    mes = date.getMonth() + 1;
    mes = mes < 10 ? '0' + mes : mes;
    calendario.setAttribute('max', date.getFullYear() + '-' + mes + '-' + date.getDate());

    /* Filtro de fecha*/
    calendario.addEventListener('change', () => {
        filtroFechaUbicacion(ubicacion.value, calendario.value);
    });

    ubicacion.addEventListener('change', () => {
        filtroFechaUbicacion(ubicacion.value, calendario.value);
    });
    btnExport = document.querySelector('#btn-export')

    btnExport.addEventListener('click', ()=>{
        users = document.querySelectorAll('.entrada-salida-empleados')
        result = [];
        for(const user of users){
            result.push(user.innerText.split('\t'))
        }
        console.log(result)

    })
    
    
});