<?php
include_once('../model/databases_admin.php');
mysqli_set_charset($mysqli, 'utf8');

if ($_REQUEST) {
    $id = $_REQUEST['vac'];
    global $mysqli;

    // Evita posibles ataques de inyección SQL utilizando consultas preparadas
    $sql = "SELECT * FROM empresa WHERE id_empresa=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $res = $stmt->get_result();

    // Verifica si se encontró la empresa antes de intentar acceder a sus datos
    if ($res->num_rows > 0) {
        $id_user = $res->fetch_assoc();
        $usuario = $id_user['id_usuario'];

        // Llamada a la función delete_vacante_correo
        if (delete_empresa($id) && delete_empresa_usuario($usuario) && delete_empresa_usuario_vacante($usuario)) {
            ?>
            <script>
                window.location="../view/empresarial_bajas.php?eliminado=si";
            </script>
            <?php
            die(); // Termina la ejecución del script después de redirigir
        } else {
            echo "Error al eliminar la empresa o el usuario asociado.";
        }
    } else {
        echo "No se encontró la empresa con ID: $id";
        echo "<a class='btn btn-default' href='../view/empresarial_bajas.php'>Regresar</a>";
    }

    $stmt->close(); // Cierra la consulta preparada
}
?>
