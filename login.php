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
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
		<nav class="nav">
						
			<a href="index.php" class="links nav-logo-link"><img src="images/logo.png" alt="" class="nav__image"></a>
					
		</nav>

	<div class="login-container flex-container col">

		<span class="login-span">Ingrese nombre de usuario y contraseña para acceder...</span>

		<div class="login-container__form-container">

			<div class="div-candado">
				<img src="Images/Padlock_perspective_matte_s.png" alt="" class="div-candado__img-candado">
			</div>
			
			<div class="div-formulario">	
				<form action="include/login.inc.php" method="post" class="login-form">

					<label for="nombre">Nombre</label>
					<input type="text" name="username"  placeholder="Ingrese su nombre" id="nombre" class="login-input">
					
					<label for="password">Contraseña</label>
					<input type="password" name="contraseña"  placeholder="Ingrese su contraseña" id="password" class="login-input">
					
					<div class="login-form__buttons">
						<input type="submit" name="submit" value="Ingresar" class="login-submit blue-text" class="login-input">

						<span class="login-span span-user"><a href="singup.php" class="blue-text">Crear usuario</a></span>
					</div>
				
				</form>
			</div>

		</div>
		
		<span class="login-span"><a href="recover.php">Olvidó su contraseña?</a></span>	
	</div>	
</body>
</html>