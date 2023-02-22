<?php
include_once('../model/databases_beneficiario.php');
session_start();
$id=$_SESSION["id"];
$charToBeReplaced=array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú");
$charToReplace=array("A","E","I","O","U","N","a","e","i","o","u");
$deniedCharacter=array (" ","-","_","(",")","\\","/","\"");
$extensionDenied = array(".php",".css",".xls",".csv",".exe",".bat", ".sql",".html",".js",".htm","htm","xml",".asp",".aspx",">","<","?","include",".phtml",".exe");
$dir_docs="../docs/beneficiario/";

  if ((isset($_POST["MM_upload_file"])) && ($_POST["MM_upload_file"] == "formDocumentos")&&isset($dir_docs)) {   
   $valida=$_POST["valida"];
   update_valida($id, $valida);
  if (isset($_FILES['cv'])&&$_FILES['cv']['error']==0) {
      $archivo_cv= $_FILES["cv"]["tmp_name"];
      $destino= $dir_docs."CV_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["cv"]["name"])));
      move_uploaded_file($archivo_cv,$destino); 
        $sql= sprintf("UPDATE digital_beneficiario SET url_cv='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
    }

    if (isset($_FILES['curp'])&&$_FILES['curp']['error']==0) {
      $archivo_curp= $_FILES["curp"]["tmp_name"];
      $destino= $dir_docs."CURP_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["curp"]["name"])));
      move_uploaded_file($archivo_curp,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_curp='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
            }

        if (isset($_FILES['acta'])&&$_FILES['acta']['error']==0) {
      $archivo_acta= $_FILES["acta"]["tmp_name"];
      $destino= $dir_docs."ACTA_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["acta"]["name"])));
      move_uploaded_file($archivo_acta,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_acta = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
            }

        if (isset($_FILES['domicilio'])&&$_FILES['domicilio']['error']==0) {
      $archivo_domicilio= $_FILES["domicilio"]["tmp_name"];
      $destino= $dir_docs."DOM_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["domicilio"]["name"])));
      move_uploaded_file($archivo_domicilio,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_com_domicilio = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
            }

        if (isset($_FILES['identificacion'])&&$_FILES['identificacion']['error']==0) {
      $archivo_identificacion= $_FILES["identificacion"]["tmp_name"];
      $destino= $dir_docs."IDEN_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["identificacion"]["name"])));
      move_uploaded_file($archivo_identificacion,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_identificacion = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
                    }

                    if (isset($_FILES['com_estudios'])&&$_FILES['com_estudios']['error']==0) {
      $archivo_com_estudios= $_FILES["com_estudios"]["tmp_name"];
      $destino= $dir_docs."EST_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["com_estudios"]["name"])));
      move_uploaded_file($archivo_com_estudios,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_com_estudios = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
                    }

                    if (isset($_FILES['seguro'])&&$_FILES['seguro']['error']==0) {
      $archivo_seguro= $_FILES["seguro"]["tmp_name"];
      $destino= $dir_docs."SEGURO_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["seguro"]["name"])));
      move_uploaded_file($archivo_seguro,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_seguro = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
                    }

                    if (isset($_FILES['cuenta'])&&$_FILES['cuenta']['error']==0) {
      $archivo_cuenta= $_FILES["cuenta"]["tmp_name"];
      $destino= $dir_docs."CUENTA_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["cuenta"]["name"])));
      move_uploaded_file($archivo_cuenta,$destino); 
       $sql= sprintf("UPDATE digital_beneficiario SET url_cuenta = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
                    }
          
      ?>
                <script>
                    window.location="../view/select_vacante.php"
                </script>
            <?php


  }

?>