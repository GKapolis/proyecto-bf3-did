<?php


if(ISSET($_POST["submit"])) {
    $group = $_POST["Grupo"];
    $materia = $_POST["materia"];
    $profesor = $_POST["profesor"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if($profesor == 0){
        $profesor = NULL;
    }
    

    actualziarprofesorenclase($conn,$profesor,$group,$materia);

}
else {
	header("location: ../admin.php?panel=grupos");
	exit();
}



?>