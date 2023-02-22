<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_POST["id"];
   $matricula = isset( $_POST['matricula']) ? $_POST['matricula'] : '';
   $periodo = isset( $_POST['periodo']) ? $_POST['periodo'] : '';
   $no_periodo = isset( $_POST['no_periodo']) ? $_POST['no_periodo'] : '';
   $no_creditos = isset( $_POST['no_creditos']) ? $_POST['no_creditos'] : '';
   update_datosacademicos($id, $matricula, $periodo, $no_periodo, $no_creditos);
?>
    <script>
       window.location="../view/validar_cand.php?ben=<?php echo $id; ?>"
    </script>   
<?php

}
