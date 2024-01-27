<?php

require ('../controller/conexion.php');
mysqli_set_charset( $mysqli, 'utf8');	
$id_cat_ies = $_POST['id_cat_ies'];	

// Obtener el valor del campo de entrada
$inputText = $_POST['inputText'];

// Realizar la consulta en la base de datos (ajusta según tu estructura de base de datos)
$sql = "SELECT * FROM cat_ies WHERE dt_nombre_ies LIKE '%$inputText%'";
$result = $conn->query($sql);

// Construir las opciones HTML
$options = "";
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $options .= "<option value='{$row['id_cat_ies']}'>{$row['dt_nombre_ies']}</option>";
  }
}

// Devolver las opciones al cliente
echo $options;