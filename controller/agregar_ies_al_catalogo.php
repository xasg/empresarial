<?php
   include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8');
   session_start();

    $id=$_SESSION["id"]; 
    $id_ben=$_SESSION["beneficiario"]; 
    if ($_POST['nueva_ies']) {
        $ies = isset($_POST['id_ies']) ? $_POST['id_ies'] : '';
        $entidad = isset($_POST['id_entidad']) ? : ''; 
        
        die();
        if (insertar_relacion($entidad, $ies)) {
            // header("location: ../view/editar_cand_admin.php?ben=".$id_ben);
        }

    }
