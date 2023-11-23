<?php
include_once('../model/database_emails.php');
mysqli_set_charset($mysqli, 'utf8');

if ($_REQUEST) {
    $id = $_REQUEST['vac'];
    global $mysqli;
    
    $sql = "SELECT * FROM candidatos_correos WHERE id='{$id}'";
    $res = $mysqli->query($sql);

    foreach ($res as $key => $value) {
        $vacante = $value['id_vacante'];
    }

    // Llamada a la función delete_vacante_correo
    if (delete_vacante_correo($id)) {
?>
    <script>
        window.location="../view/consult_vacante_invite.php?vac=<?php echo $vacante; ?>";
    </script>
<?php
    } else {
        echo "Error al eliminar la vacante del correo."; // Puedes personalizar el mensaje de error
    }
}
?>
