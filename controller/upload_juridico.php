<?php
include_once('../model/databases_empresa.php');
session_start();
 $id=$_POST['id'];
$charToBeReplaced=array("Á","É","Í","Ó","Ú","Ñ","á","é","í","ó","ú");
$charToReplace=array("A","E","I","O","U","N","a","e","i","o","u");
$deniedCharacter=array (" ","-","_","(",")","\\","/","\"");
$extensionDenied = array(".php",".css",".xls",".csv",".exe",".bat", ".sql",".html",".js",".htm","htm","xml",".asp",".aspx",">","<","?","include",".phtml",".exe");

$dir_docs="../docs/empresa/";
	if ((isset($_POST["MM_upload_file"])) && ($_POST["MM_upload_file"] == "formDocumentos")&&isset($dir_docs)) {
	if (isset($_FILES['file1'])&&$_FILES['file1']['error']==0) {
			$archivo_constancia= $_FILES["file1"]["tmp_name"];
			$destino= $dir_docs."CONSTANCIA_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["file1"]["name"])));
			move_uploaded_file($archivo_constancia,$destino); 
        $sql= sprintf("UPDATE cor_digital_empresa SET url_constancia='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);

		}



		if (isset($_FILES['file2'])&&$_FILES['file2']['error']==0) {
			$archivo_ine= $_FILES["file2"]["tmp_name"];
			$destino= $dir_docs."INE_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["file2"]["name"])));
			move_uploaded_file($archivo_ine,$destino); 
       $sql= sprintf("UPDATE cor_digital_empresa SET url_ine='$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
        		}

       	if (isset($_FILES['file3'])&&$_FILES['file3']['error']==0) {
			$archivo_acta= $_FILES["file3"]["tmp_name"];
			$destino= $dir_docs."ACTA_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["file3"]["name"])));
			move_uploaded_file($archivo_acta,$destino); 
       $sql= sprintf("UPDATE cor_digital_empresa SET url_acta = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
        		}

        if (isset($_FILES['file4'])&&$_FILES['file4']['error']==0) {
			$archivo_facultades= $_FILES["file4"]["tmp_name"];
			$destino= $dir_docs."FACULTADES_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["file4"]["name"])));
			move_uploaded_file($archivo_facultades,$destino); 
       $sql= sprintf("UPDATE cor_digital_empresa SET url_facultades = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
        		}

 if (isset($_FILES['file5'])&&$_FILES['file5']['error']==0) {
			$archivo_domicilio= $_FILES["file5"]["tmp_name"];
			$destino= $dir_docs."DOMICILIO_".$id."_".str_replace($charToBeReplaced,$charToReplace,str_replace($deniedCharacter,"",str_replace($extensionDenied,".fail",$_FILES["file5"]["name"])));
			move_uploaded_file($archivo_domicilio,$destino); 
       $sql= sprintf("UPDATE cor_digital_empresa SET dt_domicilio = '$destino' WHERE id_usuario=$id");
        $mysqli->query($sql);
        		}
        	
			      ?>
			      <script>
       					window.location="../view/edit_empresa_juridico.php?vac=<?php echo $id ?>"
    			  </script>
            <?php


	}

?>