<?php


if(ISSET($_POST["submit"])) {

    $id = $_POST['id'];
    $newdata = $_POST['data'];
    $datatype = $_POST['datatype'];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($newdata) !== false) 
    {
        header("location: ../admin.php?error=emptyinput&panel=profesores&subpanel=modificar&id=".$id);
        exit();
    }
    if (nombreValido($newdata))
    {
        header("location: ../admin.php?error=nameNotValid&panel=profesores&subpanel=modificar&id=".$id);
        exit();
    }

    actualizarProfesornombreOapellido($conn,$newdata,$id,$datatype);
}
else {
    header("location: ../admin.php?panel=profesores");
    exit();
}


?>