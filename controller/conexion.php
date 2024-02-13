<?php
<<<<<<< HEAD

	//$mysqli = new mysqli("localhost","root","","empresa"); 
	$mysqli = new mysqli("localhost","root","","empresarial"); 
=======
// Se incluye la direccion de la instancia de las variables de la base de datos
include 'conec.php';
	$mysqli = new mysqli($servername,$username,$password,$dbname); 
	
>>>>>>> 2812096920ad8be6b2e633efd890cb43be9ebaef
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>