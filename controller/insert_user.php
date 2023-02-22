<?php
   include_once('databases_utilities.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id = $_POST['id'];
   $razon = isset( $_POST['razon']) ? $_POST['razon'] : '';
   $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : '';
   $rfc = isset( $_POST['rfc']) ? $_POST['rfc'] : '';
   $actividad = isset( $_POST['actividad']) ? $_POST['actividad'] : '';
   $sector = isset( $_POST['sector']) ? $_POST['sector'] : '';
   $tamano = isset( $_POST['tamano']) ? $_POST['tamano'] : '';
   $giro = isset( $_POST['giro']) ? $_POST['giro'] : '';
   $org = isset( $_POST['org']) ? $_POST['org'] : '';
   $direccion = isset( $_POST['direccion']) ? $_POST['direccion'] : '';
   $colonia = isset( $_POST['colonia']) ? $_POST['colonia'] : '';
   $entidad = isset( $_POST['entidad']) ? $_POST['entidad'] : '';
   $cp = isset( $_POST['cp']) ? $_POST['cp'] : '';
   update_user($id, $razon, $nombre, $rfc, $actividad, $tamano, $sector, $giro, $org, $direccion, $colonia, $entidad, $cp); 

?>
    <script>
       window.location="vacantes.php"
    </script>
<?php

}
