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

<<<<<<< Updated upstream
=======

// compara horarios para que la hora inicial no sea mayor a la final
>>>>>>> Stashed changes
function compararhorarios($horainicial,$horafinal) {
    if ($horainicial >= $horafinal) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

<<<<<<< Updated upstream
=======
//genera un array dado 3 elementos se usa para generar un array de los dias y turnos
function arrayde3lementos($elemento1,$elemento2,$elemento3){

    $dias = array();
    if($elemento1 >= 1 && $elemento1 !=0) {
        $dias['elemento1'] = $elemento1;
    }
    if($elemento2 >= 1 && $elemento2 !=0 && $elemento2 != $elemento1) {
        $dias['elemento2'] = $elemento2;
    }
    if($elemento3 >= 1 && $elemento3 !=0 && $elemento3 != $elemento2 && $elemento3 != $elemento1) {
        $dias['elemento3'] = $elemento3;
    }
    if (empty($dias)){
        return false;
    }
    return $dias;

};

function removerceros($array){
    $arraysinceros = array();
    $notwantednumbers = array(-1,0);
    $arraysinceros = array_diff($array,$notwantednumbers);
    return $arraysinceros;
}


>>>>>>> Stashed changes
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
// comienza seccion de grupos


<<<<<<< Updated upstream
=======
}

/*
 revisa que al grupo al se llama exista en el sistema pero lo hace por medio de su ID
*/
function revisarExistenciaDelGrupoID($conn, $groupname) 
{

    $sql = "SELECT * FROM grupo where idGrupo = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $groupname);
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
 crea un grupo en la base de datos
*/
function crearGroup($conn, $Nombre, $longname){
    $sql = "INSERT INTO grupo (nombreGrupo, nombredescriptivoGrupo) VALUES (?, ?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=grupos");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $Nombre, $longname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated&panel=grupos");
}

/*
 actualiza los datos de un grupo (actualmente solo cambia el nombre descriptivo)
*/
function crearGrupoFirstTime($conn, $Nombre, $profesorID, $horarioID, $name, $fullname){
    crearMateriasnotalldataknowinsideversion($conn, $Nombre);
    crearGroup($conn,$name,$fullname);
    $profesores = "profesores_idProfesores";
    $grupo = "grupo_nombreGrupo";
    if($profesorID !== 0){
        actualizarMateriasinsideversion($conn, $Nombre,$profesores,$profesorID);
    }
    $idmateria = revisarExistenciaDeLaMateriasPorNombre($conn,$Nombre);
    foreach($horarioID as $IDporHorario){
        insertarhorariosymaterias($conn,$IDporHorario,$idmateria["idMaterias"]);
    }
    actualizarMateriasinsideversion($conn,$Nombre,$grupo,$name);


    header("location: ../admin.php?error=userCreated&panel=grupos");
}
function grupomateria($conn,$nombre,$idmateria){

}
function actualizarGroupnombredescriptivo($conn,$Nombre,$change){

    $usurexits = revisarExistenciaDelGrupo($conn, $Nombre);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "UPDATE grupo SET nombredescriptivoGrupo= ? WHERE nombreGrupo= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $change, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userModfied");

}

/*
 borra un grupo del sistema
*/
function borrarGroup($conn,$username){

    $usurexits = revisarExistenciaDelGrupo($conn, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "DELETE FROM grupo WHERE nombreGrupo= ?"; 
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
>>>>>>> Stashed changes

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
    $date = date('Y-m-d h:i:sa');
    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=profesores");
        exit();
    }

    $sql = "UPDATE profesores SET fecha_baja = ? WHERE idProfesores= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si",$date, $id);
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

<<<<<<< Updated upstream

=======
/*
 revisa la existencia de la materia seleccionada
*/
function revisarExistenciaDeLaMateriasPorNombre($conn, $materia) {
    $sql = "SELECT * FROM materias WHERE NombreMateria = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $materia);
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
function revisarExistenciaDeLaMateriasPorID($conn, $id) {
    $sql = "SELECT * FROM materias WHERE idMaterias = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
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
 inserta la materia a la base de datos con todos los datos
*/
function crearMateriascomplete($conn, $Nombre, $profesorID, $horarioID){

    crearMateriasnotalldataknowinsideversion($conn, $Nombre);
    $profesores = "profesores_idProfesores";
    if($profesorID !== 0){
        actualizarMateriasinsideversion($conn, $Nombre,$profesores,$profesorID);
    }
    $idmateria = revisarExistenciaDeLaMateriasPorNombre($conn,$Nombre);
    foreach($horarioID as $IDporHorario){
        insertarhorariosymaterias($conn,$IDporHorario,$idmateria["idMaterias"]);
    }
    header("location: ../admin.php?error=userCreated&panel=grupos");
}
/*
 inserta la materia a la base de datos cuando no se sabe todos los datos todavia
*/
function crearMateriasnotalldataknow($conn, $Nombre){
    
    $sql = "INSERT INTO materias (NombreMateria) VALUES (?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $Nombre);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated&panel=materias");

}
function insertarhorariosymaterias($conn, $horarios, $materia){
    $sql = "INSERT INTO clase_has_horarios (idClase, idHorario) VALUES (?,?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=grupos");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii",$materia , $horarios);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function borrarhorariosmaterias($conn, $materia){

    $sql = "DELETE FROM materias_has_horarios WHERE Materias_idMaterias= ?"; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $materia);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userDeleted&panel=materias");
}
function crearMateriasnotalldataknowinsideversion($conn, $Nombre){
    
    $sql = "INSERT INTO materias (NombreMateria) VALUES (?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $Nombre);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
/*
 actualiza los datos de una materia
*/
function actualizarMaterias($conn,$id,$newname){

    $usurexits = revisarExistenciaDeLaMateriasPorID($conn, $id);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=materias");
        exit();
    }

    $sql = "UPDATE materias SET NombreMateria = ? WHERE idMaterias= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $newname, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userModfied&panel=materias");

}
function actualizarMateriasinsideversion($conn,$name,$datatype,$newdata){

    $usurexits = revisarExistenciaDeLaMateriasPorNombre($conn, $name);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=grupos");
        exit();
    }

    $sql = "UPDATE materias SET ".$datatype." = ? WHERE idMaterias= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $newdata, $usurexits["idMaterias"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function actualizarMateriasinsideversionporID($conn,$id,$datatype,$newdata){

    $usurexits = revisarExistenciaDeLaMateriasPorID($conn, $id);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=grupos");
        exit();
    }

    $sql = "UPDATE materias SET ".$datatype." = ? WHERE idMaterias= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "si", $newdata, $usurexits["idMaterias"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
/*
 borra un profesor del sistema
*/
function borrarMaterias($conn,$id){

    $usurexits = revisarExistenciaDeLaMateriasPorID($conn, $id);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=materias");
        exit();
    }

    $sql = "DELETE FROM materias WHERE NombreMateria= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userDeleted&panel=materias");

}
function actualizarmateria($conn, $idmateria,$idgrupo, $horarioID){
    $idclase = borrarhoras($conn,$idmateria,$idgrupo);
    print_r($idclase);
    foreach($horarioID as $IDporHorario){
        insertarhorariosymaterias($conn,$IDporHorario,$idclase["idClase"]);
    }
    header("location: ../admin.php?error=userCreated&panel=clases&idGrupo=".$idgrupo);
}
>>>>>>> Stashed changes

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

    mysqli_stmt_bind_param($stmt, "iii", $turno, $hora, $dia);
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
 revisa la existencia del horario seleccionado pero por medio de su ID
*/
function revisarExistenciaDelHorarioID($conn, $id) {
    $sql = "SELECT * FROM horarios where idHorarios = ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../test.php?error=CouldNotConnect");
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

function conseguiridsdehorarios($conn,$turnos,$dias,$horas){
    $ids = array();
    $i = 0;
    for ($i; $i < 4 ; $i++){
        $id = revisarExistenciaDelHorario($conn,$horas[$i],$turnos[0],$dias[0]);
        $ids[] = $id["idHorarios"];
    }
    for ($i; $i < 8 ; $i++){
        $id = revisarExistenciaDelHorario($conn,$horas[$i],$turnos[1],$dias[1]);
    }
    for ($i; $i < 12 ; $i++){
        $id = revisarExistenciaDelHorario($conn,$horas[$i],$turnos[2],$dias[2]);
    }

    return $ids;
};
function borrarhoras($conn, $materiaid,$grupoid){
    $usurexits = revisarExistenciaDelaClase($conn, $grupoid,$materiaid);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound&panel=materias");
        exit();
    }

    $sql = "DELETE FROM clase_has_horarios WHERE idClase = ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=materias");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $usurexits["idClase"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userDeleted&panel=materias");
    return ($usurexits);
}

//hora treatment
function horasarrayychequeo($horas1,$horas2,$horas3,$horas4,$horas5,$horas6,$horas7,$horas8,$horas9,$horas10,$horas11,$horas12){

    $horarios = array(array(),array(),array());
    
    $horasdia1 = array($horas1,$horas2,$horas3,$horas4);
    $horasdia1 = removerceros($horasdia1);
    if(empty($horasdia1) == false) {
        $horasdia1 = array_unique($horasdia1);
        $horarios[0] = array_replace($horarios[0],$horasdia1);
    }
    else {
        unset($horarios[0]);
    }
    
    $horasdia2 = array($horas5,$horas6,$horas7,$horas8);
    $horasdia2 = removerceros($horasdia2);
    if(empty($horasdia2) == false) {
        $horasdia2 = array_unique($horasdia2);
        $horarios[1] = array_replace($horarios[1],$horasdia2);
    }
    else {
        unset($horarios[1]);
    }
    
    $horasdia3 = array($horas9,$horas10,$horas11,$horas12);
    $horasdia3 = removerceros($horasdia3);
    if(empty($horasdia3) == false) {
        $horasdia3 = array_unique($horasdia3);
        $horarios[2] = array_replace($horarios[2],$horasdia3);
    }
    else {
        unset($horarios[2]);
    }
    
    return $horarios;
    
    }
    
    //cambiado para trabajar con arrays
    function horasarrayychequeoV2($array1,$array2,$array3){
    
        $horarios = array(array(),array(),array());
        
        
        $array1 = removerceros($array1);
        if(empty($array1) == false) {
            $array1 = array_unique($array1);
            $horarios[0] = array_replace($horarios[0],$array1);
        }
        else {
            unset($horarios[0]);
        }
        
        
        $array2 = removerceros($array2);
        if(empty($array2) == false) {
            $array3 = array_unique($array2);
            $horarios[1] = array_replace($horarios[1],$array2);
        }
        else {
            unset($horarios[1]);
        }
        
        $array3 = removerceros($array3);
        if(empty($array3) == false) {
            $array3 = array_unique($array3);
            $horarios[2] = array_replace($horarios[2],$array3);
        }
        else {
            unset($horarios[2]);
        }
        
        return $horarios;
        
        }

//  termina seccion de Horarios
//
//          _________
//         /#########\ 
//        /###########\
//       /####/   \####\
//      /####/      \##/
//     |####/
//     |####|      
//     |####|      
//     |####|     
//     |####|         ____
//      \####\       /###/
//       \####\____/####/
//         \##########/
//           \######/         
//
// comienza seccion de Clases

function crearclase($conn,$grupo,$materia,$profesor){
    insertclase($conn,$grupo,$materia);
    if ($profesor != 0){
        actualziarprofesorenclase($conn,$profesor,$grupo,$materia);
    }
}

function insertclase($conn,$grupo,$materia){

    $sql = "INSERT INTO clases (idGrupo,idMateria) VALUES (?,?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=clases&idGrupo=".$grupo);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $grupo,$materia);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated&panel=clases&idGrupo=".$grupo);

}

function actualziarprofesorenclase($conn,$profesor,$grupo,$materia){

    $sql = "UPDATE clases SET idProfesor= ? WHERE idGrupo= ? AND idMateria= ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=clases");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iii",$profesor,$grupo,$materia);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated&panel=clases&idGrupo=".$grupo);

}

function actualziarprofesorenclaseporID($conn,$profesor,$clase,$grupo){

    $sql = "UPDATE clases SET idProfesor= ? WHERE idClase = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=clases");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii",$profesor,$clase);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated&panel=clases&idGrupo=".$grupo);

}

function revisarExistenciaDelaClase($conn, $grupo, $materia) {

    $sql = "SELECT * FROM clases WHERE idGrupo= ? AND idMateria= ?"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect&panel=profesores&idGrupo=".$grupo);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $grupo, $materia);
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




?>