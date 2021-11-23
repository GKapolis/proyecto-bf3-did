<?php


if(ISSET($_POST["submit"])) {
    
    //
    //name / profesor / dia1-3 / hora 1-12 / turno 1-3

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    $name = $_POST['name'];
    if (inputVacio($name) !== false) 
    {
        header("location: ../admin.php?panel=materias&error=emptyinput");
        exit();
    }
    crearMateriasnotalldataknow($conn,$name);
    
}
else {
    header("location: ../admin.php?panel=materias");
    exit();
}


?>