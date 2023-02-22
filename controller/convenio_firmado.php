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
  if (isset($_FILES['convenio2'])&&$_FILES['convenio2']['error']==0) {
      $archivo_cv= $_FILES["convenio2"]["tmp_name"];
      $destino= $dir_docs."CON2_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["convenio2"]["name"])));
      move_uploaded_file($archivo_cv,$destino); 
        $sql= sprintf("UPDATE digital_beneficiario SET url_convenio2='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
    }

   
          
      ?>
                <script>
                    window.location="../view/select_vacante.php"
                </script>
            <?php


  }

?>