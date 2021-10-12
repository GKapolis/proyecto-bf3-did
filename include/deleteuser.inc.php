<?php


if(ISSET($_POST["submit"])) {
    $name = $_POST["username"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (emptyInputLogin($name,$name) !== false) 
    {
        header("location: ../admin.php?error=emptyinput");
        exit();
    }

    deleteuser($conn,$name);

}
else {
    header("location: ../admin.php");
    exit();
}


?>