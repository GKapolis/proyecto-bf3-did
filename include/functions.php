<?php


function emptyInputRegistro($name,$email,$contraseña,$contraseñarepeat) {
    
    if (empty($name) || empty($email) || empty($contraseña) || empty($contraseñarepeat) ) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidName($name) 
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidLevel($level) 
{
    if ( ($level <= 1) && ($level >= 4) ) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function passnotmatch($contraseña, $contraseñarepeat){
    
    if ($contraseña !== $contraseñarepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidexists($conn, $name){
    $sql = "SELECT * FROM users where usersName = ?;"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../temp.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
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

function createUser($conn, $name, $email, $contraseña){
    $sql = "INSERT INTO users (usersName, usersPassword, usersType) VALUES (?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    $hashedpwd = password_hash($contraseña, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssi", $name, $hashedpwd, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated");
}

function emptyInputLogin($name,$pwd) {
    if (empty($name) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginuser($conn, $username, $pwd) {


    $usurexits = uidexists($conn, $username);
    

    if ($usurexits === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $usurexits["usersPassword"];
    $pwdverify = password_verify($pwd, $pwdHashed);

    if ($pwdverify === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }
    else {
        session_start();
        $_SESSION["userid"] = $usurexits["usersId"];
        $_SESSION["username"] = $usurexits["usersName"];
        $_SESSION["acceslevel"] = $usurexits["usersType"];
        switch($usurexits["usersType"]) {
            case 1:
                $_SESSION["accesname"] = "Profesor/a";
                break;
            case 2:
                $_SESSION["accesname"] = "adscripto/a";
                break;
            case 3:
                $_SESSION["accesname"] = "Administrador/a";
                break;
            case 4:
                $_SESSION["accesname"] = "sysadmin";
                break;
            default:
                $_SESSION["accesname"] = "\"___\"";
                break;
                
        }
        header("location: ../index.php");
        exit();
    }

}

function updateuserlevel($conn,$username,$level){

    $usurexits = uidexists($conn, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "UPDATE users SET usersType= ? WHERE usersName= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "is", $level, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userModfied");

}

function deleteuser($conn,$username){

    $usurexits = uidexists($conn, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "DELETE FROM users WHERE usersName= ?"; 
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

function createGroup($conn, $name, $email, $contraseña){
    $sql = "INSERT INTO users (usersName, usersPassword, usersType) VALUES (?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    $hashedpwd = password_hash($contraseña, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssi", $name, $hashedpwd, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userCreated");
}

function updateGroup($conn,$username,$level){

    $usurexits = uidexists($conn, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "UPDATE users SET usersType= ? WHERE usersName= ?"; 
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=CouldNotConnect");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "is", $level, $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../admin.php?error=userModfied");

}

function deleteGroup($conn,$username){

    $usurexits = uidexists($conn, $username);

    if ($usurexits === false) {
        header("location: ../admin.php?error=usernotfound");
        exit();
    }

    $sql = "DELETE FROM users WHERE usersName= ?"; 
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