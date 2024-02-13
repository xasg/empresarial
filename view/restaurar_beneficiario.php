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
   $id=$_GET['ben'];
   $sql = "UPDATE `beneficiario` 
            SET beneficiario.tp_status_beneficiario = 1
            WHERE id_usuario = '$id'";  // Usar el valor de la variable $id
    if ($mysqli->query($sql) === TRUE) 
    {
        echo "Consulta ejecutada con éxito";
    } else 
    {
        echo "Error al ejecutar la consulta: " . $mysqli->error;
    }
    header("Location: beneficiario_bajas.php");
   ?>