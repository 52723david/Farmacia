<?php 
include("../../modelo/confi.php"); 
include("../../modelo/clase.php");
$ndf=new clase_mysql;
$ndf->conectar($db_name, $db_host, $db_user, $db_pasword);
$c=$_GET['var'];
$query="select * from farmacia where Id='$c'";
$ndf->consulta($query);
$d2=$ndf->consulta_lista();
$nombre=$d2[1];
//echo "$nombre";
 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Productos</title>
<html lang="es">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- start slider -->		
	<link href="estilos/slider.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
	<script type="text/javascript" src="js/jquery.cslider.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#da-slider').cslider();
		});
	</script>
		<!-- Owl Carousel Assets -->
		<link href="estilos/owl.carousel.css" rel="stylesheet">
		     <!-- Owl Carousel Assets -->
		    <!-- Prettify -->
		    <script src="js/owl.carousel.js"></script>
		        <script>
		    $(document).ready(function() {
		
		      $("#owl-demo").owlCarousel({
		        items : 4,
		        lazyLoad : true,
		        autoPlay : true,
		        navigation : true,
			    navigationText : ["",""],
			    rewindNav : false,
			    scrollPerPage : false,
			    pagination : false,
    			paginationNumbers: false,
		      });
		
		    });
		    </script>
		   <!-- //Owl Carousel Assets -->
		<!-- start top_js_button -->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		   <script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){		
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
					});
				});
			</script>
</head>
<body> 

<!-- start header -->
<div class="header_bg">
<div class="wrap">
	<div class="header">
		<div class="logo">
			<a href="<?php echo "index.php?var=$c&va=especificacion"; ?>"><h1><?php echo $nombre; ?></h1></a>
		</div>
		
	</div>
	<div class="h_search">
    		<?php echo "<form id='buscador' name='buscador' method='post' action='index.php?var=$c&va=buscar'>"; ?>
				<input type="text" name="busca"placeholder="Buscar..."> 
				<input type="submit" value="Ir">
   			</form>
	</div>
		<div class="clear"></div>
</div>
</div>


<div class="header_btm">
<div class="wrap">
	<div class="header_sub">
		<div class="h_menu">
			<ul>
				<li class="active"><a href="../portal/index.php">HOME</a></li> |
				<?php echo "<li><a href='index.php?var=$c&va=especificacion'>Incio</a></li> |"; ?>
				<?php echo "<li><a href='index.php?var=$c&va=catalogo'>Catálogo</a></li> |"; ?>
				
			</ul>
		</div>
		<div class="top-nav">
	          <nav class="nav">	        	
	    	    <a href="#" id="w3-menu-trigger"> </a>
	                  <ul class="nav-list" style="">
	            	        <li class="active"><a href="../portal/index.php">HOME</a></li> |
							<?php echo "<li><a href='index.php?var=$c&va=especificacion'>Incio</a></li> |"; ?>
							<?php echo "<li><a href='index.php?var=$c&va=catalogo'>Catálogo</a></li> |"; ?>
	                 </ul>
	           </nav>
	             <div class="search_box">
				<form>
				   <input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
			    </form>
			</div>
	          <div class="clear"> </div>
	          <script src="js/responsive.menu.js"></script>
         </div>		  
	<div class="clear"></div>
</div>
</div>
</div>

<div class="wrap">
<!----start-img-cursual---->
	
	<!----//End-img-cursual---->
</div>
<!-- start main1 -->
<!-- start main -->

<div class="main_bg">
<div class="wrap">	
	<div class="main">
		<!-- start grids_of_3 -->
		<!--<div class="grids_of_3">-->
			<?php 
				$sql="select * from productos where Farmacia='$c'";
				$ndf->consulta($sql);
				$d=$ndf->consulta_lista();
				if ($d>0) {
				if ($_GET["va"]=="especificacion") {
					$sql="select Id, Nombre, Foto, Precio, Oferta, Stock from productos where Oferta<>0 and Farmacia='$c' order by Nombre";
					$ndf->consulta($sql);
					$d=$ndf->consulta_lista();
					$tama=count($d);
					for ($i=0; $i < $tama; $i++) { 
						$b=$d[$i];
						$imagen=$d[$i+2];
						//echo $imagen;
              ?>
			        <div class="grids_of_3">
			        <div class="grid1_of_3">
			   <?php
						echo "<a href=''>";
						$ruta="images/".$imagen;
						//echo "$ruta";	
				?>			
							<h2><?php echo $d[$i+1]; ?></h2><br>
							<h2><?php echo "<h2>Oferta: </h2>"; ?>$<?php echo $d[$i+4]; ?></h2><br>
							<img src="<?php echo $ruta; ?>" width="400" height="250" alt=""/>
							<div class="price">
							<h4>Precio Original: $<?php echo $d[$i+3]; ?></h4>
							<h4>Stock: $<?php echo $d[$i+5]; ?></h4>
							</div>
							<span class="b_btm"></span>
						</a>
					</div>
					</div>
              <?php
              		$i=$i+5;
                	}
                }
                if ($_GET["va"]=="catalogo") {
					$sql="select Id, Nombre, Foto, Precio, Oferta, Stock from productos where Farmacia='$c' order by Nombre";
					$ndf->consulta($sql);
					$d=$ndf->consulta_lista();
					$tama=count($d);
					for ($i=0; $i < $tama; $i++) { 
						$b=$d[$i];
						$imagen=$d[$i+2];
						//echo $imagen;
              ?>
			        <div class="grids_of_3">
			        <div class="grid1_of_3">
			   <?php
						echo "<a href=''>";
						$ruta="images/".$imagen;
						//echo "$ruta";	
				?>			
							<h2><?php echo $d[$i+1]; ?></h2><br>
							<h2><?php echo "<h2>Oferta: </h2>"; ?>$<?php echo $d[$i+4]; ?></h2><br>
							<img src="<?php echo $ruta; ?>" width="400" height="250" alt=""/>
							<div class="price">
							<h4>Precio Original: $<?php echo $d[$i+3]; ?></h4>
							<h4>Stock: $<?php echo $d[$i+5]; ?></h4>
							</div>
							<span class="b_btm"></span>
						</a>
					</div>
					</div>
              <?php
              		$i=$i+5;
                	}
                }
                if ($_GET["va"]=="buscar") {
                $sql = "SELECT * FROM productos WHERE Nombre LIKE '%" .$_POST["busca"]. "%' and Farmacia='$c' ORDER BY Nombre";
				$ndf->consulta($sql);
				$d=$ndf->consulta_lista();
				if ($d>0) {
					$sql="select Id, Nombre, Foto, Precio, Oferta, Stock from productos where Nombre='" .$_POST["busca"]. "' and Farmacia='$c' order by Nombre";
					$ndf->consulta($sql);
					$d=$ndf->consulta_lista();
					$tama=count($d);
					for ($i=0; $i < $tama; $i++) { 
						$b=$d[$i];
						$imagen=$d[$i+2];
						//echo $imagen;
              ?>
			        <div class="grids_of_3">
			        <div class="grid1_of_3">
			   <?php
						echo "<a href=''>";
						$ruta="images/".$imagen;
						//echo "$ruta";	
				?>			
							<h2><?php echo $d[$i+1]; ?></h2><br>
							<h2><?php echo "<h2>Oferta: </h2>"; ?>$<?php echo $d[$i+4]; ?></h2><br>
							<img src="<?php echo $ruta; ?>" width="400" height="250" alt=""/>
							<div class="price">
							<h4>Precio Original: $<?php echo $d[$i+3]; ?></h4>
							<h4>Stock: $<?php echo $d[$i+5]; ?></h4>
							</div>
							<span class="b_btm"></span>
						</a>
					</div>
					</div>
              <?php
              		$i=$i+5;
                	}
		  		}else{
		  				echo "<script>alert('NO HAY RESULTADOS EN LA BBDD')</script>";
						echo "<script>location.href='index.php?var=$c&va=especificacion'</script>";
				   		//$text = "NO HAY RESULTADOS EN LA BBDD";	
		  		}
                }
				}else{
					echo "<br><h2>Usted no cuenta con Productos en la base de datos para esta farmacia</h2><br><br>";
				}
			 ?>
			<div class="clear"></div>
		</div>
	<!--</div>-->
</div>
</div>

<div class="footer_bg1">
<div class="wrap">
	<div class="footer">
		<!-- scroll_top_btn -->
	    <script type="text/javascript">
			$(document).ready(function() {
			
				var defaults = {
		  			containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
		 		};
				
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
		 <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
		<!--end scroll_top_btn -->
		<div class="copy">
			<p class="link">&copy;  Derechos Reservados| UTPL</p>
			<?php $ruta="images/facebook.png"; ?>
				<a href='https://www.facebook.com/'><img src="<?php echo "$ruta"; ?>" width="25" height="30"></a>
			<?php $ruta="images/twitter.jpeg"; ?>
				<a href='https://twitter.com/?lang=es/'><img src="<?php echo "$ruta"; ?>" width="25" height="30"></a>
			<?php $ruta="images/instagram.jpeg"; ?>
				<a href='https://instagram.com/'><img src="<?php echo "$ruta"; ?>" width="25" height="30"></a>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
</body>
</html>
