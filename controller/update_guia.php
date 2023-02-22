<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');   
   session_start();  
   if( $_POST )
   {  
   $id=$_SESSION["id"];
   $paqueteria = isset( $_POST['paqueteria']) ? $_POST['paqueteria'] : '';
   $guia = isset( $_POST['guia']) ? $_POST['guia'] : '';
   update_guia($id, $paqueteria, $guia); 
    
?>
    <script>
       window.location="../view/select_vacante.php"
    </script>
<?php

}


