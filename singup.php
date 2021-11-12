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
                <h2 class="text-info">aqui podes registrarte</h2>
                <form action="include/singup.inc.php" method="post">
                    <input type="text" name="username" placeholder="inserte nombre de usuario">
                    <input type="text" name="name" placeholder="inserte su nombre">
                    <input type="text" name="email" placeholder="inserte correo">
                    <input type="password" name="contraseña" placeholder="inserte contraseña">
                    <input type="password" name="contraseña-repeat" placeholder="reinserte contraseña">
                    <button type="submit" name="submit">Registrarte</button>
                </form>
            </section>

        
</body>
</html>