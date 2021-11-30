<?php

require_once 'include/errorhandling.php';
require_once 'include/panels.inc.php';
include_once 'include/dbh.inc.php';

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
$materia = 1;
$grupo = 1;
updateclassform($conn,$materia,$grupo);
?>
    
</body>
</html>