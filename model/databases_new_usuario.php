<?php
require_once('../controller/conec.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';
if( $mysqli->connect_errno )
{
  echo '';
  exit;
}


function crear_usuario($correo, $password,  $est)
{
global $mysqli;
$sql="INSERT INTO usuario(id_usuario, dt_correo, dt_password, tp_usuario) VALUES (null, '{$correo}', '{$password}', '{$est}')";
$mysqli->query($sql);
}


function acces_usuario($correo)
{
  global $mysqli;
  $sql = "SELECT * FROM usuario WHERE dt_correo = '{$correo}'";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}


function  crear_beneficiario($id_user, $nombre, $apaterno, $amaterno)
{
global $mysqli;
$sql="INSERT INTO beneficiario(id_beneficiario, id_usuario, dt_nombres, dt_apaterno, dt_amaterno) VALUES (null, '{$id_user}', '{$nombre}', '{$apaterno}', '{$amaterno}')";
$mysqli->query($sql);
}



function crear_digital_beneficiario($id_user)
{
global $mysqli;
$sql="INSERT INTO digital_beneficiario(id_digital_beneficiario, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}



function crear_estatus($id_user) 
{
global $mysqli;
$sql="INSERT INTO estatus(id_estatus, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}



function crear_evaluacion($id_user) 
{
global $mysqli;
$sql="INSERT INTO validacion_ben(id, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}

?>




