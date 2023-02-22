<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_POST["id"];
   $clabe = isset( $_POST['clabe']) ? $_POST['clabe'] : '';
   update_datosbancarios($id, $clabe);
?>
    <script>
       window.location="../view/editar_ben_admin.php?ben=<?php echo $id; ?>"
    </script>   
<?php

}
