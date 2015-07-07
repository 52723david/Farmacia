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
	<script src="js/prefixfree.min.js " type="text/javascript"></script>
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
							<?php
								echo "<li><a href='admin.php?var=administradortodo&va=$c&nom=farmacia'>Farmacia</a></li>";
								echo "<li><a href='#'>Productos</a></li>";
								echo "<li><a href='#'>Turnos</a></li>";
								echo "<li><a href='#'>Usuarios</a></li>";
							?>
							</ul>
						</li>
						<li>
							<?php echo "<a href='admin.php?var=administrador&va=$c&nom=usuarios'>Detalles de $d2[1]</a>"; ?>
						</li>
						<li>
							<a href="../../controlador/admin1.php?va=salir">Salir</a>
						</li>
					</ul>
					
					<fieldset class="searchform">
				<?php  echo "<form id='buscador'  name='buscador' method='post' action='admin.php?var=buscar&va=$c'>"; ?>
					<input type="text" name="busca"placeholder="Buscar..." class="searchfield"> 
					<input type="submit" value="Ir" class="searchbutton">
   			 	</form>

			</fieldset>
				
		<!--Fin menu-->
		<!--Tabla-->
<?php 
if (@$_GET["var"]=="administrador") {
    //$nomTabla=$_GET["tab"];
    $idr=$_GET["va"];
    $query="select * from administrador where Cedula='$idr'";
    //echo "$query";
    $ndf->consulta($query);
    $ndf->verconsulta("hucdshuh", "admin", "$idr");
}

if (@$_GET["var"]=="administradortodo") {



	$nomm=$_GET["nom"];
	echo "<div class='boton1'>";
    $query="select * from $nomm";
    $ndf->consulta($query);
    $far=@$d[9];
    //echo $nomm;
    echo "<a href='admin.php?va=$c&var=ingresar&nom=$nomm&fa=$far'>Ingresar nuevo $nomm</a>";
    //echo "$c";
    echo "</div>";
    //$nomTabla=$_GET["tab"];
    $idr=$_GET["va"];
    $query="select * from $nomm";
    //echo "$query";
    $ndf->consulta($query);
    $ndf->verconsulta("$c", "admin", "$idr");
}
if (@$_GET["var"]=="ingresar") {
	$nomb=$_GET["nom"];
	$farma=$_GET["fa"];
	//echo $farma;
	$query="select * from $nomb";
	//echo "$query";
    $ndf->consulta($query);
	echo "<div class='wrapper'>";
	echo "<div id='main' style='padding:50px 0 0 0;'>";
    echo "<form id='contact-form' action='../../controlador/admin2.php?va=ingresar&v=$nomb&f=$c&idd=$farma&ce=$c' method='post' name='contact_form'>";
	    for ($i=0; $i < $ndf->numcampos(); $i++) { 
		    if ($ndf->nombrecampo($i)=="Id") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)!="Id" and $ndf->nombrecampo($i)!="Foto" and $ndf->nombrecampo($i)!="Farmacia") {
		        echo "<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<input type='file' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Farmacia") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$farma'>";
		    }
	    }
	echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
	echo "</form>";
	echo "</div>";
	echo "</div>";
}
if (@$_GET["var"]=="actualizar") {
	$nomTabla=$_GET["tab"];
    //$nomTabla=$_GET["tab"];
    $idr=$_GET["va"];
    $idrr=@$_GET["idd"];
    //echo "$idr $idrr $nomTabla<br>";
    if ($nomTabla!="productos" and $nomTabla!="turnos") {
    	$query="select * from $nomTabla where Cedula='$idr'";
    	//echo "$query";
    }
    if ($nomTabla=="productos" or $nomTabla=="turnos") {
    	$query="select * from $nomTabla where Id='$idrr'";
    	//echo "$query";
    }
    $ndf->consulta($query);
    $ndf->actualizar($nomTabla, $c, "admin");
}

if (@$_GET["var"]=="buscar") {
	$buscar=$_POST["busca"];
	$ced=$_GET["va"];
	//echo $buscar;
	//header("location: ../../controlador/admin1.php?va=buscar&ce=$ced&busca=$buscar");
	$ve=$buscar;
		//echo $ve."<br>";
		$busqueda = trim($ve);
		//echo $busqueda;
		if (empty($busqueda)){
	  		//$texto = 'Búsqueda sin resultados';
	  		echo "<script>alert('Ingrese palabra a buscar')</script>";
			echo "<script>location.href='../vista/portal/index.php'</script>";
	  		//echo $texto;
  		}else{
  			$ndf->buscar($busqueda);
  			?>
  			<div class="todo">
		<section class="seccion">
			<article>
				<h1><center>Farmacia Jerusalen<center></h1>
				<h3>Nombre:</h3>
				<h3>Precio</h3>
				<h3>Oferta</h3>
				<h3>Farmacia</h3>
				
			</article>
		</section>
		<aside class="sec_foto">
			<div class="widget">
				<div class="imagen">
					<img src="img/imagen5.jpg">
					<h3>Latitud:</h3>
					<h5>-45246523</h5>
					<h3>Longitud:</h3>
					<h5>-74630332</h5>
					<h3>Zona:</h3>
				<h5>7</h5>
				</div>

			</div>
		</aside>
	</div>
  			<?php 



  		}
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