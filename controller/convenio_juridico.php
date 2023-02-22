<?php
include_once('../model/databases_beneficiario.php');
session_start();
 $id=$_POST["id"];
$charToBeReplaced=array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú");
$charToReplace=array("A","E","I","O","U","N","a","e","i","o","u");
$deniedCharacter=array (" ","-","_","(",")","\\","/","\"");
$extensionDenied = array(".php",".css",".xls",".csv",".exe",".bat", ".sql",".html",".js",".htm","htm","xml",".asp",".aspx",">","<","?","include",".phtml",".exe");
$dir_docs="../docs/beneficiario/";

  if ((isset($_POST["MM_upload_file"])) && ($_POST["MM_upload_file"] == "formDocumentos")&&isset($dir_docs)) {
     $entregacontacto = isset( $_POST['contacto']) ? $_POST['contacto'] : '';
     $tipocont = isset( $_POST['cont']) ? $_POST['cont'] : '';
      update_dig_con($id, $entregacontacto, $tipocont);
  if (isset($_FILES['convenio1'])&&$_FILES['convenio1']['error']==0) {
      $archivo_conv1= $_FILES["convenio1"]["tmp_name"];
      $destino= $dir_docs."CONV1_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["convenio1"]["name"])));
        move_uploaded_file($archivo_conv1,$destino); 
        $sql= sprintf("UPDATE digital_beneficiario SET url_convenio1='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
    }   

      ?>
                <script>
                    window.location="../view/juridico.php"
                </script>
            <?php


  }

?>
  