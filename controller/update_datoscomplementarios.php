<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_SESSION["id"];
   $idioma = isset( $_POST['idioma']) ? $_POST['idioma'] : '';
   $nivel = isset( $_POST['nivel']) ? $_POST['nivel'] : '';
   update_datoscomplementarios($id, $idioma, $nivel); 
    $estatus=2+1;
   update_estatus($id, $estatus);
?>
    <script>
       window.location="../view/digitales.php"
    </script>
<?php

}
