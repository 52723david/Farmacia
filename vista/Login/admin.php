
<?php 
//header('Content-Type: text/html; charset=ISO-8859-1');
//include ("../static/site_config.php"); 
//include ("../static/conect_mysql.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Administrador</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="http://127.0.0.1/ing_web_2015/Farmacia/vista/portal/index.php">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h1 class="text-muted">Bienbenidos al login del Administrador</h1>
      </div>

      <div class="jumbotron">
        <center>
		<div class="estilo_caja">
		<form action="../../controlador/admin1.php?va=loguin&tipo=admin" method="post" name="form">
			<table>
				<tr>
					<td><p>Usuario: </p></td>
					<td><input type="text" name="usuario" placeholder="Usuario" required></td>
				</tr>
				<tr>
					<td><p>Clave:</p></td>
					<td><input type="password" name="clave" placeholder="clave" required></td>
				</tr>
				<tr>
					<td></td>
					<td><input align="right" type="submit" id="boton" name="btn_enviar" value="Enviar"></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="#">olvidó su clave</a></td>
				</tr>
			</table>		
		</form>
		</div>
		</center>
      </div>

      <footer class="footer">
        <p align="center">Diego Guevara | &copy; Universidad Técnica particular de Loja 2015</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
