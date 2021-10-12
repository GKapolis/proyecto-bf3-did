<?php
include_once 'header.php'
?>

<?php
            if (isset($_SESSION["username"])) {
            echo "<h1>Bienvenido ". $_SESSION["accesname"] ." ". $_SESSION["username"] ."</h1>";
            }
            else {
                require_once 'include/errorhandling.php';
                echo "<section class=\"index-intro\">
                    <h2 class=\"text-info\">aqui podes ingresar</h2>
                    <form action=\"include/login.inc.php\" method=\"post\">
                        <input type=\"text\" name=\"username\" placeholder=\"inserte nombre de usuario o correo registrado\">
                        <input type=\"password\" name=\"contraseña\" placeholder=\"inserte contraseña\">
                        <button type=\"submit\" name=\"submit\">Ingresar</button>
                    </form>
                </section>";
                }
                ?>

<?php
include_once 'footer.php'
?>