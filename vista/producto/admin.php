<html>
<head>
	<title>Control</title>
	<meta charset="utf-8" />
	 <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
	 <meta name="Willan" content="Caraguay">
</head>
<body>
	<header>
		<div class="logo">
			<a href="#">Control</a>
		</div>
		<div class="imagen-c">
		<img src="images/admin.jpg">
	</div>
	</header>
	
	<div class="menu-p">
		
			<nav class="menu">
				<ul class="menu-nav">
					<li><a href="#">Inicio</a></li>
					<li><a href="#">Reporte</a></li>
					<li><a href="#">Agregar Producto</a></li>
				</ul>
			</nav>
		
	</div>
	<section class="contenido">
		
	        <article class="art">
	            <h1><center>Nuevo Producto</center></h1><!--Titulo de articulo-->
	            <form class="contact_form" action="" method="post" name="contact_form">
	            	<li>
	        			<label for="name">Nombre:</label>
	        			<input type="text" name="name" />
	    			</li>
	            	<li>
		    			<label for="descripcion">Descripcion</label>
		    			<input type="text" name="descripcion" />
					</li>
					<li>
		    			<label for="precio">Precio</label>
		    			<input type="text" name="precio" />
					</li>
					<li>
		    			<label for="precio">Categoría</label>
		    			<input type="text" name="precio" />
					</li>
					<li>
					 	<label for="archivo">Imagen:</label>
	      				<input type="file" name="archivo" id="archivo">
					</li>
					    <button class="submit" type="submit">Agregar</button>
				</form>
	        </article>
	    
     </section>
     <aside class="sidebar">
                <h1>Reporte</h1>
                <table class="width200">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Cargo</th>
                <th>Twitter</th>
                <th>ID</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Mart&iacute;n</td>
                <td>Iglesias Lenci</td>
                <td>Desarrollador</td>
                <td>@martinigleu</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Mart&iacute;n</td>
                <td>Iglesias Lenci</td>
                <td>Desarrollador</td>
                <td>@martinigleu</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Mart&iacute;n</td>
                <td>Iglesias Lenci</td>
                <td>Desarrollador</td>
                <td>@martinigleu</td>
                <td>3</td>
            </tr>
            </tbody>
        </table>
                <p></p>
            </aside>
	<!--Contenido del panel de control-->
	
	<!--Contenido central-->

</body>
</html>