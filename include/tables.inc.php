<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];
    $level = $_POST["access_level"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (emptyInputLogin($name,$level) !== false) 
    {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    updateuserlevel($conn,$name,$level);

}
else {
    header("location: ../admin.php");
    exit();
}


?>