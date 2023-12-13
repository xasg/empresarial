<?php
   include_once('../model/database_emails.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start(); 
    $id=$_SESSION["id"];  
   if( $_POST )
   {  
      $correovalidado ="";
      $validavacante= "";
   $nombre = isset( $_POST['nombreCandidato']) ? $_POST['nombreCandidato'] : '';
   $correo = isset( $_POST['correoCandidato']) ? $_POST['correoCandidato'] : '';
   $vacante = isset( $_POST['idvac']) ? $_POST['idvac'] : '';
   $validacion = search_candidato($correo,$vacante);
   foreach ($validacion as $key => $valida) {
      $correovalidado = $valida['correo'];
      $validavacante = $valida['id_vacante'];
   }
   if ( $correovalidado == $correo && $validavacante == $vacante) {
      update_correo($nombre,$correo,$vacante);
      ?>
      <script>
         window.location="../view/invitar_vacante.php?vac=<?php echo $vacante ?>";
      </script>
      <?php
   }else{
   insert_candidato($nombre,$correo,$vacante);
   }
?>
    <script>
       window.location="../view/invitar_vacante.php?vac=<?php echo $vacante ?>";
    </script>
<?php

}
