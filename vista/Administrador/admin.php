<?php 
session_start();
$user = isset($_SESSION['usuario']) ? $_SESSION['password'] : null ;
if ($user=="") {
    header("location: ../Login/login.php");
}else{
	include("../../modelo/confi.php"); 
    include("../../modelo/clase.php");
    $ndf=new clase_mysql;
    $ndf->conectar($db_name, $db_host, $db_user, $db_pasword);
    $c=$_GET['va'];
 ?>
<html>
<head>
	<title>Administrador</title>

	<html lang="es">

	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<meta name="viewport" content="width=device-width">
	<link href="estilos/stacktable.css" rel="stylesheet" />
	<link href="estilos/style.css" rel="stylesheet" />


</head>

<body>
	<div class="header">
		<?php 
			$query="select * from administrador where Cedula='$c'";
    		$ndf->consulta($query);
    		$d2=$ndf->consulta_lista();
			echo "<div class='logo'><a href='admin.php?var=ver&va=$c'>Bienbenido $d2[1] $d2[2]</a></div>";
		 ?>
		<div class="logo1"><a href="../../controlador/admin1.php?va=salir">Salir</a></div>
	</div>
	<div class="container">
		<div class="content">
			
				<!--Menu de navegacion-->
				<a class="toggleMenu" href="#">Menu</a>
							<ul class="nav">
						<li  class="test">
							<?php echo "<a href='admin.php?var=ver&va=$c'>Inicio</a>"; ?>
						</li>
						<li>
							<a href="">Tablas</a>
							<ul>
								<li><a href="#">Administrador</a></li>
								<li><a href="#">Farmacia</a></li>
								<li><a href="#">Productos</a></li>
								<li><a href="#">Turnos</a></li>
								<li><a href="#">Usuarios</a></li>
							</ul>
						</li>
						<li>
							<?php echo "<a href='admin.php?var=usuario&va=$c&nom=usuarios'>Detalles de $d2[1]</a>"; ?>
						</li>
						<li>
							<a href="../../controlador/admin1.php?va=salir">Salir</a>
						</li>
					</ul>
		<!--Fin menu-->
		<!--Tabla-->
<?php 
if (@$_GET["var"]=="usuario") {
    //$nomTabla=$_GET["tab"];
    $idr=$_GET["va"];
    $query="select * from administrador where Cedula='$idr'";
    //echo "$query";
    $ndf->consulta($query);
    $ndf->verconsulta("hucdshuh", "uduhshdd", "$idr");
}
 ?>
<!--Tabla-->
</div><!--fin content-->
</div><!--fin container-->
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script src="js/formulario.js"></script>




<script>window.jQuery || document.write('<script src="js/jquery-1.8.1.min.js"><\/script>')</script> </script>

<script src="js/stacktable.js" type="text/javascript"></script>

<script>
  $(document).on('click', '#run', function(e) {
    e.preventDefault();
    $('#simple-example-table').stacktable({hideOriginal:true});
    $(this).replaceWith('<span>ran</span>');
  });
  $('#responsive-example-table').stacktable({myClass:'stacktable small-only'});
  $('#card-table').cardtable({myClass:'stacktable small-only' });
  $('#agenda-example').stackcolumns({myClass:'stacktable small-only' });
</script>
</body>
</html>
<?php 
	}
 ?>