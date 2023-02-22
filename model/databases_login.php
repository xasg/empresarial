<?php
require_once('../controller/conec.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';

if( $mysqli->connect_errno )
{
  echo '';
  exit;
}

function add( $nombre, $email, $pass )
{
global $mysqli;
$sql="INSERT INTO user(id_user, dt_nombre, dt_email, password) VALUES (null, '{$nombre}', '{$email}', '{$pass}')";
$mysqli->query($sql);
}


function add_info($user)
{
global $mysqli;
$sql="INSERT INTO user_info(id_user_info, id_user) VALUES (null, '{$user}')";
$mysqli->query($sql);
}

function add_digital($user)
{
global $mysqli;
$sql="INSERT INTO cor_digital(id_digital, id_user) VALUES (null, '{$user}')";
$mysqli->query($sql);
}



function get_user_acces($email)
{
  global $mysqli;
  $sql = "SELECT * FROM user WHERE dt_email = '{$email}'";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}


function get_user($id)
{
global $mysqli;
$sql ="SELECT *  FROM user  
       LEFT JOIN user_info USING(id_user)
       LEFT JOIN cor_digital ON(cor_digital.id_user=user.id_user)
       LEFT JOIN cat_entidad ON(cat_entidad.id_cat_entidad=user_info.dt_entidad)
       LEFT JOIN cat_giro ON(cat_giro.id_giro=user_info.dt_giro)
       WHERE user.id_user = '{$id}'";
$result = $mysqli->query($sql);
if( $result->num_rows )
  return $result->fetch_assoc();
return false;
}


function run_vacantes()
{
  global $mysqli, $result;
  $sql ="SELECT dt_razon_social, dt_nombre, dt_numero, dt_carrera FROM user_info 
  LEFT JOIN vacante USING(id_user)";
  return $mysqli->query($sql);
}



function run_vacante($id)
{
  global $mysqli, $result;
  $sql ="SELECT * FROM vacante WHERE id_user = '{$id}'";
  return $mysqli->query($sql);
}




function run_entidad()
{
  global $mysqli, $result;
  $sql ='SELECT * FROM cat_entidad';
  return $mysqli->query($sql);
}


function run_giro()
{
  global $mysqli, $result;
  $sql ='SELECT * FROM cat_giro';
  return $mysqli->query($sql);
}




function update_user($id, $razon, $nombre, $rfc, $actividad, $tamano, $sector, $giro, $org, $direccion, $colonia, $entidad, $cp)
{
  global $mysqli;
  $sql = "UPDATE user_info SET dt_razon_social = '{$razon}', dt_nombre_comercial = '{$nombre}', dt_rfc = '{$rfc}', dt_actividad = '{$actividad}', dt_tamano = '{$tamano}', dt_sector = '{$sector}', dt_giro = '{$giro}', dt_org_afiliado = '{$org}', dt_direccion = '{$direccion}', dt_localidad = '{$colonia}', dt_entidad = '{$entidad}' , dt_cp = '{$cp}'   WHERE id_user ='{$id}' ";
  $mysqli->query($sql); 
}



function get_docs($id)
{
global $mysqli;
$sql ="SELECT * FROM cor_digital WHERE id_user = '{$id}'";
$result = $mysqli->query($sql);
if( $result->num_rows )
  return $result->fetch_assoc();
return false;
}



function update_vacante($id, $nombre, $numero, $carrera, $inicio, $termino, $actividad, $area, $apoyo, $dispersion, $competencia, $descripcion, $tutor, $cargo, $telefono, $correo)
{
global $mysqli;
$sql="INSERT INTO vacante(id_vacante, id_user, dt_nombre, dt_numero, dt_carrera, dt_inicio, dt_termino, dt_actividades, dt_area, dt_apoyo, dt_dispersion, dt_competencias, dt_descripcion, dt_tutor, dt_cargo, dt_telefono, dt_correo) VALUES (null, '{$id}', '{$nombre}', '{$numero}', '{$carrera}', '{$inicio}', '{$termino}', '{$actividad}', '{$area}', '{$apoyo}', '{$dispersion}', '{$competencia}', '{$descripcion}', '{$tutor}', '{$cargo}', '{$telefono}', '{$correo}')";
$mysqli->query($sql);
}
