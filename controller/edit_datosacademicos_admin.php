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
   } else if (isset($_POST["accion"]) && $_POST["accion"] == "carrera") {
      // Acción para el botón "ies" 
       if ($_POST['nueva_carrera']) {
           $ies = isset($_POST['id_ies']) ? $_POST['id_ies'] : '';
           $entidad = isset($_POST['id_entidad']) ? $_POST['id_entidad'] : ''; 
           $carrera = isset($_POST['id_carrera']) ? $_POST['id_carrera'] : ''; 
           insertar_relacion_carrera($entidad,$ies,$carrera);
         //   $id_relacion_busqueda = buscar_relacion($entidad,$ies,$carrera);
           $id_relacion = buscar_relacion($entidad,$ies,$carrera);
         //   if ($id_relacion_busqueda == 0) {
               
           
               
         //    }
           
         // print_r($id_relacion);
         // die();
           if (update_relacion_carrera($carrera,$id_relacion)) {
            ?>
       <script>
          window.location="../view/editar_cand_admin.php?ben=<?php echo $id; ?>"
       </script> 
            <?php
            }

           die();
        
   
         }else{
            ?>
            <script>
                window.location="../view/editar_cand_admin.php?ben=<?php echo $id; ?>&err=errordeinsercion";
            </script>
            <?php
        }
      
      die();
   }
   
