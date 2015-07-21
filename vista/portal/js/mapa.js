function farmaciaTurno(){
    var fechaActual="2015-07-12";

}
function cargarFarmaciasFecha(){
    var fechaSeleccionada=document.getElementById('datepicker');//tomar valor de calendario
    fechaSeleccionada.addEventListener("click", function(){
        alert("Se a hecho clic en fecha");
    })
}
function generarMapa(){

}



/*function success(position) {  
    var puntero = new google.maps.MarkerImage(
        'http://www.experimentosgraficos.com/~cesfam/img/icono_saludmental.png',
        new google.maps.Size(50,50)
    );
    var mapita = document.createElement('div');  
    mapita.id = 'mapita';  
    mapita.style.height = '100%';
    mapita.style.width = '100%';
    document.querySelector('#map').appendChild(mapita);  
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);  
    var opcionesMapita = {  
        zoom: 15,  
        center: latlng,  
        mapTypeControl: true,  
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},  
        mapTypeId: google.maps.MapTypeId.ROADMAP  
    };  
    var map = new google.maps.Map(document.getElementById("mapita"), opcionesMapita);  
    var marker = new google.maps.Marker({  
        position: latlng,
        title:"Usted está aquí...!",
        map: map,
        icon: puntero
    });
}
function error(msg) {  
    var status = document.getElementById('status');  
    status.innerHTML= "Error [" + error.code + "]: " + error.message;   
}  
if (navigator.geolocation) {  
    navigator.geolocation.getCurrentPosition(success, error,{maximumAge:60000, timeout: 4000});  
} else {  
    alert('Su navegador no tiene soporte para su geolocalización');  
}*/