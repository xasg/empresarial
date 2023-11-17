<?php
   include_once('../model/databases_empresa.php');
   mysqli_set_charset( $mysqli, 'utf8');
   if( $_POST )
   {  
   $id= $_POST['id_vacante'];
//    delete_vacante($id);
if (delete_vacante($id)) {
    
?>
    <script>
       window.location="../view/new_vacante_admin.php"
    </script>
<?php
}
}
?>