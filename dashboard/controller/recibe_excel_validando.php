<?php
require('../model/database_emails.php');

$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas = file($archivotmp);
$vacante = isset($_POST['idvac']) ? $_POST['idvac'] : '';
$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados = ($cantidad_registros - 1);

    if ($i != 0) {

        // Definir los posibles delimitadores
        $posibles_delimitadores = array(';', ',');

        // Inicializar el delimitador como nulo
        $delimitador = null;

        // Iterar sobre los posibles delimitadores
        foreach ($posibles_delimitadores as $d) {
            // Comprobar si la línea contiene el delimitador actual
            if (strpos($linea, $d) !== false) {
                $delimitador = $d;
                break;
            }
        }

        // Si no se encuentra un delimitador válido, mostrar un mensaje de error o manejarlo de acuerdo a tus necesidades
        if ($delimitador === null) {
            die("No se pudo determinar el delimitador en la línea: $linea");
        }

        // Usar el delimitador encontrado para dividir los datos
        $datos = explode($delimitador, $linea);

        $nombre = !empty($datos[0]) ? trim($datos[0]) : '';
        $correo = !empty($datos[1]) ? trim($datos[1]) : '';

        if (!empty($correo)) {
            $ca_dupli = search_candidato($correo, $vacante);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }

        // No existe Registros Duplicados
        if ($cant_duplicidad == 0) {
            insert_data($nombre, $correo, $vacante);
        } else {
            update_correo($nombre, $correo, $vacante);
        }

        ?>
        <script>
            window.location="../view/invitar_vacante.php?vac=<?php echo $vacante ?>";
        </script>
        <?php
    }

    $i++;
}

// Enlace para regresar
echo '<a href="index.php">Atras</a>';
?>
