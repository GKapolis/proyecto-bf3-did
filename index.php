<?php
session_start();
include_once "include/panels.inc.php";
include_once "include/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagina Princial</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<nav class="nav">
		<img src="images/logo.png" alt="" class="nav__img-logo">
		<a href="login.php" class="links nav__exit">BEDELIA</a>
	</nav>
	
	<section class="banner">
		<img src="Images/utu.jpg" alt="" class="banner__utu-image">
		
		<div class="banner__content banner__right-arrow">
			<a href="" class="banner__links"><img src="Images/flecha-derecha.png" alt=""></a>
		</div>

		<div class="banner__content banner__title">
			<p class="white-text font-24">BIENVENIDOS</p>
			<p class="white-text font-18">AL NUEVO AÑO ESTUDIANTIL 2021.</p>
		</div>	
		
		<div class="banner__content banner__left-arrow">
			<a href="" class="banner__links"><img src="Images/flecha-izquierda.png" alt=""></a>
		</div>	
	</section>

	<section class="card-section">

		<?php 
		listadegrupos($conn);
		?>

	</section>
</body>
</html>