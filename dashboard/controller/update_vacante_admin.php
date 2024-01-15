<?php
   include_once('../model/databases_empresa.php');
   mysqli_set_charset( $mysqli, 'utf8');   
   session_start();  
   if( $_POST )
   {  
   $id=$_POST["id"];
   $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : '';
   $numero = isset( $_POST['numero']) ? $_POST['numero'] : '';
   $carrera = isset( $_POST['carrera']) ? $_POST['carrera'] : '';
   $inicio = isset( $_POST['inicio']) ? $_POST['inicio'] : '';
   $termino = isset( $_POST['termino']) ? $_POST['termino'] : '';
   $hr_inicio = isset( $_POST['hr_inicio']) ? $_POST['hr_inicio'] : '';
   $hr_termino = isset( $_POST['hr_termino']) ? $_POST['hr_termino'] : '';
   $actividad = isset( $_POST['actividad']) ? $_POST['actividad'] : '';
   $area = isset( $_POST['area']) ? $_POST['area'] : '';
   $apoyo = isset( $_POST['apoyo']) ? $_POST['apoyo'] : '';
   $dispersion = isset( $_POST['dispersion']) ? $_POST['dispersion'] : '';   
   $competencia = isset( $_POST['competencia']) ? $_POST['competencia'] : '';
   $descripcion = isset( $_POST['descripcion']) ? $_POST['descripcion'] : '';
   $tutor = isset( $_POST['tutor']) ? $_POST['tutor'] : '';
   $cargo = isset( $_POST['cargo']) ? $_POST['cargo'] : '';
   update_vacante_admin($id, $nombre, $numero, $carrera, $inicio, $termino, $hr_inicio, $hr_termino, $actividad, $area, $apoyo, $dispersion, $competencia, $descripcion, $tutor, $cargo);     
?>
    <script>
       window.location="../view/editar_vacante.php?vac=<?php echo $id;?>"
    </script>
<?php

}


