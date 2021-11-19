<?php
include_once 'header.php';
require_once 'include/errorhandling.php';
?>
            
            <section class="bg-dark">
                <h2 class="text-info">aqui podes ingresar</h2>
                <form action="include/login.inc.php" method="post">
                    <input type="text" name="username" placeholder="inserte nombre de usuario o correo registrado">
                    <input type="password" name="contraseña" placeholder="inserte contraseña">
                    <button type="submit" name="submit">Ingresar</button>
                </form>

                <p><a class="" href="singup.php">Registrar usuario</a></p>
                
                <h2 class="text-info"><a class="nav-link" href="recover.php">perdiste tu contraseña ?</a></h2>
            </section>

<?php
include_once 'footer.php'
?>