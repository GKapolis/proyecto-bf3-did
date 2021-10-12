<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];
    $pwd = $_POST["contraseña"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (emptyInputLogin($name,$pwd) !== false) 
    {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginuser($conn, $name, $pwd);

}
else {
    header("location: ../index.php");
    exit();
}


?>