<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];
    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($name) !== false) 
    {
        header("location: ../recover.php?error=emptyinput");
        exit();
    }

    recuperarcontraseña($conn, $name);

}
else {
    header("location: ../index.php");
    exit();
}


?>