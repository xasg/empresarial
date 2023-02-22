<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   if( $_POST )
   {  
   $id= $_POST["id"];
   $empresa = isset( $_POST['empresa']) ? $_POST['empresa'] : '';
   $vacante = isset( $_POST['vacante']) ? $_POST['vacante'] : '';
   update_relacion($id, $empresa, $vacante);
?>
    <script>
       window.location="../view/editar_ben_admin.php?ben=<?php echo $id ?>"
    </script>
<?php

}
