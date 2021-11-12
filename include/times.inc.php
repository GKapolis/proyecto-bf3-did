<?php


if(ISSET($_POST["submit"])) {

    $horainicial = $_POST["horario"];
    $horafinal = $_POST["horario2"];
    $turno = $_POST["turno"];
    $horautu = $_POST["hora"];
    $dia = $_POST["dia"];
    $accion = $_POST["action"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.php';

    switch($accion) {
        case 1:
            if (registroFormDatoVacio($horainicial,$horainicial,$turno,$horautu) !== false) 
            {
                header("location: ../test.php?error=emptyinput");
                exit();
            }
            if (revisarExistenciaDelHorario($conn, $turno, $horautu, $dia)){
                header("location: ../test.php?error=nameORemailTaken");
                exit();
            }
            if (compararhorarios($horainicial, $horafinal)){
                header("location: ../test.php?error=biggerA");
                exit();
            }

            crearHorarios($conn,$horainicial,$horafinal,$turno,$horautu, $dia);
            break;
        case 2:
            if (registroFormDatoVacio($horainicial,$horainicial,$turno,$horautu) !== false) 
            {
                header("location: ../test.php?error=emptyinput");
                exit();
            }

            actualizarHorario($conn,$horainicial,$horafinal,$turno,$horautu, $dia);
            break;
        case 3:
            if (inputVacio($turno) !== false) 
            {
                header("location: ../test.php?error=emptyinput");
                exit();
            }
            if (inputVacio($horautu) !== false) 
            {
                header("location: ../test.php?error=emptyinput");
                exit();
            }

            borrarHorario($conn,$turno,$horautu, $dia);
            break;
    }

}
else {
    header("location: ../login.php");
    exit();
}


?>