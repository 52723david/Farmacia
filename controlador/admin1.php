<?php
	include("../modelo/confi.php"); 
	include("../modelo/clase.php");
	$ndf=new clase_mysql;
	$ndf->conectar($db_name, $db_host, $db_user, $db_pasword);
	//si el usuario tiene cuenta creada como user
	if (@$_GET["va"]=="loguin" and $_GET['tipo']=="user") {
		$usuario1 = $_POST['usuario'];
		$clave1 = $_POST['clave'];
		$query="select * from usuarios where Usuario=MD5('$usuario1') and Password=MD5('$clave1')";
		//echo "$query";
		$ndf->consulta($query);
		$ndf->validar($_GET['tipo']);
	}
	//si el usuario tiene cuenta creada como admin
	if (@$_GET["va"]=="loguin" and $_GET['tipo']=="admin") {
		$usuario1 = $_POST['usuario'];
		$clave1 = $_POST['clave'];
		$query="select * from administrador where Usuario=MD5('$usuario1') and Password=MD5('$clave1')";
		$ndf->consulta($query);
		$ndf->validar($_GET['tipo']);
	}
	//el usuario crea cuenta
	if (@$_GET["va"]=="registrarse") {
		extract($_POST);
		/*$usuario1 = $_POST['usuario'];*/

		$query="select * from usuarios where Usuario=MD5('$Usuario')";
		//echo "$query";
		$ndf->consulta($query);
	    $d2=$ndf->consulta_lista();
	    if ($d2>0) {
	    	echo "<script>alert('El usuario ya exite.')</script>";
		    echo "<script>location.href='../vista/Login/login.php'</script>";
	    }else{
	    if (@$_FILES['archivo']["error"] > 0) {
      				echo "Error: " . $_FILES['archivo']['error'] . "<br>";
 		} else {
    		move_uploaded_file(@$_FILES['archivo']['tmp_name'],"../photo/".@$_FILES['archivo']['name']);
 		}
		$sql="insert into usuarios values ('$Cedula', '$Nombres', '$Apellidos', '$Foto', '$Mail', '$Celular', MD5('$Usuario'), MD5('$Password'))";
		$ndf->consulta($sql);
		echo "<script>location.href='../vista/Login/login.php'</script>";
	    }
	}
	
	//destruye la vriables de secion y cierra la sesion
	if (@$_GET["va"]=="salir") {
		session_start();
		session_unset();
		session_destroy();
		header("location: ../index.php");
	}
	//Ingresa uan fila en cuelquier tabla de la base
	if (@$_GET["va"]=="ingresar") {
		extract($_POST);
  		extract($_GET);
  		$var1=$_GET["v"];
  		$var2=$_GET["f"];
  		$var=$_GET["idd"];
  		//echo "$var1 $var2 $var<br>";
  		$actualizar="insert into ".$var1." values (' '";
  		$miconexion=new clase_mysql;
  		$miconexion->conectar($db_name, $db_host, $db_user, $db_pasword);
  		$consulta2="select * from $var1";
  		$miconexion->consulta($consulta2);
  		for ($i=1; $i < $miconexion->numcampos(); $i++) { 
  			if ($miconexion->numcampos($i)!="Foto") {
  				$actualizar=$actualizar.", '".$_POST[$miconexion->nombrecampo($i)]."'";
  			}
  			if ($miconexion->numcampos($i)=="Foto") {
  				if ($_FILES['archivo']["error"] > 0) {
      				echo "Error: " . $_FILES['archivo']['error'] . "<br>";
 				} else {
    				move_uploaded_file($_FILES['archivo']['tmp_name'],"../photo/".$_FILES['archivo']['name']);
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
	}
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
		if ($var1!="usuarios") {
			$actualizar="update ".$var1." set Id='$adr'";
		}
		if ($var1=="usuarios") {
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
			header("location: ../vista/Administrador/administrador.php?va=$adr&var=usuario");
		}
		if ($var1=="farmacia") {
			$actualizar=$actualizar." where id='$adr'";
			$miconexion->consulta($actualizar);
			header("location: ../vista/Administrador/administrador.php?va=$ce&var=ver");
		}
		if ($var1=="productos") {
			$actualizar=$actualizar." where id='$adr'";
			//echo "$actualizar";
			$miconexion->consulta($actualizar);
			//echo "$adr";
			header("location: ../vista/Administrador/administrador.php?va=$ced&var=productos&id=$cc");
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
	if (@$_GET["var"]=="borrar") {
		$var2=$_GET["var"];
		$v3=$_GET["id"];
		$v=@$_GET["ht"];
		$ta=$_GET["tab"];
		//echo "$v";
		$ndf->consulta("delete from ".$ta." where Id=$v3");
		//echo "delete from ".$ta." where Id='$v3'";
		$query="select * from farmacia where Id='$v'";
		//echo "<br>$query";
    	$ndf->consulta($query);
    	$d=$ndf->consulta_lista();
    	$ce=$d[13];
        header("location: ../vista/Administrador/administrador.php?va=$ce&var=$ta&id=$v");
        //echo "location: ../vista/Administrador/administrador.php?va=$ce&var=$ta&id=$v";
	}
	if (@$_GET["var"]=="borrarfarmacia") {
      $ce=$_GET["va"];//numero de cedula
      $rrr=@$_GET["tab"];//nombre de la tabla
      $r=@$_GET["id"];//el id de la farmacia
      $rr=$_GET["nomb"];
      //echo "$rrr $ce $r $rr";
      echo "<script>if(confirm('¿Seguro que desea borrar a - $rr -?')){
            document.location='admin1.php?var=$r&de=$ce&va=$rrr';}
            else{ document.location='../vista/Administrador/administrador.php?va=$ce&var=ver';}</script>";
    }
    if (@$_GET["var"]=="actualizartabla") {
      //$ce=$_GET["va"];//numero de cedula
      $rrr=@$_GET["tab"];//nombre de la tabla
      $r=@$_GET["id"];//el id de la tabla
      $idtab=@$_GET["ifr"];//el id de la farmacia
      $idtur=@$_GET["itr"];//el id de turnos
      if ($rrr=="productos") {
      	$query="select * from farmacia where Id='$idtab'";
      }
      if ($rrr=="turnos") {
      	$query="select * from farmacia where Id='$idtur'";
      }
	  $ndf->consulta($query);
	  $d=$ndf->consulta_lista();
	  $us=$d[13];//cedula del usuario
      //echo "$us $rrr $r $idtab $idtur<br>$query";
	  header("location: ../vista/Administrador/administrador.php?va=$us&var=actualizar&tab=$rrr&idd=$r");
    }
    //metodo para borrar una farmacia
	//***************************************************************************//
	if ($_GET["va"]=="farmacia") {
		$v3=$_GET["var"];
		$v=$_GET["de"];
		$query="delete from productos where Farmacia='$v3'";
		$ndf->consulta($query);
		$query="delete from turnos where Farmacia='$v3'";
		$ndf->consulta($query);
		$query="delete from farmacia where Id='$v3'";
		$ndf->consulta($query);
		header("location: ../vista/Administrador/administrador.php?va=$v&var=ver");
	}
	//metodo para borrar un usuario
	//***************************************************************************//
	if ($_GET["va"]=="usuarios") {
		$v=$_GET["de"];
		$query="select * from farmacia where Usuario='$v'";
		//echo "$query";
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
		header("location: ../vista/Login/login.php");
	}
	if ($_GET["va"]=="buscar") {
		$ve=$_GET["busca"];
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
  		}
	}

 ?>