<?php

function createuserform() {
    echo
    "
        <h2 class=\"text-info\">aqui podes registrar usuarios</h2>
        <form action=\"singup.inc.php\" method=\"post\">
            <input type=\"text\" name=\"username\" placeholder=\"inserte nombre de usuario\">
            <input type=\"password\" name=\"contraseña\" placeholder=\"inserte contraseña\">
            <input type=\"password\" name=\"contraseña-repeat\" placeholder=\"reinserte contraseña\">
            <br>
            <input type=\"radio\" id=\"html\" name=\"access_level\" value=\"1\">
            <label for=\"html\" class=\"text-info bg-dark\">Profesor</label><br>
            <input type=\"radio\" id=\"css\" name=\"access_level\" value=\"2\">
            <label for=\"css\" class=\"text-info bg-dark\">Adscripta</label><br>
            <input type=\"radio\" id=\"javascript\" name=\"access_level\" value=\"3\">
            <label for=\"javascript\" class=\"text-info bg-dark\">Administracion</label><br>

            <button type=\"submit\" name=\"submit\">Registrar</button>
        </form>
    </section>";
}
function modifyuserform() {
    
    echo 
    "<section class=\"bg-dark\">
        <h2 class=\"text-info\">aqui podes modificar usuarios</h2>
        <form action=\"modifyuser.inc.php\" method=\"post\">
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

}

function deleteuserform() {
    
    echo "<section class=\"bg-dark\">
    <h2 class=\"text-info\">aqui podes borrar usuarios</h2>
        <form action=\"deleteuser.inc.php\" method=\"post\">
            <input type=\"text\" name=\"username\" placeholder=\"inserte nombre de usuario\">
            <br>
            <button type=\"submit\" name=\"submit\">Borrar</button>
        </form>
    </section>";
}

function sysadminpanels() {

}

?>