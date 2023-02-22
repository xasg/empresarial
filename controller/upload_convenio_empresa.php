<?php
include_once('../model/databases_admin.php');
session_start();
 $id=$_POST["id"];
$charToBeReplaced=array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú");
$charToReplace=array("A","E","I","O","U","N","a","e","i","o","u");
$deniedCharacter=array (" ","-","_","(",")","\\","/","\"");
$extensionDenied = array(".php",".css",".xls",".csv",".exe",".bat", ".sql",".html",".js",".htm","htm","xml",".asp",".aspx",">","<","?","include",".phtml",".exe");
$dir_docs="../docs/empresa/";

  if ((isset($_POST["MM_upload_file"])) && ($_POST["MM_upload_file"] == "formDocumentos")&&isset($dir_docs)) {
  if (isset($_FILES['convenio'])&&$_FILES['convenio']['error']==0) {
      $archivo_conv= $_FILES["convenio"]["tmp_name"];
      $destino= $dir_docs."CONV_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["convenio"]["name"])));
        move_uploaded_file($archivo_conv,$destino); 
        $sql= sprintf("UPDATE cor_digital_empresa SET url_convenio='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
    }   

      ?>
                <script>
                    window.location="../view/empresarial_juridico.php"
                </script>
            <?php


  }

?>
  