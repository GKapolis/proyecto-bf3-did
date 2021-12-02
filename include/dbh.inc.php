<?php

$serverName = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "projectvf4";

$conn = mysqli_connect($serverName,$DBusername,$DBpassword,$DBname);

if(!$conn){
    die("Conexion fallida : " . mysqli_connect_error());
}       

?>