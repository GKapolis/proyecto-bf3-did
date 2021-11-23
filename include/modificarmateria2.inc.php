<?php


if(ISSET($_POST["submit"])) {
    
    //
    //name / profesor / dia1-3 / hora 1-12 / turno 1-3

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    if (inputVacio($name) !== false) 
    {
        header("location: ../admin.php?panel=materias&error=emptyinput");
        exit();
    }
    actualizarMaterias($conn,$id,$name);
    
}
else {
    header("location: ../admin.php?panel=materias");
    exit();
}


?>