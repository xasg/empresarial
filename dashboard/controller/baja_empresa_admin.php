<?php

include_once('../model/database_admin.php');
mysqli_set_charset( $mysqli, 'utf8');
if ($_REQUEST) {
    $id=$_REQUEST['vac'];
    down_empresa($id);
    ?>
    <script>
       window.location="../view/empresas_nuevas_pendientes.php";
    </script>
    <?php
}

?>