<?php
include_once('../model/databases_empresa.php');
mysqli_set_charset($mysqli, 'utf8');
session_start();

if ($_POST) {
    $nom_comercial = isset($_POST['id_usuario_empresa']) ? $_POST['id_usuario_empresa'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
    $inicio = isset($_POST['date']) ? $_POST['date'] : '';
    $termino = isset($_POST['date2']) ? $_POST['date2'] : '';
    $hr_inicio = isset($_POST['hr_inicio']) ? $_POST['hr_inicio'] : '';
    $hr_termino = isset($_POST['hr_termino']) ? $_POST['hr_termino'] : '';
    $apoyo = isset($_POST['apoyo']) ? $_POST['apoyo'] : '';
    $dispersion = isset($_POST['dispersion']) ? $_POST['dispersion'] : '';

    global $mysqli;
    $sql = "SELECT * FROM empresa WHERE dt_nombre_comercial = '{$nom_comercial}'";
    $response = $mysqli->query($sql);

    foreach ($response as $key => $value) {
        $id = $value['id_usuario'];
    }
    if (insert_vacante_admin($id, $nombre, $numero, $carrera, $inicio, $termino, $hr_inicio, $hr_termino, $apoyo, $dispersion)) {
        header('location:../view/new_vacante_admin_view.php');
    }
    header('location:../view/new_vacante_admin_view.php?vacante="creada"');
}
?>
