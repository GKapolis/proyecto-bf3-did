<?php


if(ISSET($_POST["submit"])) {
    
    //
    //name / profesor / dia1-3 / hora 1-12 / turno 1-3

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    $nombregrupo = $_POST["grupo"];
    $nombrelargogrupo = $_POST["fullgrupo"];
    
    if (inputVacio($nombregrupo) !== false) 
    {
        header("location: ../admin.php?panel=grupos&error=emptyinput");
        exit();
    }
    if (inputVacio($nombrelargogrupo) !== false) 
    {
        header("location: ../admin.php?panel=grupos&error=emptyinput");
        exit();
    }
    crearGroup($conn,$nombregrupo,$nombrelargogrupo);
    
}
else {
    header("location: ../admin.php?panel=grupos");
    exit();
}


?>