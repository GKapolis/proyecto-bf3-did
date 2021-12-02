<?php
        $message = "";
        $elemento = "";
        if (isset($_GET["panel"])){
            switch($_GET["panel"]){
                case "profesores" :
                    $elemento = "Al Profesor";
                break;
                case "user":
                    $elemento = "Al Usuario";
                break;
                case "grupos" :
                    $elemento = "Al Grupo";
                break;
                case "clases":
                    $elemento = "La Materia";
                break;
                case "materias":
                    $elemento = "La Materia";
                break;
                case "materiaenclase":
                    if (isset($_GET['subpanel'])){
                        switch($_GET['subpanel']){
                            case "profesor":
                                $elemento = "Al Profesor";
                                break;
                            case "horario":
                                $elemento = "El Horario";
                                break;
                        }
                    }
                break;
        
        
        
            }
            
        
        }
            if (isset($_GET["error"])){
                switch($_GET["error"]){
                    case "emptyinput" :
                        $message = "<p class=\"message error\"><b>no pusiste nada en algun campo</b></p>";
                        break;
                    case "nameNotValid" :
                        $message = "<p class=\"message error\"><b>el nombre colocado no es valido o tiene espacios en el nombre</b></p>";
                        break;
                    case "emailNotValid":
                        $message = "<p class=\"message error\"><b>el correo colocado no es valido</b></p>";
                        break;
                    case "passwordNotMatch":
                        $message = "<p class=\"message error\">las contraseñas no coinciden</b></p>";
                        break;
                    case "nameORemailTaken":
                        $message = "<p class=\"message error\">correo o nombre ya tomado.</p>";
                        break;
                    case "CouldNotConnect":
                        $message = "<p class=\"message error\">error de conexion.</p>";
                        break;
                    case "noneSingup":
                        $message = "<p class=\"message exito\">se ha registrado con exito.</p>";
                        break;
                    case "emptyinput":
                        $message = "<p class=\"message error\">no pusiste nada en algun campo.<</p>";
                        break;
                    case "wronglogin":
                        $message = "<p class=\"message error\">algun dato del login quedo mal colocado.</p>";
                        break;
                    case "userModfied":
                        $message = "<p class=\"message exito\">se modifico con exito ".$elemento.".</p>";
                        break;
                    case "userDeleted":
                        $message = "<p class=\"message exito\">se elimino con exito ".$elemento.".</p>";
                        break;
                    case "usernotfound":
                        $message = "<p class=\"message error\">no se encontro el ".$elemento.".</p>";
                        break;
                    case "userCreated":
                        $message = "<p class=\"message\">Se creo con exito ".$elemento.".</p>";
                        break;

                        

                }
            }

            echo strtoupper($message);
        ?>