<?php
include_once 'header.php';
require_once 'include/errorhandling.php';
require_once 'include/panels.inc.php';
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

<?php
include_once 'footer.php'
?>