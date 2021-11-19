<?php


if(ISSET($_POST["submit"])) {
    
    //
    //name / profesor / dia1-3 / hora 1-12 / turno 1-3

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    $name = $_POST['id'];
    $profesor = $_POST['profesor'];
    $dia1 = $_POST['dia1'];
    $dia2 = $_POST['dia2'];
    $dia3 = $_POST['dia3'];
    $turno1 = $_POST['turno1'];
    $turno2 = $_POST['turno2'];
    $turno3 = $_POST['turno3'];
    $hora1 = $_POST['hora1'];
    $hora2 = $_POST['hora2'];
    $hora3 = $_POST['hora3'];
    $hora4 = $_POST['hora4'];
    $hora5 = $_POST['hora5'];
    $hora6 = $_POST['hora6'];
    $hora7 = $_POST['hora7'];
    $hora8 = $_POST['hora8'];
    $hora9 = $_POST['hora9'];
    $hora10 = $_POST['hora10'];
    $hora11 = $_POST['hora11'];
    $hora12 = $_POST['hora12'];
    

    
    $turnos = array($turno1,$turno2,$turno3);
    $dias = array($dia1,$dia2,$dia3);

    if (inputVacio($name) !== false) 
    {
        header("location: ../admin.php?panel=grupos&error=emptyinput");
        exit();
    }
    if(inputVacio($dias) !== false){
        
        header("location: ../admin.php?panel=grupos&error=noexistedias");
        exit();

    }
    
    $horas = array();

if($dia1 == 0) {
    $hora1 = 0;
    $hora2 = 0;
    $hora3 = 0;
    $hora4 = 0;
    $horas = array($hora5,$hora6,$hora7,$hora8,$hora9,$hora10,$hora11,$hora12,$hora1,$hora2,$hora3,$hora4);
}
else{
    $horas = array($hora1,$hora2,$hora3,$hora4,$hora5,$hora6,$hora7,$hora8,$hora9,$hora10,$hora11,$hora12);
}
if($dia2 == 0) {
    $hora8 = 0;
    $hora7 = 0;
    $hora6 = 0;
    $hora5 = 0;
}
if($dia3 == 0) {
    $hora11 = 0;
    $hora12 = 0;
    $hora10 = 0;
    $hora9 = 0;
}
   
    if ((($dia1 == 0)&&(0 == $dia2))){
        rsort($horas);
    }

    $ids = conseguiridsdehorarios($conn,$turnos,$dias,$horas);

    
    actualizarmateria($conn,$name,$profesor,$ids);
    
}
else {
    header("location: ../admin.php?panel=grupos");
    exit();
}


?>