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
			echo "<div class='logo'><a href='admin.php?var=ver&va=$c'>Bienvenido $d2[1] $d2[2]</a></div>";
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
								echo "<li><a href='admin.php?var=administradortodo&va=$c&nom=productos'>Productos</a></li>";
								echo "<li><a href='admin.php?var=administradortodo&va=$c&nom=turnos'>Turnos</a></li>";
								echo "<li><a href='admin.php?var=administradortodo&va=$c&nom=usuarios'>Usuarios</a></li>";
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
    echo "<a href='admin.php?va=$c&var=ingresar&nom=$nomm&fa=$far'>Ingresar $nomm</a>";
    //echo "$c";
    echo "</div>";
    //$nomTabla=$_GET["tab"];
    $idr=$_GET["va"];
    //echo "$idr";
    $query="select * from $nomm";
    //echo "$query";
    $ndf->consulta($query);
    $ndf->verconsulta("$c", "admin", "$idr");
    echo "<br><br><br>";
}
if (@$_GET["var"]=="ingresar") {
	$nomb=$_GET["nom"];
	$farma=$_GET["fa"];
	//echo $c;
	$query="select * from $nomb";
	//echo "$query";
    $ndf->consulta($query);
	echo "<div class='wrapper'>";
	echo "<div id='main' style='padding:50px 0 0 0;'>";
	if ($nomb!="usuarios") {
		echo "<form id='contact-form' action='../../controlador/admin2.php?va=ingresar&v=$nomb&f=$c&idd=$farma&ce=$c' method='post' name='contact_form'>";
	}
	if ($nomb=="usuarios") {
		echo "<form id='contact-form' action='../../controlador/admin2.php?va=ingresarusuario&v=$nomb&f=$c&idd=$farma&ce=$c' method='post' name='contact_form'>";
	}
	    for ($i=0; $i < $ndf->numcampos(); $i++) { 
		    if ($ndf->nombrecampo($i)=="Id") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)!="Id" and $ndf->nombrecampo($i)!="Foto" and $ndf->nombrecampo($i)!="Usuario" and $ndf->nombrecampo($i)!="Farmacia") {
		        echo "<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<input type='file' name='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Farmacia" and $nomb=="turnos") {
		    	echo "<select name='Farmacia'>";
		    		$query="select Id, Nombre from farmacia";
		    		$ndf->consulta($query);
		    		$d=$ndf->consulta_lista();
		    		for ($i=1; $i < count($d); $i++) { 
		    			echo "<option value='".$d[$i-1]."'>".$d[$i]."</option>";
		    			$i=$i+1;
		    		}
              		//echo "<option value='admin'>Administrador</option>";
            	echo "</select>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario" and $nomb=="farmacia") {
		    	echo "<select name='Usuario'>";
		    		$query="select Cedula, Nombres, Apellidos from usuarios";
		    		$ndf->consulta($query);
		    		$d=$ndf->consulta_lista();
		    		for ($i=1; $i < count($d); $i++) { 
		    			echo "<option value='".$d[$i-1]."'>".$d[$i]." ".$d[$i+1]."</option>";
		    			$i=$i+2;
		    		}
              		//echo "<option value='admin'>Administrador</option>";
            	echo "</select>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario" and $nomb=="usuarios") {
		    	echo "<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Farmacia" and $nomb=="productos") {
		    	echo "<select name='Farmacia'>";
		    		$query="select Id, Nombre from farmacia";
		    		$ndf->consulta($query);
		    		$d=$ndf->consulta_lista();
		    		for ($i=1; $i < count($d); $i++) { 
		    			echo "<option value='".$d[$i-1]."'>".$d[$i]."</option>";
		    			$i=$i+1;
		    		}
              		//echo "<option value='admin'>Administrador</option>";
            	echo "</select>";
		    }
	    }
	echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
	echo "</form>";
	echo "</div>";
	echo "</div>";
}
if (@$_GET["var"]=="actualizar") {
	$nomTabla=$_GET["tab"];
    $id=$_GET["id"];
    $idr=$_GET["va"];
    $idrr=@$_GET["idd"];
    $id=@$_GET["var1"];
    //echo "$id";
    //echo "$idr, $idrr, $nomTabla<br>";
    if ($nomTabla!="productos" and $nomTabla!="turnos" and $nomTabla!="usuarios" and $nomTabla!="administrador") {
    	$query="select * from $nomTabla where Id='$id'";
    	//echo "$query";
    }
    if ($nomTabla=="productos" or $nomTabla=="turnos") {
    	$query="select * from $nomTabla where Id='$id'";
    	//echo "$query";
    }
    if ($nomTabla=="usuarios" or $nomTabla=="administrador") {
    	$query="select * from $nomTabla where Cedula='$id'";
    	//echo "$query";
    }
    $ndf->consulta($query);
    if ($nomTabla!="usuarios" and $nomTabla!="administrador") {
    	$ndf->actualizar($nomTabla, $c, "admin");
    	//echo "$query";
    }
    if ($nomTabla=="usuarios" and $nomTabla=="administrador") {
    	$ndf->actualizarusuario($nomTabla, $c, "admin");
    	//echo "$query";
    }
}
if (@$_GET["var"]=="actualizarusuario") {
	$nomTabla=$_GET["tab"];
    $id=$_GET["id"];
    $idr=$_GET["va"];
    $idrr=@$_GET["idd"];
    $id=@$_GET["var1"];
    //echo "$id";
    //echo "$idr, $id, $nomTabla<br>";
    $query="select * from $nomTabla where Cedula='$id'";
    $ndf->consulta($query);
    $ndf->actualizarusuario($nomTabla, $c, "admin");
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