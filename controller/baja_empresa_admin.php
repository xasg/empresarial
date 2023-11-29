<?php

include_once('../model/databases_admin.php');
mysqli_set_charset( $mysqli, 'utf8');
if ($_REQUEST) {
    $id=$_REQUEST['vac'];
    down_empresa($id);
    ?>
    <script>
       window.location="../view/empresarial.php"
    </script>
    <?php
}

?>