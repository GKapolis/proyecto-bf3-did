<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">  
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

        <section class="bg-dark">
            <h2 class="text-info">por favor ingrese su nombre o correo</h2>
            <form action="include/recover.inc.php" method="post">
                <input type="text" name="username" placeholder="inserte nombre de usuario o correo registrado">
                <button type="submit" name="submit">Ingresar</button>
            </form>
                
        </section>
</body>
</html>