<?php

$serverName = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "projectvf3";

$conn = mysqli_connect($serverName,$DBusername,$DBpassword,$DBname);

if(!$conn){
    die("Conexion fallida : " . mysqli_connect_error());
}       

?>