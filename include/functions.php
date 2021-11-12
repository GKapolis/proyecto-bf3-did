<?php



/* 
 revisa que el formulario de registro no este vacio al momento de enviar los datos al servidor
*/
function registroFormDatoVacio($Nombre,$email,$clave,$contraseñarepeat) {
    
    if (empty($Nombre) || empty($email) || empty($clave) || empty($contraseñarepeat) ) {
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
 revisa la clave y su confirmacion sean la misma
*/

function contraseñaNoIgual($clave, $contraseñarepeat){
    
    if ($clave !== $contraseñarepeat) {
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

function compararhorarios($horainicial,$horafinal) {
    if ($horainicial >= $horafinal) {
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
//          |##\              /##|
//          |###\            /###|
//          |###|            |###|
//          |###\            /###|
//          \####\_       __/####/
//            \####\_____/#####/
//              \##########/
//                \######/
//
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
function actualizarUser($conn,$username,$newdata,$newdataType,$clave){

    $usurexits = revisarExistenciaDelUsuario($conn, $username, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $pwdHashed = $usurexits["CLAVEusuarios"];
    $pwdverify = password_verify($clave, $pwdHashed);

    if ($pwdverify === false) {
        header("location: ../admin.php?error=wronglogin");
        exit();
    }
    else {

        
        switch($newdataType) {
            case "CLAVEusuarios":
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
function crearUser($conn, $apodo, $Nombre, $email, $clave){
    $sql = "INSERT INTO usuarios (NOMBREusuarios, NOMBREREALusuarios, CLAVEusuarios, CORREOusuarios) VALUES (?, ?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../singup.php?error=CouldNotConnect");
        exit();
    }

    $hashedpwd = password_hash($clave, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss",$apodo, $Nombre, $hashedpwd, $email);
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

    $pwdHashed = $usurexits["CLAVEusuarios"];
    $pwdverify = password_verify($pwd, $pwdHashed);

    if ($pwdverify === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else {
        session_start();
        $_SESSION["username"] = $usurexits["NOMBREREALusuarios"];
        header("location: ../admin.php");
        exit();
    }

}
/*
 manda una nueva clave al usuario a su correo
*/
function recuperarcontraseña($conn, $username) {

    $usurexits = revisarExistenciaDelUsuario($conn, $username, $username);

    if ($usurexits === false) {
        header("location: ../recover.php?error=wronglogin");
        exit();
    }

    $sql = "UPDATE usuarios SET CLAVEusuarios= ? WHERE NOMBREusuarios= ? OR CORREOusuarios = ?;"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }
    $digito1 = rand(0,9);
    $digito2 = rand(0,9);
    $digito3 = rand(0,9);
    $digito4 = rand(0,9);
    $clave = $digito1 . $digito2 . $digito3 . $digito4;
    $newpassword = password_hash($clave, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $newpassword, $username, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $tema = "clave perdida";
    $Nombre = $usurexits["NOMBREREALusuarios"];
    $email = $usurexits["CORREOusuarios"];
    $mensaje = "lo sentimos tanto " . $Nombre . " que hayas perdido tu clave.\npor eso mismo hemos cambiado temporalmente su clave a ". $clave .".\n\n\ncuando tenga la oportunidad cambiela a otra mas segura";
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

//  termina seccion de usuario
//
//          _________
//         /#########\ 
//        /###########\
//       /####/   \####\
//      /####/      \##/
//     |####/
//     |####|        ______
//     |####|      _/######\_
//     |####|     |##########|
//     |####|       \#####/
//      \####\      /####/
//       \####\____/####/
//         \##########/
//           \######/         
//
//
// comienza seccion de grupos



//  termina seccion de grupos
//
//          ______________
//         /##############\
//         |####|      \###\_
//         |####|        \###\
//         |####|       _/###/
//         |####\______/###/
//         |##############/
//         |####/ 
//         |####|
//         |####|
//         |####|
//
//
// comienza seccion de profesor

/*
 revisa que el profesor al que se referencio exista en la base de datos usando su ID
*/
function revisarExistenciaDelProfesorPormedioDeID($conn, $id) {

    $sql = "SELECT * FROM profesores where idProfesores = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
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
 revisa que el profesor al que se referencio exista en la base de datos usando su nombre
*/
function revisarExistenciaDelProfesorPormedioDeNombre($conn, $Nombre) {

    $sql = "SELECT * FROM profesores where nombreProfesores = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $Nombre);
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
 inserta un profesor a la base de datos
*/
function crearProfesor($conn, $nombre, $apellido){
    $sql = "INSERT INTO profesores (nombreProfesores,apellidoProfesores) VALUES (?,?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    

    mysqli_stmt_bind_param($stmt, "ss", $nombre, $apellido);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated&panel=profesores");
}

/*
 actualiza los datos de un profesor
*/
function actualizarProfesornombreOapellido($conn,$nuevonombre,$id,$cambio){

    $usurexits = revisarExistenciaDelProfesorPormedioDeID($conn, $id);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=profesores");
        exit();
    }

    $sql = "UPDATE profesores SET ". $cambio ."= ? WHERE idProfesores= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $nuevonombre, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userModfied&panel=profesores");

}

/*
 borra un profesor del sistema
*/
function borrarProfesor($conn,$id){

    $usurexits = revisarExistenciaDelProfesorPormedioDeID($conn, $id);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=profesores");
        exit();
    }

    $sql = "DELETE FROM profesores WHERE idProfesores= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userDeleted&panel=profesores");

}

//  termina seccion de profesor
//       _____         _____
//      /#####\       /#####\
//     |###|###|     |###|###|
//     /###|###\     /###|###\
//    |###/ |###|   |###| |###|
//    |###| |###\   /###| |###|
//    |###|  \###\ /###/  |###|
//    |###|   \#######/   |###|
//    |###|    \_###_/    |###|
//    |###|               |###|
//
// comienza seccion de materias



//  termina seccion de Materias
//
//          ____        ____
//         /####\      /####\
//         |####|      |####|
//         |####|      |####|
//         |####\______/####|
//         |################|
//         |################|
//         |####/      \####|
//         |####|      |####|
//         |####|      |####|
//         |####|      |####|
//
//
// comienza seccion de Horarios


/*
 revisa la existencia del horario seleccionada
*/
function revisarExistenciaDelHorario($conn, $hora, $turno, $dia) {
    $sql = "SELECT * FROM horarios where turnoHorarios = ? AND horaHorarios = ? AND diaHorarios = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../test.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii", $hora, $turno, $dia);
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
 inserta un horario a la base de datos 
 dos datos tipos times para hora inicial y final
 turno y hora utu son valores tipo int
*/
function crearHorarios($conn,$horainicial,$horafinal,$turno,$horautu,$dia){
    $sql = "INSERT INTO horarios (inicioHorarios,terminaHorarios,turnoHorarios,horaHorarios,diaHorarios) VALUES (?,?,?,?,?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../test.php?error=CouldNotConnect");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ssiii", $horainicial,$horafinal,$turno,$horautu,$dia);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../test.php?error=userCreated");
}
/*
 actualiza los datos de un horario esta funcion pide dos datos tipos times para hora inicial y final
 turno y hora utu son valores tipo int
*/
function actualizarHorario($conn,$newhorainicial,$newhorafinal,$turno,$horautu,$dia){

    $usurexits = revisarExistenciaDelHorario($conn, $turno,$horautu,$dia);

    if ($usurexits === false) {
        header("location: ../test.php?error=usernotfound");
        exit();
    }

    $sql = "UPDATE horarios SET inicioHorarios= ? , terminaHorarios=?  WHERE idHorarios= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }
    $id = $usurexits["idHorarios"];
    mysqli_stmt_bind_param($stmt, "ssi", $newhorainicial, $newhorafinal,$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../test.php?error=userModfied");

}
/*
 borra un horario del sistema
*/
function borrarHorario($conn,$turno,$horautu,$dia){

    $usurexits = revisarExistenciaDelHorario($conn, $turno,$horautu,$dia);

    if ($usurexits === false) {
        header("location: ../test.php?error=usernotfound");
        exit();
    }

    $sql = "DELETE FROM horarios WHERE idHorarios= ?"; 
    $stmt = mysqli_stmt_init($conn);
    $id = $usurexits["idHorarios"];
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../test.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../test.php?error=userDeleted");

}

?>