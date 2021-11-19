<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="es" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title> Sistema de administracion de horarios del consejo de educacion secundaria </title>
    </head>

    <body>
        <nav>
                º
                <img src="Images/logo.png" class="nav__img-logo">
                
                <?php
                        if (isset($_SESSION["username"])) {
                            echo "
                            <a class=\"nav-title\">". $_SESSION["username"] ."</a>
                            ";
                            
                            echo "
                            <a class=\"nav-title\" href=\"admin.php\">Panel de control</a>
                            ";
                            
                            
                            echo "
                            <a class=\"nav-title\" href=\"include/logout.inc.php\">Salir</a>
                            ";
                        }
                        else{

                            echo "
                            <h1 class=\"nav-title\"><a class=\"nav-tittle\" href=\"login.php\">BEDELIA</a></h1>
                            ";

                        }
                ?>
            
        </nav>
    </div>