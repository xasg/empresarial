<?php
require_once('../controller/conec.php');
// require_once('./../controller/conec.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';
if( $mysqli->connect_errno )
{
  echo '';
  exit;
}

function get_cantidad($id){
    global $mysqli;
    $sql = "SELECT * FROM candidatos_correos WHERE id_vacante = '{$id}' ";
    
    $result = $mysqli->query($sql);

    if (!$result) {
        die('Error en la consulta: ' . $mysqli->error);
    }

    return $result;
}
function get_cantidad_total(){
    global $mysqli;
    $sql = "SELECT * FROM candidatos_correos LEFT JOIN vacante USING (id_vacante) LEFT JOIN empresa USING(id_usuario) ";
    
    $result = $mysqli->query($sql);

    if (!$result) {
        die('Error en la consulta: ' . $mysqli->error);
    }

    return $result;
}


function actualiza_status($cliente){
    global $mysqli;
    $query = "UPDATE candidatos_correos SET notificacion = 1, dt_fecha=NOW()  WHERE correo='{$cliente}' ";
    $mysqli->query($query);
}

function insert_candidato($nombre,$correo,$idvac){
    global $mysqli;
    $query = "INSERT INTO candidatos_correos(id,nombre,correo,notificacion,id_vacante) values(null,'{$nombre}','{$correo}',0,'{$idvac}')";
    $mysqli->query($query);
}

function delete_vacante_correo($id){
    
  global $mysqli;
  $sql ="DELETE FROM candidatos_correos Where id =  '{$id}' ";
  return $mysqli->query($sql);

}

function obtener_empresa($idvacante)
{
  global $mysqli;
  $sql ="SELECT * FROM vacante left join empresa using (id_usuario) WHERE id_vacante = '{$idvacante}' ";
  return $mysqli->query($sql);
}

// Insertar candidatos por medio de csv

// Busca si existe el correo
function search_candidato($correo,$idvacante){
  global $mysqli;
  $sql = "SELECT correo,id_vacante FROM candidatos_correos WHERE correo= '{$correo}' AND id_vacante='{$idvacante}'";
  return $mysqli->query($sql);
}
// Sino existe lo inserta

function insert_data($nombre,$correo,$idvacante)
{
 global $mysqli;

$sql = "INSERT INTO candidatos_correos(id,nombre,correo,notificacion,id_vacante) VALUES(null,'{$nombre}','{$correo}',0,'{$idvacante}')";
  $mysqli->query($sql);
}
// Si existe se actualiza solo si tiene el id de la vacante

function update_correo($nombre,$correo,$idvacante)
{
  global $mysqli;
  $sql = "UPDATE candidatos_correos SET nombre='{$nombre}' WHERE correo='{$correo}' AND id_vacante = '{$idvacante}' ";
  $mysqli->query($sql);
}

?>