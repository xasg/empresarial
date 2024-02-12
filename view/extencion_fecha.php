<?php      
   
   include_once('../model/databases_beneficiario.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   // Verificar si la sesión está iniciada
    if (!isset($_SESSION['id'])) {
      // La sesión no está iniciada, redireccionar a la página de inicio de sesión
      header('Location: ../index.php');
      exit(); // Asegurarse de que el script se detenga después de la redirección
    }
    
    $dia = $_POST["dia"];
    $mes = $_POST["mes"];
    $año = $_POST["año"];
    $id = $_POST["id"]; // Obtener el valor del campo oculto
    $id_empresa =  $_POST["idempresa"]; // Obtener el valor del campo oculto

    

   // echo "el dia es ".$dia." el mes es ".$mes. " el año es ".$año." el id es ".$id. "y este es el id de empresa".$id_empresa;
    procesarFecha($dia, $mes, $año, $id,$id_empresa);
    header("Location: beneficiario.php");
   ?>