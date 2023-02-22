<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start(); 
    $id=$_SESSION["id"];  
   if( $_POST )
   {  
   $empresa = isset( $_POST['empresa']) ? $_POST['empresa'] : '';
   $vacante = isset( $_POST['vacante']) ? $_POST['vacante'] : '';
   insert_relacion($id, $empresa, $vacante);
?>
    <script>
       window.location="../view/select_vacante.php"
    </script>
<?php

}
