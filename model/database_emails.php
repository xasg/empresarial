<?php
require_once('../controller/conec.php');
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


function actualiza_status($cliente){
    global $mysqli;
    $query = "UPDATE candidatos_correos SET notificacion = 1  WHERE correo='{$cliente}' ";
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
  // global $mysqli;
  // $sql ="SELECT * FROM vacante  ";
  // return $mysqli->query($sql);

  global $mysqli;
  $sql ="SELECT * FROM vacante left join empresa using (id_usuario) WHERE id_vacante = '{$idvacante}' ";
  return $mysqli->query($sql);
}

?>