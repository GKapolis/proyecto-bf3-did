<?php


if(ISSET($_POST["submit"])) {
    
    $id = $_POST["id"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    borrarProfesor($conn,$id);
}
else {
    header("location: ../admin.php");
    exit();
}


?>