document.addEventListener("DOMContentLoaded", function() {
    buscarEmpleado() 
    viewlocation()
    viewCalendar() 
    deshabilitarEmpleado()
    //registrarEmpleado()
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


    
});