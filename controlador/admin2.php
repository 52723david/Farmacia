<?php 
include("../modelo/confi.php"); 
include("../modelo/clase.php");
if (@$_GET["va"]=="actualizar") {
		extract($_POST);
		extract($_GET);
		$var1=$_GET["nom"];
		$ce=$_GET["io"];
		$adr=$_GET["ad"];
		$va=$_GET["ced"];
		$cc=$_GET["ge"];
		$ccc=$_GET["gege"];
		//echo "$adr $var1 $va $cc";
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
			header("location: ../vista/Administrador/admin.php?va=$ce&var=ver");
		}
		if ($var1=="productos") {
			$actualizar=$actualizar." where id='$adr'";
			//echo "$actualizar";
			$miconexion->consulta($actualizar);
			//echo "$adr";
			header("location: ../vista/Administrador/admin.php?va=$ced&var=productos&id=$cc");
			//echo "../vista/Administrador/administrador.php?va=$ced&var=productos&id=$adr";
		}
		if ($var1=="turnos") {
			$actualizar=$actualizar." where id='$adr'";
			//echo "$actualizar";
			$miconexion->consulta($actualizar);
			//echo "$adr";
			header("location: ../vista/Administrador/administrador.php?va=$ced&var=turnos&id=$ccc");
			//echo "../vista/Administrador/administrador.php?va=$ced&var=productos&id=$adr";
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
  		if ($var1!="administrador") {
  			$actualizar="insert into ".$var1." values (' '";
  		}
  		if ($var1=="administrador") {
  			$actualizar="insert into ".$var1." values (";
  		}
  		$miconexion=new clase_mysql;
  		$miconexion->conectar($db_name, $db_host, $db_user, $db_pasword);
  		$consulta2="select * from $var1";
  		$miconexion->consulta($consulta2);
  		for ($i=0; $i < $miconexion->numcampos(); $i++) { 
  			if ($miconexion->nombrecampo($i)=="Cedula") {
  				$actualizar=$actualizar." '".$_POST[$miconexion->nombrecampo($i)]."'";
			}
  			if ($miconexion->nombrecampo($i)!="Foto" && $miconexion->nombrecampo($i)!="Password" && $miconexion->nombrecampo($i)!="Cedula" && $miconexion->nombrecampo($i)!="Usuario") {
  				$actualizar=$actualizar.", '".$_POST[$miconexion->nombrecampo($i)]."'";
  			}
  			if (($miconexion->nombrecampo($i)=="Password") || ($miconexion->nombrecampo($i)=="Usuario")) {
  				$actualizar=$actualizar.", '".MD5($_POST[$miconexion->nombrecampo($i)])."'";
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
  		if ($var1!="productos") {
  			header("location: ../vista/Administrador/administrador.php?va=$var2&var=ver");
  		}
  		if ($var1=="productos") {
  			header("location: ../vista/Administrador/administrador.php?va=$var2&var=productos&id=$var");
  		}
  		if ($var1=="turnos") {
  			header("location: ../vista/Administrador/administrador.php?va=$var2&var=turnos&id=$var");
  		}
  		if ($var1=="administrador") {
  			header("location: ../vista/Administrador/admin.php?va=$ce&var=administradortodo&id=$var&nom=administrador");
  		}
	}
 ?>