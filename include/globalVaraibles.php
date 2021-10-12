<!DOCTYPE html>

<html lang="es" dir="ltr">

    <head>
        <meta charset="utf-8">
        <title> K Login Systyem </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    

    <body>
        <div class="bg-dark">
<?php

$debugvar = "any";

function changedebugvar($any){
    global  $debugvar;
    $debugvar = $any;
}

echo "<h1 class=\"text-warning\">" . $debugvar . "</h1>";

?>
        </div>
    </body>
</html>