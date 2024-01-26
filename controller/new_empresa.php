<?php
   session_start(); 
   include_once('../model/databases_empresa.php');
   mysqli_set_charset( $mysqli, 'utf8'); 
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   require '../PHPMailer/src/Exception.php';
   require '../PHPMailer/src/PHPMailer.php';
   require '../PHPMailer/src/SMTP.php';
   
   
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


   $emailCliente = 'malfatapia1@gmail.com';
   $destinatario = trim($emailCliente); // Quitamos algún espacio en blanco
   $asunto       = "Empresarial - REGISTRO DE EMPRESA";
   $cuerpo = '
   <!DOCTYPE html>
   <html lang="es">
   <head>
       <meta charset="UTF-8">
       <title>REGISTRO DE NUEVA EMPRESA</title>
       <style>
           * {
               margin: 0;
               padding: 0;
               box-sizing: border-box;
           }
           body {
               font-family: "Roboto", sans-serif;
               font-size: 16px;
               font-weight: 300;
               color: #888;
               background-color: rgba(230, 225, 225, 0.5);
               line-height: 30px;
               text-align: center;
           }
           .contenedor {
               width: 100%;
               min-height: auto;
               text-align: center;
               margin: 0 auto;
               background: #ececec;
               border-top: 8px solid #0D4D5B;
           }
           .btnlink {
               padding: 15px 30px;
               text-align: center;
               background-color: #cecece;
               color: crimson !important;
               font-weight: 600;
               text-decoration: blue;
           }
           .btnlink:hover {
               color: #fff !important;
           }
           .imgBanner {
               max-width: 100%;
               margin-left: auto;
               margin-right: auto;
               display: block;
               padding: 0px;
           }
           .misection {
               color: #34495e;
               margin: 4% 10% 2%;
               text-align: center;
               font-family: sans-serif;
           }
           .mt-5 {
               margin-top: 50px;
           }
           .mb-5 {
               margin-bottom: 50px;
           }
       </style>
   </head>
   <body>
       <div class="contenedor">
           <table style="max-width: 1400px; padding: 10px; margin:0 auto; border-collapse: collapse;">
               <tbody>
                   <tr>
                       <td style="padding: 0; background-color: #ffffff;">
                           <div class="misection">
                               <h2 style="color: #0D4D5B; margin: 0 0 7px">Nuevo registro a la plataforma EMPRESARIAL - FESE </h2>
                               <h3 style="color: #0D4D5B; margin: auto; text-align:center; border-radius:8px; background:#330867;">Datos de la empresa</h3>
                               <ol style="text-align: justify;">
                                   <li><strong>Empresa:</strong> '.$empresa['dt_razon_social'].'</li>
                                   <li><strong>Usuario:</strong> '.$empresa['dt_correo'].'</li>
                                   <li><strong>Contraseña:</strong> '.$empresa['dt_password'].'</li>
                               </ol>
                              <br>
                              <br>
                               <a href="http://empresarial.fese.mx/admin.php" style="border-radius: 12px; box-shadow: 0 0 10px #000; background: #330867; color: #fff; padding: 15px; text-decoration: none; margin-top: 100px ;">Validar Registro</a>
   
                               <p style="margin: 5px; font-size: 18px; text-align: justify; margin-top: 45px; margin-bottom: 30px; ">En caso de tener dudas, revisa el siguiente tutorial</p>
                               <a href="https://www.youtube.com/watch?v=PGSPy7U__Kc" style="border-radius: 12px; box-shadow: 0 0 10px #000; background: #330867; color: #fff; padding: 15px; text-decoration: none; margin-top: 60px ; margin-bottom:60px;">Ver tutorial</a>
                               <br><br>
                           </div>
                       </td>
                   </tr>
               </tbody>
           </table>
       </div>
   </body>
   </html>';
   
   // Configuración de PHPMailer
   $mail = new PHPMailer(true);

   try {
       $mail->CharSet = 'UTF-8';
       $mail->isSMTP();
       $mail->Host       = 'mail.fese.org.mx';
       $mail->SMTPAuth   = true;
       $mail->Username   = 'inaes@fese.org.mx';
       $mail->Password   = 'HeVr1043D';
       $mail->SMTPSecure = 'ssl';
       $mail->Port       = 465;

       // Destinatario
       $mail->addAddress($destinatario);

       // Cabecera Obligatoria
       $mail->setFrom('empresarial@fese.mx', 'EMPRESARIAL FESE.');
       $mail->isHTML(true);
       $mail->Subject = $asunto;
       $mail->Body    = $cuerpo;

       // Envío del correo
       $mail->send();

   } catch (Exception $e) {
       echo "Error al enviar el correo: {$mail->ErrorInfo}";
   }

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