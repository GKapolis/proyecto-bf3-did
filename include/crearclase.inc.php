<?php


if(ISSET($_POST["submit"])) {
    $group = $_POST["Grupo"];
    $materia = $_POST["materias"];
    $profesor = $_POST["profesor"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (revisarExistenciaDelaClase($conn,$group,$materia)){
        header("location: ../admin.php?panel=clases&error=classalreadyexist&idGrupo=".$group);
        exit();
    }

    crearclase($conn,$group,$materia,$profesor);

}
else {
	header("location: ../admin.php?panel=grupos");
	exit();
}



?>