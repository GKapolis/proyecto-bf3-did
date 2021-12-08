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
            
        <div class="login-container flex-container col">
            
        	<span class="login-span">ingrese sus datos para recuperarlos</span>
            
            <div class="login-container__form-container">
            
                <div class="div-candado">
                    <img src="Images/Padlock_perspective_matte_s.png" alt="" class="div-candado__img-candado">
                </div>
                        
				<div class="div-formulario">	
					<form action="include/recover.inc.php" method="post" class="login-form">
					
					<label for="nombre">Nombre o Correo</label>
					<input type="text" name="username"  placeholder="Ingrese su nombre" id="nombre" class="login-input">

						<div class="login-form__buttons">
							<input type="submit" name="submit" value="Recuperar" class="login-submit blue-text" class="login-input">
							<span class="login-span span-user"><a href="login.php" class="blue-text">Volver</a></span>
						</div>
				
					</form>
				</div>

		</div>
		
		
	</div>	
</body>
</html>