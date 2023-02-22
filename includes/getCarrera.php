<?php
	require ('../controller/conexion.php');
	mysqli_set_charset( $mysqli, 'utf8');	
	$id_cat_ies = $_POST['id_cat_ies'];	
	$queryM = "SELECT relacion.id_cat_carrera, dt_nombre_carrera FROM relacion LEFT JOIN cat_carrera ON(relacion.id_cat_carrera=cat_carrera.id_cat_carrera) WHERE relacion.id_cat_ies = '$id_cat_ies' GROUP BY relacion.id_cat_carrera ORDER BY relacion.dt_tipo, relacion.id_cat_carrera";
	$resultadoM = $mysqli->query($queryM);	
	$html= "<option value='0'>Seleccionar Carrera</option>";	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_cat_carrera']."'>".$rowM['dt_nombre_carrera']."</option>";
	}
	
	echo $html;
?>

