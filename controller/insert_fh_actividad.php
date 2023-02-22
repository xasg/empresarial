<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   if( $_POST )
   {  
   $dateinicio = isset( $_POST['date']) ? $_POST['date'] : '';
   $datefin = isset( $_POST['date2']) ? $_POST['date2'] : '';   
   insert_actividades($dateinicio, $datefin); 

?>
    <script>
       window.location="../view/catalogos.php"
    </script>
<?php

}
