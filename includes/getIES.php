<?php
	require ('../controller/conexion.php');
	mysqli_set_charset( $mysqli, 'utf8');	
	$id_cat_entidad = $_POST['id_cat_entidad'];	
	$queryM = "SELECT relacion.id_cat_ies, dt_nombre_ies FROM relacion LEFT JOIN cat_ies ON(relacion.id_cat_ies=cat_ies.id_cat_ies) WHERE relacion.id_cat_entidad = '$id_cat_entidad' GROUP BY relacion.id_cat_ies ORDER BY relacion.id_cat_entidad";
	$resultadoM = $mysqli->query($queryM);	
	$html= "<option value='0'>Seleccionar IES</option>";	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['id_cat_ies']."'>".$rowM['dt_nombre_ies']."</option>";
	}
		echo $html;
?>