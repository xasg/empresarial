<?php
   include_once('../model/databases_empresa.php');
   mysqli_set_charset( $mysqli, 'utf8');
   if( $_POST )
   {  
   $id=$_POST['id'];
   $razon = isset( $_POST['razon']) ? $_POST['razon'] : '';
   $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : '';
   $rfc = isset( $_POST['rfc']) ? $_POST['rfc'] : '';
   $actividad = isset( $_POST['actividad']) ? $_POST['actividad'] : '';
   $tamano = isset( $_POST['tamano']) ? $_POST['tamano'] : '';
   $giro = isset( $_POST['giro']) ? $_POST['giro'] : '';
   $org = isset( $_POST['org']) ? $_POST['org'] : '';
   $direccion = isset( $_POST['direccion']) ? $_POST['direccion'] : '';
   $colonia = isset( $_POST['colonia']) ? $_POST['colonia'] : '';
   $entidad = isset( $_POST['entidad']) ? $_POST['entidad'] : '';
   $cp = isset( $_POST['cp']) ? $_POST['cp'] : '';
   $nombre_contacto = isset( $_POST['nombre_contacto']) ? $_POST['nombre_contacto'] : '';
   $puesto_contacto = isset( $_POST['puesto_contacto']) ? $_POST['puesto_contacto'] : '';
   $correo_contacto = isset( $_POST['correo_contacto']) ? $_POST['correo_contacto'] : '';
   $telefono_contacto = isset( $_POST['telefono_contacto']) ? $_POST['telefono_contacto'] : '';
   $nombre_representante = isset( $_POST['nombre_representante']) ? $_POST['nombre_representante'] : '';
   update_empresa($id, $razon, $nombre, $rfc, $actividad, $tamano, $giro, $org, $direccion, $colonia, $entidad, $cp, $nombre_contacto, $puesto_contacto, $correo_contacto, $telefono_contacto, $nombre_representante); 
   $estatus=1;
   update_estatus($id, $estatus);
?>
    <script>
       window.location="../view/edit_empresa_admin.php?vac=<?php echo $id ?>"
    </script>
<?php

}


