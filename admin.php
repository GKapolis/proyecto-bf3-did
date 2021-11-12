<?php
session_start();
require_once 'include/errorhandling.php';
require_once 'include/panels.inc.php';
include_once 'include/dbh.inc.php';

if (isset($_SESSION["username"])) {
    
}
else {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adscripción</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/adscripcion.css">
</head>
<body>

	<div class="main-container flex-container">
		
		<div class="main-container__aside">
			<aside class="flex-container col"> 
				<h1 class="aside__title">ADSCRIPCIÓN</h1>
				
				<div class="aside__user-image-container flex-container">
					<a href="admin.php?panel=user" ><img src="images/usuario.png" alt="" class="user-image-container__image"></a>
				</div>	
				
				<p class="aside__username"><?php echo $_SESSION["username"]; ?></P>
			
				<span class="aside__span flex-container">
					<a href="admin.php?panel=user" class="links edit-user__text">EDITAR USUARIO</a>
					<img src="images/configurar.png" alt="" class="edit-user__icon">
 				</span>

				<span class="aside__span flex-container">
					<a href="admin.php?panel=profesores" class="links">PROFESORES</a>
				</span>

				<span class="aside__span flex-container">
					<a href="admin.php?panel=grupos" class="links">CLASES</a>
				</span>
			</aside>			
		</div>

		
		
		<div class="main-container__main-content">
			
			<nav class="main-content__nav flex-container">
				
				<img src="images/logo.png" alt="" class="nav__image">
				<div class="nav__text flex-container">
					<p class="nav__welcome">BIENVENIDO/A <?php echo $_SESSION["username"] ?></p>
					<a href="include/logout.inc.php" class="nav__exit">salir</a>
				</div>	
			
			</nav>

<?php


if (isset($_GET["panel"])){
    switch($_GET["panel"]){
        case "profesores" :

            if (isset($_GET['subpanel'])){
                switch($_GET['subpanel']){
                    case "modificar":
                        modifyteacherform($_GET['id']);
                        break;
                    case "borrar":
                        deleteteacher($_GET['id'],$_GET['nombre']);
                        break;
                }
            }

            createteacherformexample();
            teacherslist($conn);
            
        break;

        case "user":
            modifyuserpanel($_SESSION["username"]);
            break;

        case "grupos" :
            
         break;
    }
    

}

?>
			
		
		</div>
	
	
	</div>
	
</body>
</html>