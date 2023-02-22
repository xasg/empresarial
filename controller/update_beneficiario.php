<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_SESSION["id"];
   $curp = isset( $_POST['curp']) ? $_POST['curp'] : '';
   $telefono = isset( $_POST['telefono']) ? $_POST['telefono'] : '';
   $direccion = isset( $_POST['direccion']) ? $_POST['direccion'] : '';
   $colonia = isset( $_POST['colonia']) ? $_POST['colonia'] : '';
   $municipio = isset( $_POST['municipio']) ? $_POST['municipio'] : '';
   $entidad = isset( $_POST['entidad']) ? $_POST['entidad'] : '';
   $cp = isset( $_POST['cp']) ? $_POST['cp'] : '';
   update_beneficiario($id, $curp, $telefono, $direccion, $colonia, $municipio, $entidad, $cp);
   $estatus=1;
   update_estatus($id, $estatus);
?>
    <script>
       window.location="../view/datosacademicos.php"
    </script>
<?php

}
