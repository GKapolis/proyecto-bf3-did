<?php
include_once 'header.php';
include_once 'include/errorhandling.php';
?>

        <section class="bg-dark">
            <h2 class="text-info">por favor ingrese su nombre o correo</h2>
            <form action="include/recover.inc.php" method="post">
                <input type="text" name="username" placeholder="inserte nombre de usuario o correo registrado">
                <button type="submit" name="submit">Ingresar</button>
            </form>
                
        </section>

<?php
include_once 'footer.php'
?>