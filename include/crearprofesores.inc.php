<?php


if(ISSET($_POST["submit"])) {
    
    $name = $_POST["name"];
    $surname = $_POST["surname"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($name) !== false) 
    {
        header("location: ../admin.php?error=emptyinput&panel=profesores");
        exit();
    }
    if (nombreValido($name))
    {
        header("location: ../admin.php?error=nameNotValid&panel=profesores");
        exit();
    }
    if (inputVacio($surname) !== false) 
    {
        header("location: ../admin.php?error=emptyinput&panel=profesores");
        exit();
    }
    if (nombreValido($surname))
    {
        header("location: ../admin.php?error=nameNotValid&panel=profesores");
        exit();
    }

    crearProfesor($conn,$name,$surname);
}
else {
    header("location: ../admin.php?panel=profesores");
    exit();
}


?>