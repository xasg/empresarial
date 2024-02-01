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
   
  


   $sql = "UPDATE `beneficiario` 
            SET beneficiario.tp_status_beneficiario = '-2' 
            WHERE id_usuario = '$id'";  // Usar el valor de la variable $id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $dia = $_POST["dia"];
    $mes = $_POST["mes"];
    $año = $_POST["año"];

    // Llamar a la función para procesar la fecha
    procesarFecha($dia, $mes, $año);
    function procesarFecha($dia, $mes, $año) {
        // Validar los datos recibidos
        if ($dia >= 1 && $dia <= 31 && $mes >= 1 && $mes <= 12 && $año >= 1900 && $año <= 2099) {
            // Crear una cadena de fecha en formato 'YYYY-MM-DD'
            $fecha = "$año-$mes-$dia";
            
            // Aquí puedes realizar cualquier acción con la fecha, como almacenarla en la base de datos
            // Por ejemplo, podrías usar MySQLi o PDO para conectarte y ejecutar la consulta SQL
            // Ejemplo de conexión utilizando MySQLi
            
            
            // Verificar la conexión
            if ($mysqli->connect_error) {
                die("Error de conexión: " . $mysqli->connect_error);
            }
            
            // Ejecutar la consulta SQL para actualizar la base de datos
            $sql = "UPDATE vacante SET dt_extencion_fecha_vacante = '$fecha'";
            if ($mysqli->query($sql) === TRUE) {
                echo "Registro actualizado correctamente";
            } else {
                echo "Error al actualizar el registro: " . $mysqli->error;
            }
            
            // Cerrar la conexión
            $mysqli->close();
        } else {
            echo "Los datos de la fecha son inválidos.";
        }
    }

}
    
   
    header("Location: beneficiario.php");





   ?>