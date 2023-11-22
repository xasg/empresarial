<?php
   include_once('../model/database_emails.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start(); 
    $id=$_SESSION["id"];  
   if( $_POST )
   {  
   $nombre = isset( $_POST['nombreCandidato']) ? $_POST['nombreCandidato'] : '';
   $correo = isset( $_POST['correoCandidato']) ? $_POST['correoCandidato'] : '';
   $vacante = isset( $_POST['idvac']) ? $_POST['idvac'] : '';
   insert_candidato($nombre,$correo,$vacante);
?>
    <script>
       window.location="../view/consult_vacante_invite.php?vac=<?php echo $vacante ?>";
    </script>
<?php

}
