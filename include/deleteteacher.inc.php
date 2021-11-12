<?php

if(ISSET($_GET["id"])) {
    
    $id = $_GET["id"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    borrarProfesor($conn,$id);
}
else {
    header("location: ../admin.php?panel=profesores");
    exit();
}

?>
