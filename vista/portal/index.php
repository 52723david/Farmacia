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
					maxDate: "31/12/2015"
				});
			});
		</script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script>
			function success(position) {  
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
			// Lllamo php para uvicar las farmasias en el mapa

			function error(msg) {  
				var status = document.getElementById('status');  
				status.innerHTML= "Error [" + error.code + "]: " + error.message;   
			}  
			if (navigator.geolocation) {  
				navigator.geolocation.getCurrentPosition(success, error,{maximumAge:60000, timeout: 4000});  
			} else {  
				alert('Su navegador no tiene soporte para su geolocalización');  
			}
		</script>
		<script src="js/menu.js"></script>
	</head>
	<body>
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
				<form id="buscador" name="buscador" method="post" action="../../controlador/admin1.php?va=buscar">
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
					<select class="mySelect" size="8">
					  <option>Farmacia Cruz Azul</option>
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
					  <option>Farmacia Santa Elena</option>
					</select>
				</div>
			</section>
			<aside>			  
				<p id="demo"></p>
				<div id="map"></div>		
			</aside>

			<footer>
					<h6>Visitanos en Nuestras Redes Sociales</h6>
					<a href="#"><img src="images/twitter.png" width="25px" heigth="25px"  alt=""/></a>	
					<a href="#"><img src="images/facebook.png" width="25px" heigth="25px"  alt=""/></a>	
			</footer>
		</div>	
	</body>
</html>