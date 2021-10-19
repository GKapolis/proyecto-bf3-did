<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];
    $pwd = $_POST["contraseña"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($name) !== false) 
    {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    if (inputVacio($pwd) !== false) 
    {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    ingresarUser($conn, $name, $pwd);

}
else {
    header("location: ../login.php");
    exit();
}


?>