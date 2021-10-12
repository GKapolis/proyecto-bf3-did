<?php



if(ISSET($_POST["submit"])) {
    
    $name = $_POST["username"];
    $level = $_POST["access_level"];
    $contraseña = $_POST["contraseña"];
    $contraseñarepeat = $_POST["contraseña-repeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (emptyInputRegistro($name,$level,$contraseña,$contraseñarepeat) !== false) 
    {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }
    if (invalidName($name))
    {
        header("location: ../admin.php?error=nameNotValid");
        exit();
    }
    if (invalidLevel($level))
    {   
        header("location: ../admin.php?error=emailNotValid");
        exit();
    }
    if (passnotmatch($contraseña, $contraseñarepeat)){
        header("location: ../admin.php?error=passwordNotMatch");
        exit();
    }
    if (uidexists($conn, $name, $level)){
        header("location: ../admin.php?error=nameORemailTaken");
        exit();
    }

    createUser($conn, $name, $level, $contraseña);
    
}
else {
    header("location: ../admin.php");
    exit();
}


?>