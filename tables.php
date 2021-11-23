<?php
session_start();
include_once "include/panels.inc.php";
include_once "include/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_GET["tabla"])){
        drawtable($conn,$_GET["tabla"]);
    }
    ?>
</body>
</html>