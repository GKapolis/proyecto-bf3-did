<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];
    $datatype = $_POST["data_type"];
    $newname = $_POST["new_data"];
    $contraseña = $_POST["contraseña"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($newname) !== false) 
    {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }
    if (inputVacio($contraseña) !== false) 
    {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    actualizarUser($conn,$name,$newname,$datatype,$contraseña);

}
else {
    header("location: ../admin.php");
    exit();
}


?>