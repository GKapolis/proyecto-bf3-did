<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];
    $level = $_POST["access_level"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (inputVacio($name) !== false) 
    {
        header("location: ../recover.php?error=emptyinput");
        exit();
    }

    

}
else {
    header("location: ../admin.php");
    exit();
}


?>