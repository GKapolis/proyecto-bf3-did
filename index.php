<?php
session_start();
include_once "include/panels.inc.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagina Princial</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="bedelia.css">
</head>
<body>
	<nav>
		<img src="images/logo.png" alt="" class="nav__img-logo">
		<h1 class="nav-title"><a href="login.php">BEDELIA</a></h1>
	</nav>
	
	<section class="banner">
		<img src="Images/utu.jpg" alt="" class="banner__utu-image">
		
		<div class="banner__content banner__right-arrow">
			<a href="" class="banner__links"><img src="Images/flecha-derecha.png" alt=""></a>
		</div>

		<div class="banner__content banner__title">
			<h1>BIENVENIDOS</h1>
			<h2>AL NUEVO AÑO ESTUDIANTIL 2021.</h2>
		</div>	
		
		<div class="banner__content banner__left-arrow">
			<a href="" class="banner__links"><img src="Images/flecha-izquierda.png" alt=""></a>
		</div>	
	</section>

	<?php
	listadegrupos($conn);
	?>
	
</body>
</html>