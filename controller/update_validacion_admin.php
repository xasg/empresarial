<?php
   include_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_POST["id"];
   //$valida=$_POST["valida"];
   $curp = isset( $_POST['curp']) ? $_POST['curp'] : '';
   $acta = isset( $_POST['acta']) ? $_POST['acta'] : '';
   $domicilio = isset( $_POST['domicilio']) ? $_POST['domicilio'] : '';
   $identificacion = isset( $_POST['identificacion']) ? $_POST['identificacion'] : '';
   $estudios = isset( $_POST['estudios']) ? $_POST['estudios'] : '';
   $seguro = isset( $_POST['seguro']) ? $_POST['seguro'] : '';
   $bancario = isset( $_POST['bancario']) ? $_POST['bancario'] : '';
   $aplica = isset( $_POST['aplica']) ? $_POST['aplica'] : '';
   $comentario = isset( $_POST['comentario']) ? $_POST['comentario'] : '';
   update_validacion($id, $valida, $curp, $acta, $domicilio, $identificacion, $estudios, $seguro, $bancario, $aplica, $comentario);
?>
    <script>
       window.location="../view/candidato.php"
    </script>   
<?php

}
