<?php
include_once 'header.php';
require_once 'include/errorhandling.php';
require_once 'include/panels.inc.php';
if (isset($_SESSION["username"])) {
    echo "<section class=\"bg-dark\">
    <h1 class=\"text-primary\">Bienvenido ". $_SESSION["accesname"] ." ". $_SESSION["username"] ."</h1>
    ";
}
else {
    header("location: index.php");
    exit();
}
?>

<?php
        switch($_SESSION["acceslevel"]){
            case 1:
                echo "<h2 class=\"text-warning\">PLACEHOLDER PROF</h2>";
                break;
            case 2:
                echo "<h2 class=\"text-warning\">PLACEHOLDER ADS</h2>";
                break;
            case 3:
                createuserform();
                break;
            case 4:

                echo
                "<section class=\"bg-dark\">
                    <h2 class=\"text-info\">aqui podes registrar usuarios</h2>
                    <form action=\"include/singup.inc.php\" method=\"post\">
                        <input type=\"text\" name=\"username\" placeholder=\"inserte nombre de usuario\">
                        <input type=º\"password\" name=\"contraseña\" placeholder=\"inserte contraseña\">
                        <input type=\"password\" name=\"contraseña-repeat\" placeholder=\"reinserte contraseña\">
                        <br>
                        <input type=\"radio\" id=\"html\" name=\"access_level\" value=\"1\">
                        <label for=\"html\" class=\"text-info bg-dark\">Profesor</label><br>
                        <input type=\"radio\" id=\"css\" name=\"access_level\" value=\"2\">
                        <label for=\"css\" class=\"text-info bg-dark\">Adscripta</label><br>
                        <input type=\"radio\" id=\"javascript\" name=\"access_level\" value=\"3\">
                        <label for=\"javascript\" class=\"text-info bg-dark\">Administracion</label><br>
                        <input type=\"radio\" id=\"4\" name=\"access_level\" value=\"4\">
                        <label for=\"4\" class=\"text-info bg-dark\">Sistema</label><br>

                        <button type=\"submit\" name=\"submit\">Registrar</button>
                    </form>
                </section>";

                echo 
                "<section class=\"bg-dark\">
                    <h2 class=\"text-info\">aqui podes modificar usuarios</h2>
                    <form action=\"include/modifyuser.inc.php\" method=\"post\">
                        <input type=\"text\" name=\"username\" placeholder=\"inserte nombre de usuario\">
                        <br>

                        <input type=\"radio\" id=\"html\" name=\"access_level\" value=\"1\">
                        <label for=\"html\" class=\"text-info bg-dark\">Profesor</label><br>
                        <input type=\"radio\" id=\"css\" name=\"access_level\" value=\"2\">
                        <label for=\"css\" class=\"text-info bg-dark\">Adscripta</label><br>
                        <input type=\"radio\" id=\"javascript\" name=\"access_level\" value=\"3\">
                        <label for=\"javascript\" class=\"text-info bg-dark\">Administracion</label><br>

                        <button type=\"submit\" name=\"submit\">Modificar</button>
                    </form>
                </section>";

                echo "<section class=\"bg-dark\">
                <h2 class=\"text-info\">aqui podes borrar usuarios</h2>
                    <form action=\"include/deleteuser.inc.php\" method=\"post\">
                        <input type=\"text\" name=\"username\" placeholder=\"inserte nombre de usuario\">
                        <br>
                        <button type=\"submit\" name=\"submit\">Borrar</button>
                    </form>
                </section>";

                echo "<section class=\"bg-dark\">
                <h2 class=\"text-info\">aqui podes agregar horarios al sistema</h2>
                    <form action=\"include/times.inc.php\" method=\"post\">
                    <input type=\"time\" id=\"appt\" name=\"appt\"required>
                    </form>
                </section>";

                echo "<section class=\"bg-dark\">
                <h2 class=\"text-info\">aqui podes modificar tablas</h2>
                    <form action=\"include/tables.inc.php\" method=\"post\">
                    </form>
                </section>";

                break;
        }
?>

<?php
include_once 'footer.php'
?>