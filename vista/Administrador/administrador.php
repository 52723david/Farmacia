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
			$query="select * from usuarios where Cedula='$c'";
    		$ndf->consulta($query);
    		$d2=$ndf->consulta_lista();
			echo "<div class='logo'><a href='administrador.php?var=ver&va=$c'>Bienbenido $d2[1] $d2[2]</a></div>";
		 ?>
		<div class="logo1"><a href="../../controlador/admin1.php?va=salir">Salir</a></div>
	</div>
	<div class="container">
		<div class="content">
			
				<!--Menu de navegacion-->
				<a class="toggleMenu" href="#">Menu</a>
							<ul class="nav">
						<li  class="test">
							<?php echo "<a href='administrador.php?var=ver&va=$c'>Inicio</a>"; ?>
						</li>
						<!--<li>
							<a href="#">Sweaters</a>
							<ul>
								<li>
									<a href="#">Mens</a>
									<ul>
										<li><a href="#">Wool</a></li>
										<li><a href="#">Knitwear</a></li>
										<li><a href="#">Light Sweaters</a></li>
										<li><a href="#">Cardigans</a></li>
										<li><a href="#">Hoodies</a></li>
									</ul>
								</li>
								<li>
									<a href="#">Womens</a>
									<ul>
										<li><a href="#">Wool</a></li>
										<li><a href="#">Knitwear</a></li>
										<li><a href="#">Light Sweaters</a></li>
										<li><a href="#">Cardigans</a></li>
										<li><a href="#">Hoodies</a></li>
									</ul>
								</li>
							</ul>
						</li>-->
						<li>
							<?php echo "<a href='administrador.php?var=usuario&va=$c&nom=usuarios'>Detalles de $d2[1]</a>"; ?>
						</li>
						<li>
							<?php echo "<a href='administrador.php?var=ingresarFarmacia&va=$c'>Crear Farmacia</a>"; ?>
						</li>
						<li>
							<a href="../../controlador/admin1.php?va=salir">Salir</a>
						</li>
					</ul>
		<!--Fin menu-->
		<!--Tabla-->
   <!--<table id="card-table" class="table">
		<thead>
			<tr>
				<th width="30%">Name</th>
				<th width="30%">Phone</th>
				<th width="30%">Info</th>
				<th width="10%">Actions</th>   
			</tr>
		</thead> 
	 <tbody>
	  <tr>
	    <td>
	      Greg
	    </td>
	    <td>
	      555-555-5555
	    </td>
	    <td>
	      This is an example
	    </td>
	    <td>
	      <a href="#">Edit</a>
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Greg
	    </td>
	    <td>
	      555-555-5555
	    </td>
	    <td>
	      This is an example
	    </td>
	    <td>
	      <a href="#">Edit</a>
	    </td>
	  </tr>
	  <tr>
	    <td>
	      John
	    </td>
	    <td>
	      444-444-4444
	    </td>
	    <td>
	      Tables are cool
	    </td>
	    <td>
	      <a href="#">Edit</a>
	    </td>
	  </tr>
	  <tr>
	    <td>
	      John
	    </td>
	    <td>
	      344-444-4444
	    </td>
	    <td>
	      Tables are cool
	    </td>
	    <td>
	      <a href="#">Edit</a>
	    </td>
	  </tr>
	 </tbody>
</table>--> 
<?php 
if ($_GET["var"]=="ver") {
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
		        echo "<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$c'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<input type='file' name='".$ndf->nombrecampo($i)."'>";
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
		        echo "<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$c'>";
		    }
		    if ($ndf->nombrecampo($i)=="Foto") {
		        echo "<input type='file' name='".$ndf->nombrecampo($i)."'>";
		    }
	    }
	    echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
	    echo "</form>";
	    echo "</div>";
	    echo "</div>";
}
if ($_GET["var"]=="actualizarFarmacia")	{
	$nomTabla=$_GET["tab"];
	$idr=$_GET["id"];
	if ($nomTabla!="usuarios") {
		$query="select * from $nomTabla where Id='$idr'";
	}
	if ($nomTabla=="usuarios") {
		$query="select * from $nomTabla where Cedula='$idr'";
	}
	$ndf->consulta($query);
	$ndf->actualizar($nomTabla, "kcnfnjew");
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
    $ndf->actualizar($nomTabla, $c);
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
		    if ($ndf->nombrecampo($i)!="Id" and $ndf->nombrecampo($i)!="Usuario" and $ndf->nombrecampo($i)!="Foto" and $ndf->nombrecampo($i)!="Farmacia") {
		        echo "<input type='text' name='".$ndf->nombrecampo($i)."'placeholder='".$ndf->nombrecampo($i)."'>";
		    }
		    if ($ndf->nombrecampo($i)=="Usuario") {
		        echo "<input type='hidden' name='".$ndf->nombrecampo($i)."' value='$c'>";
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
 ?>
<!--Tabla-->
<!--<div class="wrapper">
		<div id="main" style="padding:50px 0 0 0;">	-->
		<!-- Form -->
		<!--<form id="contact-form" action="/" method="post">
			<h3>Nueva Farmacia</h3>
			<div>
				<label>
					<span>Nombre: </span>
					<input placeholder="nombre" type="text" tabindex="1" required autofocus>
				</label>
			</div>
			<div>
				<label>
					<span>Email: </span>
					<input placeholder="email" type="email" tabindex="2" required>
				</label>
			</div>
			<div>
				<label>
					<span>Telefono: </span>
					<input placeholder="telefono" type="tel" tabindex="3" required>
				</label>
			</div>
			<div>
				<label>
					<span>Sitio: </span>
					<input placeholder="Sitio" type="url" tabindex="4" required>
				</label>
			</div>
			<div>
				<label>
					<span>Mensaje: </span>
					<textarea placeholder="descripcion" tabindex="5" required></textarea>
				</label>
			</div>
			<div>
				<button name="submit" type="submit" id="contact-submit">Registrar</button>
			</div>
		</form>-->
		<!-- /Form -->	
		<!--</div>
</div>-->
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