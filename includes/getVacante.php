<?php
	require ('../controller/conexion.php');
	mysqli_set_charset( $mysqli, 'utf8');	
	$id_empresa = $_POST['id_usuario'];	
	$queryM = "SELECT id_vacante, dt_nombre FROM vacante WHERE id_usuario = '$id_empresa' AND tp_status=1 ORDER BY dt_nombre";
	$resultadoM = $mysqli->query($queryM);
	
	$html= "<option value='0'>Seleccionar Vacante</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_vacante']."'>".$rowM['dt_nombre']."</option>";
	}
	
	echo $html;
?>