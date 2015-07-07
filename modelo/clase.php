<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../modelo/estiloss.css">
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
	<link href="estilos/stacktable.css" rel="stylesheet" />
	<link href="estilos/style.css" rel="stylesheet" />
</head>
<body>
<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
class clase_mysql{
	var $baseDatos;
	var $servidor;
	var $usuario;
	var $clave;
	/*identiicadores de conexion y consulta*/
	var $conexio_ID;
	var $consulta_ID;
	/*numero de error y error de texto*/
	var $Errno=0;
	var $Error="";
	function clase_mysqul(){
		//constructor
	}
	function conectar($db,$host,$user,$pass){
		if ($db!="") $this->baseDatos=$db;
		if ($host!="") $this->servidor=$host;
		if ($user!="") $this->usuario=$user;
		if ($pass!="") $this->clave=$pass;
		/*conectamos al servidor*/
		$this->conexio_ID=mysql_connect($this->servidor,$this->usuario,$this->clave);
		if (!$this->conexio_ID) {
			$this->Error="conexion fallida";
			return 0;
		}
		//seleccionamos la base de datos
		if (!mysql_select_db($this->baseDatos,$this->conexio_ID)) {
			$this->Error="Imposible abrir".$this->baseDatos;
		}
		/*si todo sale bien*/
		return $this->conexio_ID;
	}
	//Ejecuta cualquier consulta
	function consulta($sql=""){
		if ($sql=="") {
			$this->Error="no hay ningun sql";
			return 0;
		}
		//ejecutamos la consulta
		$this->consulta_ID=mysql_query($sql,$this->conexio_ID);
		if (!$this->consulta_ID) {
			$this->Error=mysql_errno();
			$this->Error=mysql_error();
		}
		//si todo sale bien
		return $this->consulta_ID;
	}
	//devuelve el numero de campos de la consulta
	function numcampos(){
		return @mysql_num_fields($this->consulta_ID);
	}
	//devuelve el numero de registros
	function numregistros(){
		return mysql_num_rows($this->consulta_ID);
	}
	//devuelve el nombre de un campo de la consulta
	function nombrecampo($numcampo){
		return @mysql_field_name($this->consulta_ID, $numcampo);
	}
	//muestra los resultados de la consulta
	function verconsulta($r, $f, $t){
		echo "<table id='card-table' class='table' align='center' whidth=100% aligen='center' border=1>";
		echo "<tr>";
		for ($i=0; $i < $this->numcampos() ; $i++) { 
			if ($this->nombrecampo($i)!=$f and $this->nombrecampo($i)!="Id" and $this->nombrecampo($i)!="Foto" and $this->nombrecampo($i)!="Farmacia" and $this->nombrecampo($i)!="Descripcion" and $this->nombrecampo($i)!="Horario" and $this->nombrecampo($i)!="Zona" and $this->nombrecampo($i)!="Provincia" and $this->nombrecampo($i)!="Canton" and $this->nombrecampo($i)!="Latitud" and $this->nombrecampo($i)!="Longitud" and $this->nombrecampo($i)!="Usuario" and $this->nombrecampo($i)!="Cedula" and $this->nombrecampo($i)!="Password") {
				echo "<th>".$this->nombrecampo($i)."</th>";
			}
		}
		echo "<th></th>";
		echo "</tr>";
		while (@$row=mysql_fetch_array($this->consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) {
				if ($this->nombrecampo($i)!=$f and $this->nombrecampo($i)!="Id" and $this->nombrecampo($i)!="Foto" and $this->nombrecampo($i)!="Farmacia" and $this->nombrecampo($i)!="Descripcion" and $this->nombrecampo($i)!="Horario" and $this->nombrecampo($i)!="Zona" and $this->nombrecampo($i)!="Provincia" and $this->nombrecampo($i)!="Canton" and $this->nombrecampo($i)!="Latitud" and $this->nombrecampo($i)!="Longitud" and $this->nombrecampo($i)!="Usuario" and $this->nombrecampo($i)!="Cedula" and $this->nombrecampo($i)!="Password") {
				 	echo "<td>".$row[$i]."</td>";
				 } 
				if ($this->nombrecampo($i)==$f) {
				 	echo "<td>".$r."</td>";
				 	//echo "<td>".$t."</td>";
				 }
			}
			$us=end( $row );
			$cer=$row[0];
			$tabla = mysql_field_table ( $this->consulta_ID, 0);
			$nom=$row[1];
			$idfar=@$row[9];
			$idtur=@$row[3];
			$ce=@$row[13];
			//echo "$ce, "; 
			//echo "<td><a href='../view/menu/usuario.php?id=$row[0]&var=actualizar&va=$t&tab=$tabla'>Actualizar</a></td>";
			//echo "<td><a href='../controller/admin1.php?id=$row[0]&va=borrar&var=$tabla&ht=$us'>Borrar</a></td>";
			echo "<td>";
			?>
			<div align="center" id="header1">
				<ul class="nav1">
					<li><a href="">Opciones</a>
						<ul>
						<?php
						if ($f!="admin") {
						if ($tabla!="productos" and $tabla!="turnos" and $f!="admin") {
							echo "<li><a href='administrador.php?id=$row[0]&var=actualizar&va=$cer&tab=$tabla'>Actualizar</a>";
							echo "<li><a href='../../controlador/admin1.php?id=$row[0]&va=$cer&var=borrarfarmacia&tab=$tabla&nomb=$nom'>Borrar</a>";
						}
						if ($tabla=="productos" or $tabla=="turnos") {
							echo "<li><a href='../../controlador/admin1.php?id=$row[0]&var=actualizartabla&va=$cer&tab=$tabla&ifr=$idfar&itr=$idtur'>Actualizar</a>";
							echo "<li><a href='../../controlador/admin1.php?id=$row[0]&va=$cer&var=borrar&tab=$tabla&nomb=$nom&ht=$us'>Borrar</a>";
						}
						}
						if ($f=="admin") {
							if ($tabla!="productos" and $tabla!="turnos" and $tabla!="usuarios") {
								//echo "$cer";
								echo "<li><a href='admin.php?id=$row[0]&var=actualizar&var1=$cer&tab=$tabla&va=$r'>Actualizar</a>";
								echo "<li><a href='../../controlador/admin2.php?id=$row[0]&va=borrarfarmacia&tab=$tabla&nomb=$nom&ht=$us&ce=$r'>Borrar</a>";
								echo "<li><a href='admin.php?id=$row[0]&var=Detalles1&tab=$tabla&va=$r'>Detalles</a>";
							}
							if ($tabla=="productos" or $tabla=="turnos") {
								echo "<li><a href='admin.php?id=$row[0]&var=actualizar&var1=$cer&tab=$tabla&va=$r'>Actualizar</a>";
								echo "<li><a href='../../controlador/admin2.php?id=$row[0]&va=borrar&tab=$tabla&nomb=$nom&ht=$us&ce=$r'>Borrar</a>";
							}
							if ($tabla=="usuarios") {
								echo "<li><a href='admin.php?id=$row[0]&var=actualizarusuario&var1=$cer&tab=$tabla&va=$r'>Actualizar</a>";
								echo "<li><a href='../../controlador/admin2.php?id=$row[0]&va=borrarusuario&tab=$tabla&nomb=$nom&ht=$us&ce=$r'>Borrar</a>";
								echo "<li><a href='admin.php?id=$row[0]&var=detalle&tab=$tabla&va=$r'>Detalles</a>";
							}
						}
						?>
						</ul>
					</li>
				</ul>
			</div>
			<?php
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	function detalles(){
		echo "<table id='card-table' class='table' align='center' whidth=100% aligen='center' border=1>";
		echo "<tr>";
		for ($i=0; $i < $this->numcampos() ; $i++) { 
			echo "<th>".$this->nombrecampo($i)."</th>";
		}
		//echo "<td></td>";
		//echo "<td></td>";
		echo "</tr>";
		while (@$row=mysql_fetch_array($this->consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) {
				 echo "<td>".$row[$i]."</td>";
			}
			//$us=end( $row );
			//$tabla = mysql_field_table ( $this->consulta_ID, 0); 
			//echo "<td><a href='../view/menu/usuario.php?id=$row[0]&var=actualizar&va=$t&tab=$tabla'>Actualizar</a></td>";
			//echo "<td><a href='../controller/admin1.php?id=$row[0]&va=borrar&var=$tabla&ht=$us'>Borrar</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	function ver($r, $f){
		echo "<table id='card-table' class='table' align='center' whidth=100% aligen='center' border=1>";
		echo "<tr>";
		for ($i=0; $i < $this->numcampos() ; $i++) {
		if ($this->nombrecampo($i)!="Id" and $this->nombrecampo($i)!="Foto" and $this->nombrecampo($i)!="Descripcion" and $this->nombrecampo($i)!="Zona" and $this->nombrecampo($i)!="Provincia" and $this->nombrecampo($i)!="Canton" and $this->nombrecampo($i)!="Latitud" and $this->nombrecampo($i)!="Longitud" and $this->nombrecampo($i)!="Usuario") {
			echo "<th>".$this->nombrecampo($i)."</th>";
		 } 
		}
		echo "<th>Opciones</th>";
		echo "</tr>";
		while (@$row=mysql_fetch_array($this->consulta_ID)) {
			echo "<tr>";
			for ($i=0; $i < $this->numcampos(); $i++) {
				if ($this->nombrecampo($i)!=$f) {
					/*if ($this->nombrecampo($i)=="Nombre") {
						echo "<td><a href='../view/menu/usuario.php?var=ver&va=$row[13]&yur=$row[0]&yu=$row[1]'>".$row[$i]."</a></td>";
					}*/
					if ($this->nombrecampo($i)!="Usuario" and $this->nombrecampo($i)!="Id" and $this->nombrecampo($i)!="Foto" and $this->nombrecampo($i)!="Descripcion" and $this->nombrecampo($i)!="Zona" and $this->nombrecampo($i)!="Provincia" and $this->nombrecampo($i)!="Canton" and $this->nombrecampo($i)!="Latitud" and $this->nombrecampo($i)!="Longitud") {
						echo "<td>".$row[$i]."</td>";
					}
				 } 
				$ID=$row[0];
				$CE=$row[13];
				$tabla = mysql_field_table ( $this->consulta_ID, 0);
				if ($this->nombrecampo($i)==$f) {
				 	//echo "<td><a href='../view/menu/usuario.php'>".$r."</a></td>";
				 	//echo "<td><a href='../Administrador/administrador.php?var=detalle&r=$ID&t=$tabla&va=$CE'>Detalle</a></td>";
				 }
			}
			$user=end( $row );
			$nom=$row[1];
			//echo "$ID<br>";
			$tabla = mysql_field_table ( $this->consulta_ID, 0); 
			//echo "<td><a href='../Administrador/administrador.php?id=$row[0]&var=actualizarFarmacia&va=$user&tab=$tabla'>Actualizar</a></td>";
			//echo "<td><a href='../../controller/admin1.php?id=$row[0]&va=$user&var=borrarfarmacia&tab=$tabla&nomb=$nom'>Borrar</a></td>";
			echo "<td>";
			?>
			<div align="center" id="header1">
				<ul class="nav1">
					<li><a href="">Opciones</a>
						<ul>
						<?php
							echo "<li><a href='administrador.php?id=$ID&var=productos&va=$CE'>Productos</a>";
							echo "<li><a href='administrador.php?id=$ID&var=turnos&va=$CE'>Turnos</a>";
							echo "<li><a href='../Administrador/administrador.php?var=Detalles1&r=$ID&t=$tabla&va=$CE'>Detalles</a>";
							echo "<li><a href='../Administrador/administrador.php?id=$row[0]&var=actualizarFarmacia&va=$user&tab=$tabla'>Actualizar</a>";
							echo "<li><a href='../../controlador/admin1.php?id=$row[0]&va=$user&var=borrarfarmacia&tab=$tabla&nomb=$nom'>Borrar</a>";
						?>
						</ul>
					</li>
				</ul>
			</div>
			<?php
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function consulta_lista(){
		$posicion=0;
		$vector="";
		while ($row = mysql_fetch_array($this->consulta_ID)) {
			for ($i=0; $i < $this->numcampos(); $i++) { 
				$vector[$posicion]=$row[$i];
				$posicion++;
			}				
		}
		return $vector;
	}
	function validar($r){
		//echo "$r";
		if ($row=mysql_fetch_array($this->consulta_ID)) {
		  session_start();//Inicializamos sesion
		  $_SESSION['usuario']=$row["Usuario"];
		  $_SESSION['password']=$row["Password"];
		  $cedula=$row["Cedula"];
		  if ($r=="user") {
		  	echo "<script>location.href='../vista/Administrador/administrador.php?va=$cedula&var=ver'</script>";
		  }else{
		  	echo "<script>location.href='../vista/Administrador/admin.php?va=$cedula'</script>";
		  }
		}else{
		  echo "<script>alert('usuario y contraseña ingresados incorrectos')</script>";
		  echo "<script>location.href='../vista/Login/login.php'</script>";
		}
	}
	function actualizar($sd, $ce, $tipo){
      while ($row=mysql_fetch_array($this->consulta_ID)) {
      	$c=@$row[13];
      	$cc=@$row[9];
      	$ccc=@$row[3];
      	//echo "$c";
      	echo "<div class='wrapper'>";
		echo "<div id='main' style='padding:50px 0 0 0;'>";
		if ($tipo=="admin") {
			echo @"<form id='contact-form' action='../../controlador/admin2.php?va=actualizar&nom=$sd&io=$c&ad=$row[0]&ced=$ce&ge=$cc&gege=$ccc' method='post'>";
		}
		if ($tipo!="admin") {
			echo @"<form id='contact-form' action='../../controlador/admin1.php?va=actualizar&nom=$sd&io=$c&ad=$row[0]&ced=$ce&ge=$cc&gege=$ccc' method='post'>";
		}
        for ($i=0; $i < $this->numcampos(); $i++) { 
          if ($this->nombrecampo($i)=="Id" or $this->nombrecampo($i)=="Usuario" or $this->nombrecampo($i)=="Farmacia" or $this->nombrecampo($i)=="Password") {
            echo "<input type='hidden' name='".$this->nombrecampo($i)."'value='".$row[$i]."'>";
          }
          if ($this->nombrecampo($i)=="Foto") {
            echo "<input type='file' name='".$this->nombrecampo($i)."'>";
          }
          if ($this->nombrecampo($i)!="Id" and $this->nombrecampo($i)!="Usuario" and $this->nombrecampo($i)!="Farmacia" and $this->nombrecampo($i)!="Foto" and $this->nombrecampo($i)!="Password") {
            echo "<input type='text' name='".$this->nombrecampo($i)."'value='".$row[$i]."'>";
          }
        }
        echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
        echo "</form>";
        echo "</div>";
	    echo "</div>";
      }
	}
	function actualizarusuario($sd, $ce, $tipo){
      while ($row=mysql_fetch_array($this->consulta_ID)) {
      	$c=@$row[13];
      	$cc=@$row[9];
      	$ccc=@$row[3];
      	//echo "$c";
      	echo "<div class='wrapper'>";
		echo "<div id='main' style='padding:50px 0 0 0;'>";
		echo @"<form id='contact-form' action='../../controlador/admin2.php?va=actualizarusuario&nom=$sd&io=$c&ad=$row[0]&ced=$ce&ge=$cc&gege=$ccc' method='post'>";
        for ($i=0; $i < $this->numcampos(); $i++) { 
          if ($this->nombrecampo($i)=="Id") {
            echo "<input type='hidden' name='".$this->nombrecampo($i)."'value='".$row[$i]."'>";
          }
          if ($this->nombrecampo($i)=="Foto") {
            echo "<input type='file' name='".$this->nombrecampo($i)."'>";
          }
          if ($this->nombrecampo($i)!="Id" and $this->nombrecampo($i)!="Foto") {
            echo "<input type='text' name='".$this->nombrecampo($i)."'value='".$row[$i]."'>";
          }
        }
        echo "<input type='submit' id='boton' name='btn_enviar' value='Enviar'>";
        echo "</form>";
        echo "</div>";
	    echo "</div>";
      }
	}
	function buscar($bus, $c){
	
		
			$sql = "SELECT * FROM farmacia WHERE Nombre LIKE '%" .$bus. "%' ORDER BY Nombre";
			$sql1 = "SELECT * FROM productos WHERE Nombre LIKE '%" .$bus. "%' ORDER BY Nombre";

//$sql1 = "SELECT * FROM categoria WHERE Titulo LIKE '%" .$bus. "%' ORDER BY Titulo";
			//$sql1="select * from productos where Nombre=$bus";
			$frt=$this->consulta($sql);
			$frt1=$this->consulta($sql1);
	  		//$resultado = mysql_query($sql); //Ejecución de la consulta
      		//Si hay resultados...
	  		if (mysql_num_rows($frt) > 0 or mysql_num_rows($frt1) > 0 ){ 
	     		// Se recoge el número de resultados
				 //$registros = '<p>HEMOS ENCONTRADO ' . mysql_num_rows($frt) . ' registros </p>';
	     		// Se almacenan las cadenas de resultado
	     		if (mysql_num_rows($frt) > 0) {
	     			while($fila = mysql_fetch_assoc($frt)){ 
		 			//echo $sq;
		 			//$ndf->consulta($sql1);
		 			//$ndf->verconsulta();
              		$text = $fila['Nombre'];
              		$text1 = $fila['Direccion'];
              		$text2 = $fila['Sector'];
              		$text3 = $fila['Foto'];
              		$text4 = $fila['Sector'];
              		//$text5 = $fila['Id'];
              		$sig_dolar= '\$';
              		//echo  $text."\$".$text1."---".$text2;
              		echo "<br>";
              		echo "<div class='todo'>";
						echo "<section class='seccion'>";
							echo "<article>";
								echo "<h2><center>$text<center></h2>";
								echo "<h4><$text</h4>";
								echo "<h4>$text1</h4>";
								echo "<h4>$text2</h4>";
								echo "<h4>$text4</h4>";
								//echo "<h4>$text5</h4>";
							echo "</article>";
						echo "</section>";
						echo "<aside class='sec_foto'>";
							echo "<div class='widget'>";
								echo "<div class='imagen'>";
									echo @"<img src='../images/$text3'>";
								echo "</div>";
							echo "</div>";
						echo "</aside>";
					echo "</div>";
              		//echo "$text &nbsp $ $text1 &nbsp $text2<br> <br>";
              	//	echo "<script>alert('$text $text1 ')</script>";
			 		}
	     		}
	     		if (mysql_num_rows($frt1) > 0) {
	     			while($fila = mysql_fetch_assoc($frt1)){ 
		 			//echo $sq;
		 			//$ndf->consulta($sql1);
		 			//$ndf->verconsulta();
              		$text = $fila['Nombre'];
              		$text1 = $fila['Precio'];
              		$text2 = $fila['Oferta'];
              		$text3 = $fila['Farmacia'];
              		$text4 = $fila['Foto'];
              		$text5 = $fila['Sector'];
              		//$text6 = $fila['Id'];
              		$this->consulta("select * from farmacia where Id ='$text3'");
              		$v=$this->consulta_lista();
              		$ve=$v[1];
              		echo "<br>";
  					echo "<div class='todo'>";
						echo "<section class='seccion'>";
							echo "<article>";
								echo "<h2><center>$text<center></h2>";
								echo "<h4><$text</h4>";
								echo "<h4>$text1</h4>";
								echo "<h4>$text2</h4>";
								echo "<h4>$ve</h4>";
								echo "<h4>$text5</h4>";
								//echo "<h4>$text6</h4>";
							echo "</article>";
						echo "</section>";
						echo "<aside class='sec_foto'>";
							echo "<div class='widget'>";
								echo "<div class='imagen'>";
									echo "<img src='../images/$text4'>";
								echo "</div>";
							echo "</div>";
						echo "</aside>";
					echo "</div>";
					echo "<br>";
              		//echo "$text &nbsp; $text1 &nbsp; $text2 &nbsp; $ve <br><br>";
              		//echo "<script>alert('$text $text1 $text2')</script>";
					//echo "<script>location.href='../iu/admin.php'</script>";
			 		}
	     		}
	     		echo "<br>";
	  		}else{
	  				echo "<script>alert('NO HAY RESULTADOS EN LA BBDD')</script>";
					echo "<script>location.href='admin.php?va=$c'</script>";
			   		//$text = "NO HAY RESULTADOS EN LA BBDD";	
	  		}
	  		//echo $text;
		}
	} 
?>
</body>
</html>