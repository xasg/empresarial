<?php
require('../model/database_emails.php');
$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);
$vacante = isset( $_POST['idvac']) ? $_POST['idvac'] : '';
$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(",", $linea);
       
        $nombre                = !empty($datos[0])  ? ($datos[0]) : '';
		$correo                = !empty($datos[1])  ? ($datos[1]) : '';
        // $celular               = !empty($datos[2])  ? ($datos[2]) : '';
       
if( !empty($correo) ){
    // $checkemail_duplicidad = ("SELECT correo FROM clientes WHERE correo='".($correo)."' ");
            $ca_dupli = search_candidato($correo,$vacante);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }   

//No existe Registros Duplicados
if ( $cant_duplicidad == 0 ) { 

    insert_data($nombre,$correo,$vacante);
    ?>
    <script>
       window.location="../view/consult_vacante_invite.php?vac=<?php echo $vacante ?>";
    </script>
<?php
        
} 
/**Caso Contrario actualizo el o los Registros ya existentes*/
else{
    update_correo($nombre,$correo,$vacante);
    ?>
    <script>
       window.location="../view/consult_vacante_invite.php?vac=<?php echo $vacante ?>";
    </script>
<?php
    } 
  }

 $i++;
}

?>

<a href="index.php">Atras</a>