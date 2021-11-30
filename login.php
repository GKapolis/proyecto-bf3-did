<?php
session_start();
require_once 'include/errorhandling.php';
if (isset($_SESSION["username"])) {
    header("location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/nav.css">

</head>
<body>
		<nav class="nav">
						
			<a href="index.php" class="links nav-logo-link"><img src="images/logo.png" alt="" class="nav__image"></a>
					
		</nav>

	<div class="main-container">

		<span class="main-container__encabezado">Ingrese nombre de usuario y contraseña para acceder...</span>

		<div class="main-container__form-container">

			<div class="flex-item div-candado">
				<img src="Images/Padlock_perspective_matte_s.png" alt="" class="div-candado__img-candado">
			</div>
			
			<div class="flex-item div-formulario">	
				<form action="include/login.inc.php" method="post">

					<label for="nombre">Nombre</label>
					<input type="text" name="username"  placeholder="Ingrese su nombre" id="nombre">
					
					<label for="password">Contraseña</label>
					<input type="password" name="contraseña"  placeholder="Ingrese su contraseña" id="password">
					
					<div class="flex-item form__botonera">
						<input type="submit" name="submit" value="Ingresar" class="submit">
						<span class="span-usuario"><a href="singup.php">Crear usuario</a></span>
					</div>
				
				</form>
			</div>

		</div>
		
		<span><a href="recover.php">Olvidó su contraseña?</a></span>	
	</div>	
</body>
</html>