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
            
                    <span class="main-container__encabezado">ingrese sus datos para recuperarlos</span>
            
                    <div class="main-container__form-container">
            
                        <div class="flex-item div-candado">
                            <img src="Images/Padlock_perspective_matte_s.png" alt="" class="div-candado__img-candado">
                        </div>
                        
			<div class="flex-item div-formulario">	
				<form action="include/recover.inc.php" method="post">
                <input type="text" name="username" placeholder="inserte nombre de usuario o correo registrado">
                
					<div class="flex-item form__botonera">
						<input type="submit" name="submit" value="Ingresar" class="submit">
                    </div>
				
				</form>
			</div>

		</div>
		
		
	</div>	
</body>
</html>