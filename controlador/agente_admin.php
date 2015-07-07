<?php
	class agente_admin{    	
		Var $Logiado="";
		Var $Resultado="";
		
		function buscar($bus){
			include("../datos/confi.php"); 
			include("../datos/clase.php");
			$ndf=new clase_mysql;
			$ndf-> conectar($db_name, $db_host, $db_user, $db_pasword);
			//$ndf-> mysql_set_charset('utf8');
			//$text = "";
			$sql = "SELECT * FROM productos WHERE Nombre LIKE '%" .$bus. "%' ORDER BY Nombre";
			$sql1 = "SELECT * FROM categoria WHERE Titulo LIKE '%" .$bus. "%' ORDER BY Titulo";
			//$sql1="select * from productos where Nombre=$bus";
			$frt=$ndf->consulta($sql);
			$frt1=$ndf->consulta($sql1);
	  		//$resultado = mysql_query($sql); //Ejecución de la consulta
      		//Si hay resultados...
	  		if (mysql_num_rows($frt) > 0 or mysql_num_rows($frt1) > 0){ 
	     		// Se recoge el número de resultados
				 //$registros = '<p>HEMOS ENCONTRADO ' . mysql_num_rows($frt) . ' registros </p>';
	     		// Se almacenan las cadenas de resultado
	     		if (mysql_num_rows($frt) > 0) {
	     			while($fila = mysql_fetch_assoc($frt)){ 
		 			//echo $sq;
		 			//$ndf->consulta($sql1);
		 			//$ndf->verconsulta();
              		$text = $fila['Nombre'];
              		$text1 = $fila['Descripcion'];
              		$text2 = $fila['Precio'];
              		echo "$text<br>  $text1<br>  $text2<br><br><br>";
              		//echo "<script>alert('$text $text1 $text2')</script>";
					//echo "<script>location.href='../iu/admin.php'</script>";
			 		}
	     		}
	     		if (mysql_num_rows($frt1) > 0) {
	     			while($fila = mysql_fetch_assoc($frt1)){ 
		 			//echo $sq;
		 			//$ndf->consulta($sql1);
		 			//$ndf->verconsulta();
              		$text = $fila['Titulo'];
              		$text1 = $fila['Descripcion'];
              		//$text2 = $fila['Precio'];
              		echo "$text<br>  $text1<br><br><br>";
              		//echo "<script>alert('$text $text1 $text2')</script>";
					//echo "<script>location.href='../iu/admin.php'</script>";
			 		}
	     		}
	  		}else{
	  				echo "<script>alert('NO HAY RESULTADOS EN LA BBDD')</script>";
					echo "<script>location.href='../iu/admin.php'</script>";
			   		//$text = "NO HAY RESULTADOS EN LA BBDD";	
	  		}
	  		//echo $text;
		}
	}
?>
