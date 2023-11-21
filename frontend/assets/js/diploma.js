document.addEventListener("DOMContentLoaded", function() {
    salir()  

const form = document.forms['consultar-egresados']
    form.addEventListener('submit', e =>{
        e.preventDefault();   

        axios({
            method:'post',
            url: apiUrl,
            data:{
                action: 'consultar-egresados',
                eventoID: form.eventoID.value,
                fila: form.fila.value,
            }
        })
        .then(function(response){ 
            tbody = document.querySelector('#egresados-tbody') 
            tbody.innerHTML = (response.data)  
        }) 
    })
})

const estadisticas = document.querySelector('#estadistica-egresados')
estadisticas.addEventListener('change', (e) => {
    axios({
        method:'post',
        url: apiUrl,
        data:{
            action: 'estadistica',
            eventoID: e.target.value
        }
    })
    .then(function(response){ 
        console.log(response.data)
    })  
})