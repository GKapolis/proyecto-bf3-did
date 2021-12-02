<?php
session_start();
include_once "include/panels.inc.php";
include_once "include/dbh.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/normalize.css">
</head>
<body>


<nav class="nav">
				
				<a href="index.php" class="links nav-logo-link"><img src="images/logo.png" alt="" class="nav__image"></a>
						
					
			</nav>

    <?php
    if (isset($_GET["tabla"])){
        drawtable3($conn,$_GET["tabla"]);
    }
    ?>
</body>
</html>