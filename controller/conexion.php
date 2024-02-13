<?php
// Se incluye la direccion de la instancia de las variables de la base de datos

include_once 'conec.php';
	$mysqli = new mysqli($servername,$username,$password,$dbname); 		
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>