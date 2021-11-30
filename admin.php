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
	<link rel="stylesheet" href="css/grupos.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/materias.css">
	<link rel="stylesheet" href="css/aside.css">
</head>
<body>

	
<nav class="nav">
				
				<a href="index.php" class="links nav-logo-link"><img src="images/logo.png" alt="" class="nav__image"></a>
					
				<div class="nav__text">
					<p class="nav__welcome">BIENVENIDO/A <?php echo $_SESSION["username"]; ?></p>
					<a href="include/logout.inc.php" class="links nav__exit">salir</a>
				</div>	
					
			</nav>
		
			<aside class="aside"> 
				<h1 class="aside__title">ADSCRIPCIÓN</h1>
				
				
				<div class="user-image-container">		
					<img src="images/usuario.png" class="aside__user-image">	
				</div>		
			
				<p class="aside__username"><?php echo $_SESSION["username"]; ?></P>
		
				<div class="edit-user-container">
					<span class="aside__span">
						<a href="admin.php?panel=user" class="links edit-user__text">EDITAR USUARIO</a>
					 </span>
					 <img src="images/configurar.png" class="edit-user__icon">
				 </div>
				
				<span class="aside__span">
					<a href="admin.php?panel=profesores" class="links">PROFESORES</a>
				</span>
		
				<span class="aside__span">
					<a href="admin.php?panel=materias" class="links">MATERIAS</a>
				</span>
		
				<span class="aside__span">
					<a href="admin.php?panel=grupos" class="links">CLASES</a>
				</span>
			</aside>	

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
            modifyuserpane2($_SESSION["username"]);
            break;

        case "grupos" :


            if (isset($_GET['subpanel'])){
                switch($_GET['subpanel']){
                }
            }
			
            creategrupoformulario();
            groupslistadmin($conn);
			

        break;
		case "clases":
            if (isset($_GET['subpanel'])){
                switch($_GET['subpanel']){

                }
            }
			createclase($conn,$_GET['idGrupo']);
			break;
		case "materias":
            if (isset($_GET['subpanel'])){
                switch($_GET['subpanel']){
                    case "modificar":
                        modifymateriaform($_GET['id']);
                        break;
                }
            }

			createmateriaformulario();
			materiaslistadmin($conn);
		break;
		
		case "materiaenclase":
            if (isset($_GET['subpanel'])){
                switch($_GET['subpanel']){
					case "profesor":
						updateclassform($conn,$_GET["idMateria"],$_GET["idGrupo"]);
						break;
					case "horario":
						editmateriahorario($conn,$_GET["idMateria"],$_GET["idGrupo"]);
						break;
                }
            }

		break;



    }
    

}

?>
			
		
		</div>
	
	
	</div>
	
</body>
</html>