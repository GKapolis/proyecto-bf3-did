<?php
        $message = "";
            if (isset($_GET["error"])){
                switch($_GET["error"]){
                    case "emptyinput" :
                        $message = "<p class=\"text-warning bg-dark\"><b>no pusiste nada en algun campo</b></p>";
                        break;
                    case "nameNotValid" :
                        $message = "<p class=\"text-warning bg-dark\"><b>el nombre colocado no es valido</b></p>";
                        break;
                    case "emailNotValid":
                        $message = "<p class=\"text-warning bg-dark\"><b>el correo colocado no es valido</b></p>";
                        break;
                    case "passwordNotMatch":
                        $message = "<p class=\"text-warning bg-dark\"><b>las contraseñas no coinciden</b></p>";
                        break;
                    case "nameORemailTaken":
                        $message = "<p class=\"text-warning bg-dark\"><b>correo o nombre ya tomado</b></p>";
                        break;
                    case "CouldNotConnect":
                        $message = "<p class=\"text-warning bg-dark\"><b>error de conexion</b></p>";
                        break;
                    case "noneSingup":
                        $message = "<p class=\"text-success bg-dark\"><b>se ha registrado con exito</b></p>";
                        break;
                    case "emptyinput":
                        $message = "<p class=\"text-warning bg-dark\"><b>no pusiste nada en algun campo</b></p>";
                        break;
                    case "wronglogin":
                        $message = "<p class=\"text-warning bg-dark\"><b>algun dato del login quedo mal colocado</b></p>";
                        break;
                    case "userModfied":
                        $message = "<p class=\"text-success bg-dark\"><b>se modifico con exito al usuario</b></p>";
                        break;
                    case "userDeleted":
                        $message = "<p class=\"text-success bg-dark\"><b>se elimino con exito al usuario</b></p>";
                        break;
                    case "usernotfound":
                        $message = "<p class=\"text-warning bg-dark\"><b>no se encontro el usuario</b></p>";
                        break;
                    case "userCreated":
                        $message = "<p class=\"text-success bg-dark\"><b>Se creo con exito al usuario</b></p>";
                        break;

                        

                }
            }

            echo $message;
        ?>