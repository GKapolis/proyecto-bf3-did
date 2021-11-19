<?php
include_once 'header.php';
require_once 'include/errorhandling.php';
?>
        
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

        

<?php
include_once 'footer.php'
?>