<?php
include_once 'header.php'
?>

        <?php
            require_once 'include/dbh.inc.php';
            require_once 'include/functions.php';
            if (isset($_GET["table"])){
                $table = $_GET["table"];
            }
        ?>


<?php
include_once 'footer.php'
?>