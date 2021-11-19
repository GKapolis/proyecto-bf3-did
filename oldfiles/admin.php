<?php
include_once 'header.php';
require_once 'include/errorhandling.php';
require_once 'include/panels.inc.php';
include_once 'include/dbh.inc.php';

if (isset($_SESSION["username"])) {
    echo "<section class=\"bg-dark\">
    <h1 class=\"text-primary\">Bienvenido ". $_SESSION["username"] ."</h1>
    ";
}
else {
    header("location: index.php");
    exit();
}
?>

<div class="main-container__aside">
			<aside class="flex-container col"> 
				<h1 class="aside__title">ADSCRIPCIÓN</h1>
				
				<div class="aside__user-image-container flex-container">
					<img src="images/usuario.png" alt="" class="user-image-container__image">
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

<?php

if (isset($_GET["subpanel"])){

}

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
            modifyuserpanel($_SESSION);
            break;

        case "grupos" :
            if (isset($_GET['subpanel'])){
                switch($_GET['subpanel']){
                    case "modificar":
                        modifyteacherform($_GET['id']);
                        break;
                    case "borrar":
                        modifyteacherform($_GET['id']);
                        break;
                }
            }

            createmateriaformexample($conn);
         break;
    }
    

}

?>

<?php
include_once 'footer.php'
?>