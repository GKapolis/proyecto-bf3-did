<!DOCTYPE html>
<html lang="es">
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
        
                <span class="main-container__encabezado">Ingrese los datos para registrar su usuario...</span>
        
                <div class="main-container__form-container">
        
                    <div class="flex-item div-candado">
                        <img src="Images/Padlock_perspective_matte_s.png" alt="" class="div-candado__img-candado">
                    </div>
                    
                    <div class="flex-item div-formulario">	

                <form action="include/singup.inc.php" method="post">
                    <label for="nombre">Nombre de usuario</label>
                    <input type="text" name="username" placeholder="inserte nombre de usuario" id="nombre">
                    <label for="nombre2">Nombre</label>
                    <input type="text" name="name" placeholder="inserte su nombre"  id="nombre2">
                    <label for="nombre3">Correo</label>
                    <input type="text" name="email" placeholder="inserte correo" id="nombre3">
                    <label for="nombre4">Contraseña</label>
                    <input type="password" name="contraseña" placeholder="inserte contraseña" id="nombre4">
                    <label for="nombre5">Confirmacion de Contraseña</label>
                    <input type="password" name="contraseña-repeat" placeholder="reinserte contraseña" id="nombre5">
                    <div class="flex-item form__botonera">
						<input type="submit" name="submit" value="Ingresar" class="submit">
                    </div>
				
				</form>
			</div>

		</div>
		
		
	</div>	

        
</body>
</html>