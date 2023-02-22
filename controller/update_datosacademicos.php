<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();   
   if( $_POST )
   {  
   $id=$_SESSION["id"];
   $ies = isset( $_POST['ies']) ? $_POST['ies'] : '';
   $carrera = isset( $_POST['carrera']) ? $_POST['carrera'] : '';
   $matricula = isset( $_POST['matricula']) ? $_POST['matricula'] : '';
   $periodo = isset( $_POST['periodo']) ? $_POST['periodo'] : '';
   $no_periodo = isset( $_POST['no_periodo']) ? $_POST['no_periodo'] : '';
   $no_creditos = isset( $_POST['no_creditos']) ? $_POST['no_creditos'] : '';
   $hab = isset( $_POST['habilidades']) ? $_POST['habilidades'] : '';
   $habilidades = implode(",", $hab); 
   update_datosacademicos($id, $ies, $carrera, $matricula, $periodo, $no_periodo, $no_creditos, $habilidades); 
   $estatus=1+1;
   update_estatus($id, $estatus);
?>
    <script>
       window.location="../view/datoscomplementarios.php"
    </script>
<?php

}
