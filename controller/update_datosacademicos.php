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
      // Valida primero que ya existe la IES en la misma entidad para evitar duplicar los registros
      if ($validacion != null && $validacion > 0) {
         header("Location: ../view/datosacademicos.php?existeies");
         die();
     } else {
      // En caso de que no exista se inserta en la tabla cat_ies con el id y el nombre seguido de la entidad
         insert_ies($ies_nombre,$_POST['entidad']);
         // Posteriormente se busca nuevamente la ies con el nombre de la ies donde la funcion tambien ya tiene por parametro act es decir el nombre y act en la columna id_cat_ies
         $id_busqueda = buscar_ies($ies_nombre);
         // Actualiza el id_cat_ies debido a que no es auto incremental y se le asigna el mismo id
         update_ies($id_busqueda);
         // Se obtiene finalmente el id que se guardara en la tabla de beneficiario para despues ser validada desde el admin y aparezca en el catalogo
         $ies = buscar_ies_final($id_busqueda, $ies_nombre);
     }
   }else if($_POST['ies'] != null){
      $ies = isset( $_POST['ies']) ? $_POST['ies'] : '';
      // print_r($ies);
   }
   if ($_POST['nombre_carrera_input']) {
      $carrera_nombre = isset( $_POST['nombre_carrera_input']) ? $_POST['nombre_carrera_input'] : '';
      // Se valida primero si la carrera ya esta registrada en la base de datos
      $bandera = encuentra_carrera($carrera_nombre);
      if ($bandera > 0) {
         // print_r("Ya existe");
         // Obtenemos el id de la carrera que si existe
         $id_cat_carrera = $bandera;

         // Despues validamos que esta carrera no este vinculada con la escuena y la entidad de lo contrario ya existe
         $bandera_dos valida_carrera_ben($id_cat_carrera, $ies, $_POST['entidad']);
         if ($bandera_dos > 0) {
            // obtenemos el id de qe si existe tambien la seleccion de la carrera para esa universidad sino si se define la variable $carrera
            print_r("retorna si existe en la lista para esa carrera")
            print_r($bandera_dos)
         }else {
            # code...
            print_r("define la variable y se le asigba el valor de id_cat_carrera a carrera");
         }

         print_r($bandera);
         die();
      }else {
         // print_r("No existe");
         insert_carrera($carrera_nombre);
         $id_busqueda = buscar_carrera($carrera_nombre);
         update_carrera($id_busqueda);
         $carrera = buscar_carrera_final($id_busqueda,$carrera_nombre);
         // print_r($carrera);
      }
      die();
      
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
