<!DOCTYPE html>
<html lang="es">
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
        
            <div class="login-container flex-container colr">
        
                <span class="login-span">Ingrese los datos para registrar su usuario...</span>
        
                <div class="login-container__form-container">
        
                    <div class="div-candado">
                        <img src="Images/Padlock_perspective_matte_s.png" alt="" class="div-candado__img-candado">
                    </div>
                    
                    <div class="div-formulario">	

                <form action="include/singup.inc.php" method="post" class="login-form">

					<label for="nombre">Nombre de usuario:</label>
					<input type="text" name="username"  placeholder="Ingrese su nombre" id="nombre" class="login-input">

                    <label for="nombre2">Nombre:</label>
                    <input type="text" name="name" placeholder="inserte su nombre"  id="nombre2" class="login-input">

                    <label for="nombre3">Correo:</label>
                    <input type="text" name="email" placeholder="inserte correo" id="nombre3" class="login-input">

                    <label for="nombre4">Contraseña:</label>
                    <input type="password" name="contraseña" placeholder="inserte contraseña" id="nombre4" class="login-input">

                    <label for="nombre5">Confirmacion de Contraseña:</label>
                    <input type="password" name="contraseña-repeat" placeholder="reinserte contraseña" id="nombre5" class="login-input">

                    <div class="login-form__buttons">
							<input type="submit" name="submit" value="Registrarse" class="login-submit blue-text" class="login-input">
							<span class="login-span span-user"><a href="login.php" class="blue-text">Volver</a></span>
                    </div>
				
				</form>
			</div>

		</div>
		
		
	</div>	

        
</body>
</html>