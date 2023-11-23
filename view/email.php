
<?php
   header('Content-Type: text/html; charset=UTF-8');
   require_once('../model/database_emails.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_REQUEST['enviarform'])) {
    $vacante = isset( $_POST['idvac']) ? $_POST['idvac'] : '';
    $empresa = obtener_empresa($vacante);
    foreach ($empresa as $key => $value) {
        $nom_comercial = $value['dt_nombre_comercial'];
        $nom_vacante = $value['dt_nombre'];
    }
    if (is_array($_REQUEST['correo'])) {
        $num_countries = count($_REQUEST['correo']);
        $columna   = 1;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="icon" type="image/png" href="imgs/logo-mywebsite-urian-viera.svg">

    <link rel="stylesheet" type="text/css" href="../css/material.min.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <title>Recibiendo Emails de clientes</title>
</head>

        <div class="row text-center mb-5">
            <div class="col-12">
                <p>Ha enviado un correo a: <strong>( <?php echo $num_countries; ?> )</strong> Registros
                    <hr>
                </p>
            </div>
        </div>

<?php
        foreach ($_REQUEST['correo'] as $key => $emailCliente) {
            // $nombreCandidato= $_REQUEST['nombre'];
            $cliente = $emailCliente;
            global $mysqli;
            $sql = "SELECT * FROM candidatos_correos Where correo = '{$cliente}'";
            $resultadoquery = $mysqli->query($sql);

            foreach ($resultadoquery as $key => $value) {
                $nombreCandidato = $value['nombre'];
            }

            $destinatario = trim($emailCliente); // Quitamos algún espacio en blanco
            $asunto       = "Correo Empresarial Fese";
            $cuerpo = '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Envio de email de forma masiva - Urian Viera</title>';
$cuerpo = '
<!DOCTYPE html>
<html lang="es">
<head>
<title>Envio de email de forma masiva - Urian Viera</title>';
$cuerpo .= ' 
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
        border-top: 3px solid #E64A19;
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
';

$cuerpo .= '
</head>
<body>
    <div class="contenedor">
        <img class="imgBanner" src="https://raw.githubusercontent.com/urian121/imagenes-proyectos-github/master/banner-correo-masivos-urian-viera.jpeg">
        <table style="max-width: 1400px; padding: 10px; margin:0 auto; border-collapse: collapse;">
            <tr>
                <td style="padding: 0; background-color: #ffffff;">
                    <div class="misection">
                        <h2 style="color: red; margin: 0 0 7px">Bienvenida practicante ' .$nom_comercial. ' - FESE </h2>
                        <p style="margin: 2px; font-size: 18px; text-align: justify;">Un gusto saludarte <b>'.$nombreCandidato.'</b>, soy <b> Andrei Ramírez </b>, de la <b>Fundación Educación Superior Empresa (FESE)</b>, quienes nos encargamos de la parte administrativa y dispersión de apoyos económicos de los practicantes de ' .$nom_comercial. '.</p>
                        <p style="margin: 5px; font-size: 18px; text-align: justify; margin-top: 45px; margin-bottom: 30px;">
                            El responsable del área de recursos humanos me ha comentado que has iniciado tus prácticas profesionales. Por esto, requiero que me apoyes en la realización de tu registro en nuestra plataforma, tendrás que adjuntar todos los documentos mencionados, tal cual se especifica: 
                        </p>
                        <a href="http://empresarial.fese.mx/"  style="border-radius: 12px; box-shadow: 0 0 10px #000; background: #E64A19; color: #fff; padding: 20px; text-decoration: none; margin-top: 60px ;">Da clic aqui</a>
                    
                        <h2 style="color: red; margin: 0 0 7px; margin-top: 50px;">Documentación requerida</h2>
                        <ol style="text-align: justify;">
                            <li>CV  </li>
                            <li>CURP</li>
                            <li>INE ambas caras o cualquier identificación oficial con fotografía vigente.</li>  
                            <li>Acta de Nacimiento</li>
                            <li>Comprobante de Domicilio con Código Postal que coincida con la dirección de tu INE. </li>
                            <li>Comprobante de estudios. Documento oficial de la institución que señale nombre del alumno, nombre de la escuela, carrera y créditos obtenidos al momento de hacer el registro.</li>
                            <li>Reporte de vigencia seguro médico facultativo IMSS, póliza del IMSS Bienestar o póliza de seguro médico privado. (vigente durante el periodo de la práctica).</li>
                            <li>
                                Comprobante de Cuenta Bancaria oficial del banco que mencione: Tu nombre como titular de la cuenta, nombre del banco, tipo de cuenta (débito o ahorro, pero no de nómina) y CLABE a 18 dígitos. Éste deberá de ser emitido por un banco oficial; no MercadoPago, no Oxxo, no NU, no RappiCard, no Banco del bienestar, no cajas de ahorro o similar.</li>
                        </ol>
                        <p style="margin: 5px; font-size: 18px; text-align: justify; margin-top: 45px; margin-bottom: 30px;">En caso de tener dudas, revisa el siguiente tutorial</p>
                        <a href="https://www.youtube.com/watch?v=PGSPy7U__Kc" style="border-radius: 12px; box-shadow: 0 0 10px #000; background: #E64A19; color: #fff; padding: 20px; text-decoration: none; margin-top: 60px ;">Ver tutorial</a>
                        <p style="margin: 5px; font-size: 18px; text-align: justify; margin-top: 45px; margin-bottom: 30px;">
                        En la parte final del proceso, te pedirá que elijas una vacante, la tuya se llama '.$nom_vacante.'.  
                        </p>
                    
                    </div>
                </td>
            </tr>
            <tr>
                <td style="background-color: #ffffff;">
                    <div class="misection">
                        <p>Es importante que realices esto lo antes posible, ya que es uno de los pasos del proceso que tienen que realizar. El siguiente será el convenio, mismo que deberás firmar y subir a la plataforma, de lo contrario no se podrá realizar el depósito de tu apoyo económico. Si tienes alguna duda, contáctame.   
                            <br><br><br>
                            Muchas gracias y excelente día.     
                        </p>
                        <p>
                            <b>Andrei Ramírez <br>  
                                5527662150 </b>
                        </p>
                    </div>

                </td>
            </tr>
         
        </table>';

$cuerpo .= '
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
                $mail->setFrom('aramirez@fese.mx', 'EMPRESARIAL FESE.');
                $mail->isHTML(true);
                $mail->Subject = $asunto;
                $mail->Body    = $cuerpo;

                // Envío del correo
                $mail->send();
                actualiza_status($cliente);
  


                echo '<div>' . $columna . "). " . $emailCliente . '</div>';
                $columna++;
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }
    }
}
?>

<div class="row text-center mt-5 mb-5">
    <div class="col-12">
        <a href="consult_vacante_invite.php?vac=<?php echo $vacante ?>" class="btn btn-round btn-primary">Volver al Inicio</a>
    </div>
</div>
</div>
</body>

</html>
