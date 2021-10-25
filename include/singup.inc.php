<?php



if(ISSET($_POST["submit"])) {
    
    $username = $_POST["username"];
    $name = $_POST["name"];
    $correo = $_POST["email"];
    $contraseña = $_POST["contraseña"];
    $contraseñarepeat = $_POST["contraseña-repeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.php';

    if (registroFormDatoVacio($name,$correo,$contraseña,$contraseñarepeat) !== false) 
    {
        header("location: ../singup.php?error=emptyinput");
        exit();
    }
    if (inputVacio($username) !== false) 
    {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    if (nombreValido($username))
    {
        header("location: ../singup.php?error=nameNotValid");
        exit();
    }
    if (nombreValido($name))
    {
        header("location: ../singup.php?error=nameNotValid");
        exit();
    }
    if (correoValido($correo))
    {
        header("location: ../singup.php?error=emailNotValid");
        exit();
    }
    if (contraseñaNoIgual($contraseña, $contraseñarepeat)){
        header("location: ../singup.php?error=passwordNotMatch");
        exit();
    }
    if (revisarExistenciaDelUsuario($conn, $name, $correo)){
        header("location: ../singup.php?error=nameORemailTaken");
        exit();
    }

    crearUser($conn,$username, $name, $correo, $contraseña);
    
}
else {
    header("location: ../singup.php");
    exit();
}


?>