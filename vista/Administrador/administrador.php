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
<!doctype html>
<html>
<head>
	<title>Administrador</title>

	<html lang="es">

	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width">
	<link href="estilos/stacktable.css" rel="stylesheet" />
	<link href="estilos/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
	<script>
		$(function () {
		$("#fecha").datepicker();
		});
	</script>
</head>

<body>
	<div class="header">
		<?php 
			$query="select * from usuarios where Cedula='$c'";
    		$ndf->consulta($query);
    		$d2=$ndf->consulta_lista();
			echo "<div class='logo'><a href='administrador.php?var=ver&va=$c'>Bienvenido $d2[1] $d2[2]</a></div>";
		 ?>
		<div class="logo1"><a href="../../controlador/admin1.php?va=salir">Salir</a></div>
	</div>
<div class="container">
<div class="content">
	<!--Menu de navegacion-->
	<a class="toggleMenu" href="#">Menu</a>
	<ul class="nav">
		<li  class="test"><?php echo "<a href='administrador.php?var=ver&va=$c'>Inicio</a>"; ?></li>
		<li><?php echo "<a href='administrador.php?var=Detalles&va=$c&nom=usuarios'>Detalles de $d2[1]</a>"; ?></li>
		<li><?php echo "<a href='administrador.php?var=ingresarFarmacia&va=$c'>Crear Farmacia</a>"; ?></li>
		<li><a href="../../controlador/admin1.php?va=salir">Salir</a></li>
	</ul>
</script>
<?php 
if ($_GET["var"]=="ver") {
	header('Content-Type: text/html; charset=ISO-8859-1');
	$query="select * from farmacia where Usuario='$c'";
    $ndf->consulta($query);
    $d=$ndf->consulta_lista();
    if ($d>0) {
      	$ndf->consulta($query);
      	$ndf->ver($d[1], "Usuario", $c);
    }else{
    	echo "<div class='wrapper'>";
		echo "<div id='main' style='padding:50px 0 0 0;'>";
      	echo "<form id='contact-form' action='../../controlador/admin1.php?va=ingresar&v=farmacia&f=$c' method='post' name='contact_form'>";
	    for ($i=0; $i < $ndf->numcampos(); $i++) { 
		    if ($ndf->nombrecampo($i)=="Id") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)!="Id" and $ndf->nombrecampo($i)!="Usuario" and $ndf->nombrecampo($i)!="Foto") {
		        echo "<label>".$ndf->nombrecampo($i)."<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'></label>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$c'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<label>".$ndf->nombrecampo($i)."<input type='file' name='".$ndf->nombrecampo($i)."'></label>";
		    }
	    }
	    echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
	    echo "</form>";
	    echo "</div>";
	    echo "</div>";
    }
}
if ($_GET["var"]=="ingresarFarmacia") {
	$query="select * from farmacia where Usuario='$c'";
    $ndf->consulta($query);
		echo "<div class='wrapper'>";
		echo "<div id='main' style='padding:50px 0 0 0;'>";
      	echo "<form id='contact-form' action='../../controlador/admin1.php?va=ingresar&v=farmacia&f=$c' method='post' name='contact_form'>";
	    for ($i=0; $i < $ndf->numcampos(); $i++) { 
		    if ($ndf->nombrecampo($i)=="Id") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)!="Id" and $ndf->nombrecampo($i)!="Usuario" and $ndf->nombrecampo($i)!="Foto") {
		        echo "<label>".$ndf->nombrecampo($i)."<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'></label>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$c'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<label>".$ndf->nombrecampo($i)."<input type='file' name='".$ndf->nombrecampo($i)."'></label>";
		    }
	    }
	    echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
	    echo "</form>";
	    echo "</div>";
	    echo "</div>";
}
if ($_GET["var"]=="actualizarFarmacia")	{
	header('Content-Type: text/html; charset=ISO-8859-1');
	$nomTabla=$_GET["tab"];
	$idr=$_GET["id"];
	if ($nomTabla!="usuarios") {
		$query="select * from $nomTabla where Id='$idr'";
	}
	if ($nomTabla=="usuarios") {
		$query="select * from $nomTabla where Cedula='$idr'";
	}
	$ndf->consulta($query);
	$ndf->actualizar($nomTabla, "kcnfnjew", "bbcdbsdbj");
}
if ($_GET["var"]=="detalle") {
	//echo $_GET["r"], $_GET["t"];
	$ID=$_GET["r"];
	$tabla=$_GET["t"];
	$query="select * from $tabla where Id='$ID'";
	$ndf->consulta($query);
	$ndf->detalles();
}
if (@$_GET["var"]=="usuario") {
    //$nomTabla=$_GET["tab"];
    $idr=$_GET["va"];
    $query="select * from usuarios where Cedula='$idr'";
    //echo "$query";
    $ndf->consulta($query);
    $ndf->verconsulta("hucdshuh", "uduhshdd", "$idr");
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
    $ndf->actualizar($nomTabla, $c, "bjsdj<ajdj");
}
if ($_GET["var"]=="productos" or $_GET["var"]=="turnos") {
	$idd=$_GET["id"];
	$nomm=$_GET["var"];
	$query="select * from $nomm where Farmacia='$idd'";
    //echo "$query";
    $ndf->consulta($query);
    $d=$ndf->consulta_lista();
    if ($_GET["var"]=="productos") {
    	echo "<div class='boton1'>";
    	$query="select * from $nomm where Farmacia='$idd'";
    	$ndf->consulta($query);
    	$far=@$d[9];
    	//echo $nomm;
    	echo "<a href='administrador.php?va=$c&var=ingresar&nom=$nomm&fa=$far'>Ingresar un producto</a>";
    	//echo "$c";
    	echo "</div>";
    }
    if ($_GET["var"]=="turnos") {
    	echo "<div class='boton1'>";
    	$query="select * from $nomm where Farmacia='$idd'";
    	$ndf->consulta($query);
    	$far=@$d[3];
    	//echo $nomm;;
    	echo "<a href='administrador.php?va=$c&var=ingresar&nom=$nomm&fa=$far'>Ingresar un turno</a>";
    	//echo "$c";
    	echo "</div>";
    }
    if ($d>0) {
    	$query="select * from $nomm where Farmacia='$idd'";
    	$ndf->consulta($query);
    	$ndf->verconsulta("hucdshuh", "uduhshdd", "nhhjdd");
    } else {
    	$far=$idd;
		header("location: administrador.php?va=$c&var=ingresar&nom=$nomm&fa=$far");
    }
}
if (@$_GET["var"]=="ingresar") {
	$nomb=$_GET["nom"];
	$farma=$_GET["fa"];
	//echo $farma, $nomb;
	$query="select * from $nomb";
    $ndf->consulta($query);
	echo "<div class='wrapper'>";
	echo "<div id='main' style='padding:50px 0 0 0;'>";
    echo "<form id='contact-form' action='../../controlador/admin1.php?va=ingresar&v=$nomb&f=$c&idd=$farma' method='post' name='contact_form'>";
	    for ($i=0; $i < $ndf->numcampos(); $i++) { 
		    if ($ndf->nombrecampo($i)=="Id") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)!="Id" and $ndf->nombrecampo($i)!="Usuario" and $ndf->nombrecampo($i)!="Foto" and $ndf->nombrecampo($i)!="Farmacia" and $ndf->nombrecampo($i)!="fecha_inicio" and $ndf->nombrecampo($i)!="fecha_fin") {
		        echo "<label>".$ndf->nombrecampo($i)."<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'></label>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$c'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<label>".$ndf->nombrecampo($i)."<input type='file' name='".$ndf->nombrecampo($i)."'></label>";
		    }
		    if ($ndf->nombrecampo($i)=="Farmacia") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$farma'>";
		    }
		    if ($ndf->nombrecampo($i)=="fecha_inicio" or $ndf->nombrecampo($i)=="fecha_fin") {
		    	?>
		        <label><?php echo $ndf->nombrecampo($i); ?>:<input type='text' name='<?php echo $ndf->nombrecampo($i); ?>' placeholder='<?php echo $ndf->nombrecampo($i); ?>' id="fecha"/></label>
		    	<?php
		    }
	    }
	echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
	echo "</form>";
	echo "</div>";
	echo "</div>";
}
if (@$_GET["var"]=="Detalles") {
	$var=$_GET["var"];//evento
	$va=$_GET["va"];//cedula
	$nom=$_GET["nom"];//tabla
	$query="select * from $nom where Cedula='$va'";
	//echo "$query";
    $ndf->consulta($query);
    $d=$ndf->consulta_lista();
    $nombre=$d[1];
	//echo "$var $va $nom";
	echo "<br><br><br>";
  			?>
  			<div class="todo">
		<section class="seccion">
			<article>
				<h1><center><?php echo $nombre; ?><center></h1>
				<h3><?php echo $nombre; ?></h3>
				<h3><?php echo $d[2]; ?></h3>
				<h3><?php echo $d[4]; ?></h3>
				
			</article>
		</section>
		<aside class="sec_foto">
			<div class="widget">
				<div class="imagen">
					<img src="img/indice.jpeg">
				</div>

			</div>
		</aside>
	</div>
  			<?php 
}
if (@$_GET["var"]=="Detalles1") {
	$var=$_GET["r"];//id
	$va=$_GET["va"];//cedula
	$nom=$_GET["t"];//tabla
	$query="select * from $nom where Id='$var'";
	//echo "$query";
    $ndf->consulta($query);
    $d=$ndf->consulta_lista();
    $nombre=$d[1];
    $img=$d[2];
	//echo "$var $va $nom";
	echo "<br><br><br>";
  			?>
  			<div class="todo">
		<section class="seccion">
			<article>
				<h1><center><?php echo $nombre; ?><center></h1>
				<h3><?php echo $nombre; ?></h3>
				<h3><?php echo $d[3]; ?></h3>
				<h3><?php echo $d[4]; ?></h3>
				<h3><?php echo $d[5]; ?></h3>
				<h3><?php echo $d[6]; ?></h3>
				<h3><?php echo $d[7]; ?></h3>
				<h3><?php echo $d[10]; ?></h3>
				
			</article>
		</section>
		<aside class="sec_foto">
			<div class="widget">
				<div class="imagen">
					<?php echo "<img src='../images/$img'>"; ?>
					<h3><?php echo $d[8]; ?></h3>
					<h3><?php echo $d[9]; ?></h3>
					<h3><?php echo $d[11]; ?></h3>
					<h3><?php echo $d[12]; ?></h3>
					<h3><?php echo $d[13]; ?></h3>
				</div>

			</div>
		</aside>
	</div>
  			<?php 
}
 ?>
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