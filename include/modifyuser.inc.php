<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["name"];
    $datatype = $_POST["data_type"];
    $newname = $_POST["new_data"];
    $contraseña = $_POST["contraseña"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($newname) !== false) 
    {
        header("location: ../admin.php?error=emptyinput&panel=user");
        exit();
    }
    if (inputVacio($contraseña) !== false) 
    {
        header("location: ../admin.php?error=emptyinputs&panel=user");
        exit();
    }

    actualizarUser($conn,$name,$newname,$datatype,$contraseña);

}
else {
    header("location: ../admin.php");
    exit();
}


?>