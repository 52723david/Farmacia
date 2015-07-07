<?php 
include("../modelo/confi.php"); 
include("../modelo/clase.php");
$ndf=new clase_mysql;
$ndf->conectar($db_name, $db_host, $db_user, $db_pasword);
if (@$_GET["va"]=="actualizar") {
		extract($_POST);
		extract($_GET);
		$var1=$_GET["nom"];
		$ce=$_GET["io"];
		$adr=$_GET["ad"];
		$va=$_GET["ced"];
		$cc=$_GET["ge"];
		$ccc=$_GET["gege"];
		echo "$va";
		//echo "$adr, $var1, $va, $cc";
		if ($var1!="usuarios" and $var1!="administrador") {
			$actualizar="update ".$var1." set Id='$adr'";
		}
		if ($var1=="usuarios" or $var1=="administrador") {
			$actualizar="update ".$var1." set Cedula='$adr'";
		}
		$miconexion=new clase_mysql;
		$miconexion->conectar($db_name, $db_host, $db_user, $db_pasword);
		$consulta2="select * from $var1";
		$miconexion->consulta($consulta2);
		for ($i=1; $i < $miconexion->numcampos(); $i++) { 
	  	$actualizar=$actualizar.", ".$miconexion->nombrecampo($i)."='".$_POST[$miconexion->nombrecampo($i)]."'";
		}
	 	//echo "$actualizar";
		if ($var1=="usuarios") {
			$actualizar=$actualizar." where Cedula='$adr'";
			$miconexion->consulta($actualizar);
			header("location: ../vista/Administrador/admin.php?va=$adr&var=usuario");
		}
		if ($var1=="administrador") {
			$actualizar=$actualizar." where Cedula='$adr'";
			$miconexion->consulta($actualizar);
			header("location: ../vista/Administrador/admin.php?va=$adr&var=administrador");
		}
		if ($var1=="farmacia") {
			$actualizar=$actualizar." where id='$adr'";
			$miconexion->consulta($actualizar);
			header("location: ../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=farmacia");
		}
		if ($var1=="productos") {
			$actualizar=$actualizar." where id='$adr'";
			//echo "$actualizar";
			$miconexion->consulta($actualizar);
			//echo "$adr";
			header("location: ../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=productos");
			//echo "../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=productos";
		}
		if ($var1=="turnos") {
			$actualizar=$actualizar." where id='$adr'";
			//echo "$actualizar";
			$miconexion->consulta($actualizar);
			//echo "$adr";
			header("location: ../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=turnos");
			//echo "<br>../vista/Administrador/administrador.php?va=$ced&var=productos&id=$adr";
		}
	}
if (@$_GET["va"]=="actualizarusuario") {
		extract($_POST);
		extract($_GET);
		$var1=$_GET["nom"];
		$ce=$_GET["io"];
		$adr=$_GET["ad"];
		$va=$_GET["ced"];
		$cc=$_GET["ge"];
		$ccc=$_GET["gege"];
		//echo "$va1";
		//echo "$adr, $var1, $va, $cc";
		$actualizar="update ".$var1." set Cedula='$adr'";
		$miconexion=new clase_mysql;
		$miconexion->conectar($db_name, $db_host, $db_user, $db_pasword);
		$consulta2="select * from $var1";
		$miconexion->consulta($consulta2);
		for ($i=1; $i < $miconexion->numcampos(); $i++) { 
	  	$actualizar=$actualizar.", ".$miconexion->nombrecampo($i)."='".$_POST[$miconexion->nombrecampo($i)]."'";
		}
	 	//echo "$actualizar";
		if ($var1=="usuarios") {
			$actualizar=$actualizar." where Cedula='$adr'";
			//echo "$actualizar";
			$miconexion->consulta($actualizar);
			header("location: ../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=usuarios");
			//echo "<br>../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=turnos";
		}
		if ($var1=="administrador") {
			$actualizar=$actualizar." where Cedula='$adr'";
			$miconexion->consulta($actualizar);
			header("location: ../vista/Administrador/admin.php?va=$va&var=administradortodo&nom=administrador");
	}
}
if (@$_GET["va"]=="ingresar") {
		extract($_POST);
  		extract($_GET);
  		$var1=$_GET["v"];
  		$var2=$_GET["f"];
  		$var=$_GET["idd"];
  		$ce=$_GET["ce"];
  		//echo "$ce<br>";
  		$actualizar="insert into ".$var1." values (' '";
  		/*if ($var1=="administrador") {
  			$actualizar="insert into ".$var1." values (";
  		}*/
  		$miconexion=new clase_mysql;
  		$miconexion->conectar($db_name, $db_host, $db_user, $db_pasword);
  		$consulta2="select * from $var1";
  		//echo "$consulta2<br>";
  		$miconexion->consulta($consulta2);
  		for ($i=1; $i < $miconexion->numcampos(); $i++) { 
  			if ($miconexion->nombrecampo($i)!="Foto") {
  				$actualizar=$actualizar.", '".$_POST[$miconexion->nombrecampo($i)]."'";
  			} 		
  			if ($miconexion->nombrecampo($i)=="Foto") {
  				if (@$_FILES['archivo']["error"] > 0) {
      				echo "Error: " . $_FILES['archivo']['error'] . "<br>";
 				} else {
    				move_uploaded_file(@$_FILES['archivo']['tmp_name'],"../photo/".@$_FILES['archivo']['name']);
 				}
  				$actualizar=$actualizar.", '".$_POST[$miconexion->nombrecampo($i)]."'";
  			}
  		}
  		$actualizar=$actualizar.")";
		//echo "$actualizar";
  		$miconexion->consulta($actualizar);
  		/*if ($var1!="productos") {
  			header("location: ../vista/Administrador/administrador.php?va=$var2&var=ver");
  		}*/
  		if ($var1=="productos") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=productos");
  		}
  		if ($var1=="turnos") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=turnos");
  			//echo "../vista/Administrador/administrador.php?va=$ce&var=administradortodo&id=$var&nom=turnos";
  		}
  		/*if ($var1=="administrador") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=administrador");
  		}*/
  		if ($var1=="farmacia") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=farmacia");
  		}
	}
	if (@$_GET["va"]=="ingresarusuario") {
		extract($_POST);
  		extract($_GET);
  		$var1=$_GET["v"];
  		$var2=$_GET["f"];
  		$var=$_GET["idd"];
  		$ce=$_GET["ce"];
  		//echo "$ce<br>";
  		$actualizar="insert into ".$var1." values (";
  		/*if ($var1=="administrador") {
  			$actualizar="insert into ".$var1." values (";
  		}*/
  		$miconexion=new clase_mysql;
  		$miconexion->conectar($db_name, $db_host, $db_user, $db_pasword);
  		$consulta2="select * from $var1";
  		//echo "$consulta2<br>";
  		$miconexion->consulta($consulta2);
  		for ($i=0; $i < $miconexion->numcampos(); $i++) {
  			if ($miconexion->nombrecampo($i)=="Cedula") {
  				$actualizar=$actualizar."'".$_POST[$miconexion->nombrecampo($i)]."'";
  			} 
  			if ($miconexion->nombrecampo($i)=="Usuario" or $miconexion->nombrecampo($i)=="Password") {
  				$actualizar=$actualizar.", '".MD5($_POST[$miconexion->nombrecampo($i)])."'";
  			} 
  			if ($miconexion->nombrecampo($i)!="Foto" and $miconexion->nombrecampo($i)!="Cedula" and $miconexion->nombrecampo($i)!="Usuario" and $miconexion->nombrecampo($i)!="Password") {
  				$actualizar=$actualizar.", '".$_POST[$miconexion->nombrecampo($i)]."'";
  			} 		
  			if ($miconexion->nombrecampo($i)=="Foto") {
  				if (@$_FILES['archivo']["error"] > 0) {
      				echo "Error: " . $_FILES['archivo']['error'] . "<br>";
 				} else {
    				move_uploaded_file(@$_FILES['archivo']['tmp_name'],"../photo/".@$_FILES['archivo']['name']);
 				}
  				$actualizar=$actualizar.", '".$_POST[$miconexion->nombrecampo($i)]."'";
  			}
  		}
  		$actualizar=$actualizar.")";
		//echo "$actualizar";
  		$miconexion->consulta($actualizar);
  		/*if ($var1!="productos") {
  			header("location: ../vista/Administrador/administrador.php?va=$var2&var=ver");
  		}*/
  		/*if ($var1=="productos") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=productos");
  		}
  		if ($var1=="turnos") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=turnos");
  			//echo "../vista/Administrador/administrador.php?va=$ce&var=administradortodo&id=$var&nom=turnos";
  		}*/
  		if ($var1=="usuarios") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=usuarios");
  		}
	}
	if ($_GET["va"]=="borrarfarmacia") {
		$v3=$_GET["var"];
		$v=$_GET["ce"];
		$id=$_GET["id"];
		$query="delete from productos where Farmacia='$id'";
		//echo "$query<br>";
		$ndf->consulta($query);
		$query="delete from turnos where Farmacia='$id'";
		//echo "$query<br>";
		$ndf->consulta($query);
		$query="delete from farmacia where Id='$id'";
		//echo "$query";
		$ndf->consulta($query);
		header("location: ../vista/Administrador/admin.php?va=$v&var=administradortodo&id=$var&nom=farmacia");
		//echo "../vista/Administrador/admin.php?va=$v&var=administradortodo&nom=farmacia";
	}
	if (@$_GET["va"]=="borrar") {
		$var2=$_GET["ce"];
		$v3=$_GET["id"];
		$v=@$_GET["ht"];
		$ta=$_GET["tab"];
		//echo "$ta";
		$ndf->consulta("delete from ".$ta." where Id=$v3");
		//echo "delete from ".$ta." where Id='$v3'";
		$query="select * from farmacia where Id='$v'";
		//echo "<br>$query";
    	$ndf->consulta($query);
    	$d=$ndf->consulta_lista();
    	$ce=$d[13];
    	//echo "$ce";
        header("location: ../vista/Administrador/admin.php?va=$var2&var=administradortodo&nom=$ta");
        //echo "location: ../vista/Administrador/administrador.php?va=$var2&var=administradortodo&nom=productos";
	}
	if ($_GET["va"]=="borrarusuario") {
		$v=$_GET["id"];
		$query="select * from farmacia where Usuario='$v'";
		echo "$v";
		$ndf->consulta($query);
		$d=$ndf->consulta_lista();
		while ($d>0) {
			$v3=$d[0];
			$query="delete from productos where Farmacia='$v3'";
			//echo "delete from productos where Farmacia='$v3'<br>";
			$ndf->consulta($query);
			$query="delete from turnos where Farmacia='$v3'";
			//echo "delete from turnos where Farmacia='$v3'<br>";
			$ndf->consulta($query);
			$query="delete from farmacia where Id='$v3'";
			//echo "delete from farmacia where Id='$v3'";
			$ndf->consulta($query);
			$query="select * from farmacia where Usuario='$v'";
			$ndf->consulta($query);
			$d=$ndf->consulta_lista();
		}
		$query="delete from usuarios where Cedula='$v'";
		$ndf->consulta($query);
		header("location: ../vista/Administrador/admin.php?va=$v&var=administradortodo&nom=usuarios");
		//echo "../vista/Administrador/admin.php?va=$v&var=administradortodo&nom=usuarios";
	}
 ?>