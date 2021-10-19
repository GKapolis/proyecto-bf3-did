<?php



/* 
 revisa que el formulario de registro no este vacio al momento de enviar los datos al servidor
*/
function registroFormDatoVacio($Nombre,$email,$contraseña,$contraseñarepeat) {
    
    if (empty($Nombre) || empty($email) || empty($contraseña) || empty($contraseñarepeat) ) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

/*
 revisa que el nombre dado al sistema sea uno valido
*/
function nombreValido($Nombre) 
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $Nombre)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
/*
revisa que el correo sea valido
*/
function correoValido($email) 
{
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

/*
 revisa la contraseña y su confirmacion sean la misma
*/

function contraseñaNoIgual($contraseña, $contraseñarepeat){
    
    if ($contraseña !== $contraseñarepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

/*
 revisa que el campo no sea vacios
*/

function inputVacio($Nombre) {
    if (empty($Nombre)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//  termina seccion de funciones comunes
//
//
//          ####                    #####      
//          ####                    #####           
//          #####                   #####        
//          #####                   #####
//          #####                   #####
//           ####                  ####
//           ####                  ####
//            ###                 ###
//              #####          #####
//                ######    ######
//                  ###########
//                    #######
//
// comienza seccion de usuarios


/*
revisa que en escencia el usuario al que se haga referencia exista en la base de datos 
para ese fin usa el nombre de usuario o su correo dados que estos deberian ser unicos para los usuarios
*/
function revisarExistenciaDelUsuario($conn, $Nombre, $email){
    $sql = "SELECT * FROM usuarios where NOMBREusuarios = ? OR CORREOusuarios = ?;"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $Nombre,$email);
    mysqli_stmt_execute($stmt);

    $resultdata = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultdata)){
        return $row;
    }
    else {
        $result = false;    
        return $result;
    }

    mysqli_stmt_close($stmt);
}

/*
 actualiza los datos de un usuario y cambia algun dato de su eleccion a su peticion
*/
function actualizarUser($conn,$username,$newdata,$newdataType,$contraseña){

    $usurexits = revisarExistenciaDelUsuario($conn, $username, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $pwdHashed = $usurexits["CONSTRASEÑAusuarios"];
    $pwdverify = password_verify($contraseña, $pwdHashed);

    if ($pwdverify === false) {
        header("location: ../admin.php?error=wronglogin");
        exit();
    }
    else {

        
        switch($newdataType) {
            case "CONSTRASEÑAusuarios":
                $newdata = password_hash($newdata, PASSWORD_DEFAULT);
                break;
            case "CORREOusuarios":
                if (correoValido($newdata))
                    {
                        header("location: ../admin.php?error=emailNotValid");
                        exit();
                    }
                break;
        }

        $sql = "UPDATE usuarios SET " . $newdataType . " = ? WHERE NOMBREusuarios= ?"; 
        $stmt = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../admin.php?error=CouldNotConnect");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $newdata, $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../admin.php?error=userModfied");
    }


}
/*
 crear el usuario y lo inserta en la base de datos
*/
function crearUser($conn, $Nombre, $email, $contraseña){
    $sql = "INSERT INTO usuarios (NOMBREusuarios, CONSTRASEÑAusuarios, CORREOusuarios) VALUES (?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    $hashedpwd = password_hash($contraseña, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $Nombre, $hashedpwd, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $tema = "registro";
    $mensaje = "gracias " . $Nombre . " por registrarte";
    $mensaje = wordwrap($mensaje, 70, "\r\n");

    mail($email,$tema,$mensaje);

    header("location: ../index.php?error=userCreated");
}
/*
 ingresa un usuario a la pagina
*/
function ingresarUser($conn, $username, $pwd) {


    $usurexits = revisarExistenciaDelUsuario($conn, $username, $username);
    

    if ($usurexits === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $usurexits["CONSTRASEÑAusuarios"];
    $pwdverify = password_verify($pwd, $pwdHashed);

    if ($pwdverify === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else {
        session_start();
        $_SESSION["username"] = $usurexits["NOMBREusuarios"];
        header("location: ../admin.php");
        exit();
    }

}
/*
 manda una nueva contraseña al usuario a su correo
*/
function recuperarcontraseña($conn, $username) {

    $usurexits = revisarExistenciaDelUsuario($conn, $username, $username);

    if ($usurexits === false) {
        header("location: ../recover.php?error=wronglogin");
        exit();
    }

    $sql = "UPDATE usuarios SET CONSTRASEÑAusuarios= ? WHERE NOMBREusuarios= ? OR CORREOusuarios = ?;"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }
    $digito1 = rand(0,9);
    $digito2 = rand(0,9);
    $digito3 = rand(0,9);
    $digito4 = rand(0,9);
    $contraseña = $digito1 . $digito2 . $digito3 . $digito4;
    $newpassword = password_hash($contraseña, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $newpassword, $username, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $tema = "clave perdida";
    $Nombre = $usurexits["NOMBREusuarios"];
    $email = $usurexits["CORREOusuarios"];
    $mensaje = "lo sentimos tanto " . $Nombre . " que hayas perdido tu contraseña.\npor eso mismo hemos cambiado temporalmente su clave a ". $contraseña .".\n\n\ncuando tenga la oportunidad cambiela a otra mas segura";
    $mensaje = wordwrap($mensaje, 70, "\r\n");

    mail($email,$tema,$mensaje);

    header("location: ../login.php?error=passwordSent");

    

}
/*
 borra un usuario del sistema
*/
function borrarUser($conn,$username){

    $usurexits = revisarExistenciaDelUsuario($conn, $username, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "DELETE FROM usuarios WHERE NOMBREusuarios= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userDeleted");

}


?>