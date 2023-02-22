<?php
     include_once('../model/databases_empresa.php');
   mysqli_set_charset( $mysqli, 'utf8'); 
   session_start(); 
   if( $_POST )
   {  
   $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : '';
   $correo = isset( $_POST['correo']) ? $_POST['correo'] : '';
   $password = isset( $_POST['password']) ? $_POST['password'] : '';
   $usuario =get_user_acces($correo);
   if($usuario==0){ 
   $est=2;  
   crear_usuario($correo, $password,  $est);
   $usuario =get_user_acces($correo);
   $id_user=$usuario['id_usuario'];
   crear_empresa($id_user, $nombre);
   crear_digital_empresa($id_user);
   crear_estatus($id_user);
   $empresa=view_empresa($id_user);      
   $_SESSION["id"]=$usuario['id_usuario'];
/**
   $para = $empresa['dt_correo'];
   $titulo = 'Registro Empresarial';
   $mensaje.= "<img src='http://empresarial.fese.mx/img/empresa.png'>"."<br><br><br>";
   $mensaje.= "<strong>Tu registro se realizó correctamente</strong> "." <br><br><br>";
   $mensaje.= "<strong>Empresa:</strong> ".$empresa['dt_razon_social']." <br>";
   $mensaje.= "<strong>Usuario:</strong> ".$empresa['dt_correo']." <br>";
   $mensaje.= "<strong>Contraseña:</strong> ".$empresa['dt_password']." <br><br><br><br>";
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
   window.location="../view/datos_empresa.php"
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