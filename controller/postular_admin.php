<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_POST["id"];
   $aplica = isset( $_POST['aplica']) ? $_POST['aplica'] : '';
   update_postular($id, $aplica);
?>
    <script>
       window.location="../view/candidato.php"
    </script>

<?php  }  ?>
  