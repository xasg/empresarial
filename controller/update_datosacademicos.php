<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_SESSION["id"];
   if ($_POST['nombre_ies_input']) {
      $ies_nombre = isset( $_POST['nombre_ies_input']) ? $_POST['nombre_ies_input'] : '';
      insert_ies($ies_nombre);
      $id_busqueda = buscar_ies($ies_nombre);
      print_r($id_busqueda);
      update_ies($id_busqueda);
      $ies = buscar_ies_final($id_busqueda,$ies_nombre);
      print_r($ies);
   }else if($_POST['ies'] != null){
      $ies = isset( $_POST['ies']) ? $_POST['ies'] : '';
      print_r($ies);
   }
   $carrera = isset( $_POST['carrera']) ? $_POST['carrera'] : '';
   $matricula = isset( $_POST['matricula']) ? $_POST['matricula'] : '';
   $periodo = isset( $_POST['periodo']) ? $_POST['periodo'] : '';
   $no_periodo = isset( $_POST['no_periodo']) ? $_POST['no_periodo'] : '';
   $no_creditos = isset( $_POST['no_creditos']) ? $_POST['no_creditos'] : '';
   $hab = isset( $_POST['habilidades']) ? $_POST['habilidades'] : '';
   $habilidades = implode(",", $hab); 
   update_datosacademicos($id, $ies, $carrera, $matricula, $periodo, $no_periodo, $no_creditos, $habilidades); 
   $estatus=1+1;
   update_estatus($id, $estatus);
   // die();
?>
    <script>
       window.location="../view/datoscomplementarios.php"
    </script>
<?php

}
