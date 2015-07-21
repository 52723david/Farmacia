
<!DOCTYPE HTML>
<html>
	<head>
		<html lang="es">
		<title>Tu Farmacia Cerca</title>
		<link rel="shortcut icon" href="images/etiqueta.jpg" type="image/jpg">
		<link rel="stylesheet" type="text/css" href="estilos/estilos.css" media="all">
		<link rel="stylesheet" type="text/css" href="estilos/fonts.css" media="all">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script src="js/bjqs.min.js"></script>
	    <script src="js/script.js"></script>
	    <link rel="stylesheet" href="menu/rmm-css/responsivemobilemenu.css" type="text/css"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript" src="menu/rmm-js/responsivemobilemenu.js"></script>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="estilos/jquery-ui.css" />
		<script src="js/jquery.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script>
			$(function () {
				$.datepicker.setDefaults($.datepicker.regional["es"]);
					$("#datepicker").datepicker({
					minDate: "07/07/2015",
					maxDate: "31/12/2015",
					onSelect: function (date) {
						//alert(date);
						initialize_fecha(date);
					}
				});
			});
		</script>

<!-- MAPA
================================================== -->
        <link rel="stylesheet" type="text/css" href="demo_mapa/css/miproyecto.css">
        <link href='http://png-3.findicons.com/files/icons/1684/ravenna/256/pie_chart.png' rel='shortcut icon' type='image/x-icon'>
        <style type="text/css">
            #mapa { height: 100% }
            div.infowindowstyle {
                max-height:250px;
                overflow-y:auto;
            }

            #mapa img {
                max-width: none;
            }
        </style>
        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjSP5qZdefYhf1lI6iuBh0gT5BUgYQUWw&amp;sensor=true">
        </script>
        <script type="text/javascript" src='https://www.google.com/jsapi'></script>
        <script type="text/javascript" src="js/jquery/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript">
                    google.load('visualization', '1', {'packages': ['controls', 'corechart', 'gauge']});
                    var map;
                    var dashBoard;
                    var dataTable;
                    var chartWarp;
                    var lastOpen = null;
                    var cantonSelected;
                    var chartPieDerivado;
                    var chartGauge;
                    var chartDiff;


  
                    function lecturaGPS(ubicacion){
                          
                          var miubicacion = new google.maps.LatLng(ubicacion.coords.latitude, ubicacion.coords.longitude);
                          
                          map.setCenter(miubicacion)
                          marcador.setPosition(miubicacion)
                          
                    }
                      
                    function errorGPS(){
                          alerta("No se puede localizar :(")
                    }



                    function initialize() {
                        navigator.geolocation.getCurrentPosition( lecturaGPS , errorGPS , {enableHighAccuracy:true} )
                        //Todo lo relacionado con el mapa
                        var latlng = new google.maps.LatLng(-3.989509, -79.204280);
                        var myOptions = {
                          zoom: 13,
                          center: latlng,
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                          
                        };
                        map = new google.maps.Map(document.getElementById("mapa"),
                            myOptions);
                            
                            
                        marcador = new google.maps.Marker( {
                            position: latlng,
                            map:map,
                            title: 'Tu ubicación',
                            icon: 'images/chart.png'
                        })


                        $.ajax({
                            url: 'demo_mapa/place/markers.php',
                            dataType: 'json',
                            success: function(farmacias, textStatus) {
                                    $.each(farmacias, function(i, farmacia) {
                                        addMarca(farmacia);
                                    });
                                }
                        });
                        $("#columnRight").hide();
                    }

                     function initialize_fecha(date) {
                        //"07/07/2015"
                     	from = date.split("/");
                     	anio=from[2]; dia=from[1]; mes=from[0];
						f = anio+"-"+mes+"-"+dia;

                        //Todo lo relacionado con el mapa
                        var mapOptions = {
                            center: new google.maps.LatLng(-3.996083, -79.205675),
                            zoom: 13,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControl: false,
                            zoomControl: true
                        };

                        map = new google.maps.Map(document.getElementById("mapa"), mapOptions);

                        $.ajax({
                            url: 'demo_mapa/place/markers.php?fecha='+f,
                            dataType: 'json',
                            success: function(farmacias, textStatus) {
                            	$('#mySelect')
									    .find('option')
									    .remove()
									;
                                    $.each(farmacias, function(i, farmacia) {

                                        addMarca(farmacia);
                                    });
                                }
                        });
                        $("#columnRight").hide();
                    }

                    function initialize_select() {
                        var x = document.getElementById("mySelect").value;

                        //Todo lo relacionado con el mapa
                        var mapOptions = {
                            center: new google.maps.LatLng(-3.996083, -79.205675),
                            zoom: 13,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControl: false,
                            zoomControl: true
                        };

                        map = new google.maps.Map(document.getElementById("mapa"), mapOptions);

                        $.ajax({
                            url: 'demo_mapa/place/markers_value_only.php?id='+x,
                            dataType: 'json',
                            success: function(farmacias, textStatus) {
                                $('#mySelect')
                                        .find('option')
                                        .remove()
                                    ;
                                    $.each(farmacias, function(i, farmacia) {
                                        addMarca(farmacia);
                                    });
                                }
                        });
                        $("#columnRight").hide();
                    }

                    function addMarca(dataFarmacia) {
                        var latlng = new google.maps.LatLng(dataFarmacia.Latitud, dataFarmacia.Longitud);
                        var marca = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            title: dataFarmacia.Nombre
                        });
                        addInfoWindow(marca, dataFarmacia);
                        if(dataFarmacia.Latitud!="")
                        Lista(dataFarmacia);
                    }

                    function Lista(dataFarmacia){
						var option = document.createElement("option");
						option.text = dataFarmacia.Nombre;
						option.value = dataFarmacia.Id;
						var select = document.getElementById("mySelect");
						select.appendChild(option);
                    }
                    function addInfoWindow(marca, dataFarmacia) {
                        var html = getHtmlData(dataFarmacia);
                        var infoWindow = new google.maps.InfoWindow({
                            content: html,
                            maxWidth: 500,
                            maxHeight: 250
                        });

                        google.maps.event.addListener(marca, 'click', function() {
                            mostrarInformacion(dataFarmacia);
                            if (lastOpen !== null) {
                                lastOpen.close();
                            }
                            infoWindow.open(map, marca);
                            lastOpen = infoWindow;
                            //dibujar(dataCanton);
                            $("#columnRight").show();
                            $("#accordion2").hide();
                        });
                    }

                    function getHtmlData(dataFarmacia) {
                        var html = "";
                        html += "<h3>" + dataFarmacia.Nombre + "</h3>";
                        html += "<br/>";
                        html += "<b>Direccion:</b>&nbsp" + dataFarmacia.Direccion;
                        html += "<br/>";
                        html += "<b>Sector:</b>&nbsp" + dataFarmacia.Sector;
                        html += "<br/>";
                        html += "<b>Telefono:</b>&nbsp" +dataFarmacia.Telefono;
                        html += "<hr/>";

                        return html;
                    }



                    function mostrarInformacion(dataFarmacia){
                        $( "#mydiv" ).empty();
                        $.ajax({
                            url: 'demo_mapa/place/markers_value.php?id='+dataFarmacia.Id,
                            dataType: 'json',
                            success: function(farmacias1, textStatus, jqXHR) {
                                if (jqXHR.status === 200) {
                                    $.each(farmacias1, function(i, farmacia1) {
                                        var html = AgregarInformacion(farmacia1);
                                        $('#mydiv').append(html);

                                    });$('#mydiv').trigger('create');
                                }
                            },
                            error: function(request, status, error) {
                                alert("¡Error!");
                            }
                        });
                    }
               
      
                function AgregarInformacion(dataFarmacia) {
                 var html = "";
                        html += "<div data-role='main' class='ui-content'>";
                        html += "<div data-role='collapsibleset'>";
                        html += "<div data-role='collapsible'>";
                        html += "<h3>"+dataFarmacia.Nombre+"</h3>";
                        html += "<p><strong>Horario: </strong>"+dataFarmacia.Horario+"</p>";
                        html += "</div>";
                        html += "</div>";

                        return html;
                }
        </script>

<!-- FIN MAPA
================================================== -->



	</head>
	<body onLoad="initialize()">
		<div class="contenedor">
			<header>
				<div class="logo">
					<a href="index.php"><img src="images/logo.png"></a>	
				</div>
				<div class="logo_login">
					<a href="../Login/login.php"><img src="images/login.png" width="100" heigth="100"></a>
				</div>
				<div class="buscador">
					<fieldset class="searchform">
				<form id="buscador" name="buscador" method="post" action="Buscador.php?va=buscar">
					<input type="text" name="busca"placeholder="Buscar..." class="searchfield"> 
					<input type="submit" value="Ir" class="searchbutton">
   			 	</form>

			</fieldset>
				</div>		
			</header>
			<div id="slider">
		        <ul class="bjqs">
		            <li>
		                <img src="images/farmacia1.jpg" alt=""/>
		            </li>
		            <li>
		                <img src="images/farmacia2.jpg" alt=""/>
		            </li>
		            <li>
		                <img src="images/farmacia3.jpg" alt=""/>
		            </li>
		        </ul>

		    </div>
			<nav class="menu">
				<div class="rmm"  data-menu-style = "sapphire">
		            <ul>
		                <li><a href='#home'>Inicio</a></li>
		                <li><a href='#about-me'>Ubicación</a></li>
		                <li><a href='#blog'>Farmacias</a></li>
		               
		            </ul>
		        </div>
			</nav>
			<section>
				<div class="titulo">
					<h1>FARMACIAS DE TURNO</h1>
				</div>
					<div id="datepicker"></div>		
				<br>
				<div class="select">
					<select id="mySelect" size="8" onchange="initialize_select()">
					  <!--<option>Farmacia Cruz Azul</option>
					  <option>Farmacia Pichincha</option>
					  <option>Farmacia Bolivar</option>
					  <option>Farmacia Auxiliadora</option>
					  <option>Farmacia Mayorista</option>
					  <option>Farmacia Sana Sana</option>
					  <option>Farmacia Cruz Farmacia</option>
					  <option>Farmacia Santa Elena</option>
					  <option>Farmacia Bolivar</option>
					  <option>Farmacia Auxiliadora</option>
					  <option>Farmacia Mayorista</option>
					  <option>Farmacia Sana Sana</option>
					  <option>Farmacia Cruz Farmacia</option>
					  <option>Farmacia Santa Elena</option>-->
					</select>
				</div>
			</section>	  
        
            <section id="content" class="row-fluid">
                    <section id="mapa" style="width: 50%; height: 60%; position: absolute;  overflow: hidden; -webkit-transform: translateZ(0px); ">
                    </section>
                    <!--<a href="motion.html" target="_blank">Otras visualizaciones</a>-->
        	</section>
                

			<footer>
		        <section id="columnRight" class="span4 thumbnail" style='position: absolute;'>
                    <ul id="mydiv" data-role="listview"  data-filter="false" >                                                                                      
            	</section>
                <div style="display:none">
                   <button onClick="mostrarUbicacion()"> mostrar mi ubicacion </button> 
                </div>
                 
					<h6>Visitanos en Nuestras Redes Sociales</h6>
					<a href="#"><img src="images/twitter.png" width="25px" heigth="25px"  alt=""/></a>	
					<a href="#"><img src="images/facebook.png" width="25px" heigth="25px"  alt=""/></a>	
			</footer>
		</div>	
	</body>
</html>