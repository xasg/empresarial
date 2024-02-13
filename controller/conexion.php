<?php

	//$mysqli = new mysqli("localhost","root","","empresa"); 
	$mysqli = new mysqli("localhost","root","","empresarial"); 
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>