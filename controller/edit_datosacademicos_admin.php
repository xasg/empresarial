<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   $id=$_POST["id"];
   if (isset($_POST["accion"]) && $_POST["accion"] == "datos") {
      // Acción para el botón "datos"
      
      $matricula = isset( $_POST['matricula']) ? $_POST['matricula'] : '';
      $periodo = isset( $_POST['periodo']) ? $_POST['periodo'] : '';
      $no_periodo = isset( $_POST['no_periodo']) ? $_POST['no_periodo'] : '';
      $no_creditos = isset( $_POST['no_creditos']) ? $_POST['no_creditos'] : '';
      update_datosacademicos($id, $matricula, $periodo, $no_periodo, $no_creditos);
      if ($_POST['nombre_ies']) {
         $id_ies = isset($_POST['id_ies']) ? $_POST['id_ies'] : '';
         $nombre_ies = isset($_POST['nombre_ies']) ? $_POST['nombre_ies'] : '';
         update_ies($nombre_ies,$id_ies);
      }
   ?>
       <script>
          window.location="../view/editar_cand_admin.php?ben=<?php echo $id; ?>"
       </script>   
   <?php   
      die();
   }else if (isset($_POST["accion"]) && $_POST["accion"] == "ies") {
      // Acción para el botón "ies"
      // include_once('../model/databases_beneficiario.php');
      // mysqli_set_charset( $mysqli, 'utf8');
      // session_start(); 
      //  $id_ben=$_SESSION["beneficiario"]; 
       if ($_POST['nueva_ies']) {
           $ies = isset($_POST['id_ies']) ? $_POST['id_ies'] : '';
           $entidad = isset($_POST['id_entidad']) ? $_POST['id_entidad'] : ''; 
           if (insertar_relacion($entidad, $ies)) {
            ?>
       <script>
          window.location="../view/editar_cand_admin.php?ben=<?php echo $id; ?>"
       </script> 
            <?php
            }

           die();
        
   
       }
      
      die();
   }
   
