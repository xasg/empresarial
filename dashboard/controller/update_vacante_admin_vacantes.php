<?php
include_once('../model/database_admin.php');
mysqli_set_charset($mysqli, 'utf8');
session_start();

if ($_POST) {
    $idUser = isset($_POST['id_usuario_empresa']) ? $_POST['id_usuario_empresa'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $numero = isset($_POST['numero']) ? $_POST['numero'] : '';
    $carrera = isset($_POST['carrera']) ? $_POST['carrera'] : '';
    $inicio = isset($_POST['date']) ? $_POST['date'] : '';
    $termino = isset($_POST['date2']) ? $_POST['date2'] : '';
    $hr_inicio = isset($_POST['hr_inicio']) ? $_POST['hr_inicio'] : '';
    $hr_termino = isset($_POST['hr_termino']) ? $_POST['hr_termino'] : '';
    $apoyo = isset($_POST['apoyo']) ? $_POST['apoyo'] : '';
    $dispersion = isset($_POST['dispersion']) ? $_POST['dispersion'] : '';

    // global $mysqli;
    // $sql = "SELECT * FROM empresa WHERE dt_razon_social = '{$nom_comercial}'  OR dt_nombre_comercial = '{$nom_comercial}' ";
    // $response = $mysqli->query($sql);
    // $id ="";
    // foreach ($response as $value) {
    //     $id = $value['id_usuario'];
    // }
    if (insert_vacante_admin($idUser, $nombre, $numero, $carrera, $inicio, $termino, $hr_inicio, $hr_termino, $apoyo, $dispersion)) {
        header('location:../view/vacantes.php');
    }
    header('location:../view/vacantes.php?vacante="creada"');
}
?>