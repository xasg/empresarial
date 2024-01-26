<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_SESSION["id"];
   if ($_POST['nombre_ies_input']) {
      $ies_nombre = isset( $_POST['nombre_ies_input']) ? $_POST['nombre_ies_input'] : '';
      $id_busqueda = buscar_primero_ies($ies_nombre);
      $validacion = valida_ies($id_busqueda,$_POST['entidad']);
      print_r($id_busqueda);
      echo "<br>";
      print_r($validacion);
      if ($validacion != null && $validacion > 0) {
         header("Location: ../view/datosacademicos.php?existeies");
         die();
     } else {
         insert_ies($ies_nombre,$_POST['entidad']);
         $id_busqueda = buscar_ies($ies_nombre);
         update_ies($id_busqueda);
         $ies = buscar_ies_final($id_busqueda, $ies_nombre);
     }
   }else if($_POST['ies'] != null){
      $ies = isset( $_POST['ies']) ? $_POST['ies'] : '';
      // print_r($ies);
   }
   if ($_POST['nombre_carrera_input']) {
      $carrera_nombre = isset( $_POST['nombre_carrera_input']) ? $_POST['nombre_carrera_input'] : '';
      insert_carrera($carrera_nombre);
      $id_busqueda = buscar_carrera($carrera_nombre);
      update_carrera($id_busqueda);
      $carrera = buscar_carrera_final($id_busqueda,$carrera_nombre);

      // print_r($carrera);
      // die();
   }else if ($_POST['carrera']) {
      $carrera = isset( $_POST['carrera']) ? $_POST['carrera'] : '';
   }
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
