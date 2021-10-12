<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="es" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title> Sistema de administracion de horarios del consejo de educacion secundaria </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                <img src="Images/logo.png" width="260" height="30" class="d-inline-block align-text-top">
                </a>
                <?php
                        if (isset($_SESSION["username"])) {
                            echo "</li>
                            <a class=\"nav-link\">". $_SESSION["username"] ."</a>
                            </li>";
                            switch($_SESSION["acceslevel"]) {
                                case 1:
                                    echo "<a class=\"nav-link\" href=\"admin.php\">Panel de reporte</a>";
                                    break;
                                default:
                                    echo "<a class=\"nav-link\" href=\"admin.php\">Panel de control</a>";
                                    break;
                            }
                            echo "<li class=\"nav-item\">
                            <a class=\"nav-link\" href=\"include/logout.inc.php\">Desconectarse</a>
                            </li>";
                        }
                ?>
            </div>
        </nav>
    </div>