<?php
	include 'conec.php';
// 	$servername = "localhost";
// $dbname = "empresarial";
// $username = "root";
// $password = "";
	$mysqli = new mysqli($servername,$username,"",$dbname); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>