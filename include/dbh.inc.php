<?php

$serverName = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "projectvf2";

$conn = mysqli_connect($serverName,$DBusername,$DBpassword,$DBname);

if(!$conn){
    die("Conexion fallida : " . mysqli_connect_error());
}       

?>