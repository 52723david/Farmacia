<html>
<?php 
	include("../../modelo/confi.php"); 
	include("../../modelo/clase.php");
	$ndf=new clase_mysql;
	$ndf->conectar($db_name, $db_host, $db_user, $db_pasword);
?>
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
			$("#datepicker").datepicker();
			});
		</script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script>
			function success(position) {  
				var puntero = new google.maps.MarkerImage(
					'http://www.anestesiaclinicovalencia.org/wp-content/uploads/2013/11/informacion-paciente.png',
					new google.maps.Size(100,100)
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
			// Utilzo el radio medio de la tierra que es de 6.371 km, poruqe se lo va a trabajar en quilometros y no en millas

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
		
			</header>
			<!--  Imagenes carrusel-->
			
<?php 
if ($_GET["va"]=="buscar") {
		$ve=$_POST["busca"];
		//echo $ve."<br>";
		$busqueda = trim($ve);
		//echo $busqueda;
		if (empty($busqueda)){
	  		//$texto = 'Búsqueda sin resultados';
	  		echo "<script>alert('Ingrese palabra a buscar')</script>";
			echo "<script>location.href='Buscador.php'</script>";
	  		//echo $texto;
  		}else{
  			$ndf->buscar($busqueda, "hghbjbjj");
  		}
	}
?>



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