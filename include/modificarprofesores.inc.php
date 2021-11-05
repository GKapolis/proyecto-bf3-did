<?php


if(ISSET($_POST["submit"])) {

    $id = $_POST['id'];
    $newdata = $_POST['data'];
    $datatype = $_POST['datatype'];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($newdata) !== false) 
    {
        header("location: ../test.php?error=emptyinput");
        exit();
    }
    if (nombreValido($newdata))
    {
        header("location: ../test.php?error=nameNotValid");
        exit();
    }

    actualizarProfesornombreOapellido($conn,$newdata,$id,$datatype);
}
else {
    header("location: ../test.php");
    exit();
}


?>