<?php
   session_start(); 
   include_once('../model/databases_new_usuario.php');
   mysqli_set_charset( $mysqli, 'utf8');    
   if($_POST)
   {  
   $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : '';
   $apaterno = isset( $_POST['apaterno']) ? $_POST['apaterno'] : '';
   $amaterno = isset( $_POST['amaterno']) ? $_POST['amaterno'] : '';
   $correo = isset( $_POST['correo']) ? $_POST['correo'] : '';
   $password = isset( $_POST['password']) ? $_POST['password'] : '';
   $usuario =acces_usuario($correo);
   if($usuario==0){ 
   $est=2;  
   crear_usuario($correo, $password, $est);
   $usuario =acces_usuario($correo);
   $id_user=$usuario['id_usuario'];
   crear_beneficiario($id_user, $nombre, $apaterno, $amaterno);
   crear_digital_beneficiario($id_user);
   crear_estatus($id_user); 
   crear_evaluacion($id_user);     
   $_SESSION["id"]=$usuario['id_usuario'];
/**

   $para = $empresa['dt_email'];
   $titulo = 'Registro Lideres ANUIES 2018';
   $mensaje.= "<img src='http://empresarial.fese.mx/img/empresa.png'>"."<br><br><br>";
   $mensaje.= "<strong>Tu registro se realizó correctamente</strong> "." <br><br><br>";
   $mensaje.= "<strong>Nombre:</strong> ".$empresa['dt_nombre']. " ".$empresa['dt_apaterno']. " ".$empresa['dt_amaterno']." <br>";
   $mensaje.= "<strong>Usuario:</strong> ".$empresa['dt_email']." <br>";
   $mensaje.= "<strong>Contraseña:</strong> ".$empresa['password']." <br><br><br><br>";
   $mensaje.= "<strong>CONTACTO</strong> "." <br>";
   $mensaje.= " daniela.claro@fese.org.mx"." <br>";
   $mensaje.= "Tel. (55) 4626 8266  ext. 8253"." <br>";
   // Para enviar un correo HTML, debe establecerse la cabecera Content-type
   $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
   $cabeceras = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $enviado = mail($para, $titulo, $mensaje, $cabeceras); 
**/
   ?>
<script>
   window.location="../view/datospersonales.php"
</script>
<?php
}else{
//caso contario (else) es porque ese user ya esta registrado 
 ?>
<script>
   window.location="existe.php"
</script>
<?php

}
   }

   ?>