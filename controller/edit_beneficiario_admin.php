<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_POST["id"];
   $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : '';
   $apaterno = isset( $_POST['apaterno']) ? $_POST['apaterno'] : '';
   $amaterno = isset( $_POST['amaterno']) ? $_POST['amaterno'] : '';
   $curp = isset( $_POST['curp']) ? $_POST['curp'] : '';
   $direccion = isset( $_POST['direccion']) ? $_POST['direccion'] : '';
   $colonia = isset( $_POST['colonia']) ? $_POST['colonia'] : '';
   $municipio = isset( $_POST['municipio']) ? $_POST['municipio'] : '';
   $cp = isset( $_POST['cp']) ? $_POST['cp'] : '';
   $entidad = isset( $_POST['entidad']) ? $_POST['entidad'] : '';
   update_beneficiario($id, $nombre, $apaterno, $amaterno, $curp, $direccion, $colonia, $municipio, $cp, $entidad);
?>
    <script>
       window.location="../view/editar_cand_admin.php?ben=<?php echo $id; ?>"
    </script>
<?php

}
