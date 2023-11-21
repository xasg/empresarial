<?php
require_once('../controller/conec.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';
if( $mysqli->connect_errno )
{
  echo '';
  exit;
}


/** usado para consultar datos de acceso del login **/

function get_user_acces($correo)
{
  global $mysqli;
  $sql = "SELECT estatus.tp_estatus, usuario.id_usuario,dt_password, tp_usuario FROM usuario 
          LEFT JOIN estatus ON(usuario.id_usuario=estatus.id_usuario)
          WHERE dt_correo = '{$correo}'";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}




function get_usuario($id)
{
global $mysqli;
$sql ="SELECT *  FROM empresa 
       LEFT JOIN cor_digital_empresa ON(cor_digital_empresa.id_usuario=empresa.id_usuario)
       LEFT JOIN cat_entidad ON(cat_entidad.id_cat_entidad=empresa.id_cat_entidad)
       LEFT JOIN cat_giro ON(cat_giro.id_giro=empresa.id_giro)
       WHERE empresa.id_usuario = '{$id}'";
$result = $mysqli->query($sql);
return $result->fetch_assoc();
}


function view_empresa($id)
{
  global $mysqli;
  $sql = "SELECT *  FROM `usuario` 
          LEFT JOIN empresa USING(id_usuario)
          WHERE `id_usuario` = '{$id}'";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}



function crear_usuario($correo, $password)
{
global $mysqli;
$sql="INSERT INTO usuario(id_usuario, dt_correo, dt_password) VALUES (null, '{$correo}', '{$password}')";
$mysqli->query($sql);
}


function  crear_empresa($id_user, $nombre)
{
global $mysqli;
$sql="INSERT INTO empresa(id_empresa, id_usuario, dt_razon_social) 
       VALUES (null, '{$id_user}', '{$nombre}')";
$mysqli->query($sql);
}


function  crear_vacante($id_user)
{
global $mysqli;
$sql="INSERT INTO vacante(id_empresa, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}



function run_vacanteinfo($id)
{
  global $mysqli, $result;
  $sql ="SELECT * FROM vacante WHERE id_vacante='{$id}'";
 $result = $mysqli->query($sql);
return $result->fetch_assoc();
}


function crear_estatus($id_user)
{
global $mysqli;
$sql="INSERT INTO estatus(id_estatus, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}


function update_estatus($id, $estatus)
{
  global $mysqli;
  $sql = "UPDATE estatus SET tp_estatus = '{$estatus}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}



function crear_digital_empresa($id_user)
{
global $mysqli;
$sql="INSERT INTO cor_digital_empresa(id_digital, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
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


function update_empresa($id, $razon, $nombre, $rfc, $actividad, $tamano, $giro, $org, $direccion, $colonia, $entidad, $cp, $nombre_contacto, $puesto_contacto, $correo_contacto, $telefono_contacto, $nombre_representante)
{
  global $mysqli;
  $sql = "UPDATE empresa SET dt_razon_social = '{$razon}', dt_nombre_comercial = '{$nombre}', dt_rfc = '{$rfc}', dt_actividad = '{$actividad}', dt_tamano = '{$tamano}', id_giro = '{$giro}', dt_org_afiliado = '{$org}', dt_direccion = '{$direccion}', dt_localidad = '{$colonia}', id_cat_entidad = '{$entidad}' , dt_cp = '{$cp}', dt_nombre_contacto = '{$nombre_contacto}', dt_puesto_contacto = '{$puesto_contacto}', dt_correo_contacto = '{$correo_contacto}', dt_telefono_contacto = '{$telefono_contacto}' , dt_representante = '{$nombre_representante}'  WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}


function get_docs($id)
{
global $mysqli;
$sql ="SELECT * FROM cor_digital_empresa WHERE id_usuario = '{$id}'";
$result = $mysqli->query($sql);
return $result->fetch_assoc();
}

function update_vacante($id, $nombre, $numero, $carrera, $inicio, $termino, $hr_inicio, $hr_termino, $actividad, $area, $apoyo, $dispersion, $competencia, $descripcion, $tutor, $cargo)
{
global $mysqli;
$sql="INSERT INTO vacante(id_vacante, id_usuario, dt_nombre, dt_numero, dt_carrera, dt_inicio, dt_termino, dt_hr_inicio, dt_hr_termino, dt_actividades, dt_area, dt_apoyo, dt_dispersion, dt_competencias, dt_descripcion, dt_tutor, dt_cargo) VALUES (null, '{$id}', '{$nombre}', '{$numero}', '{$carrera}', '{$inicio}', '{$termino}', '{$hr_inicio}', '{$hr_termino}', '{$actividad}', '{$area}', '{$apoyo}', '{$dispersion}', '{$competencia}', '{$descripcion}', '{$tutor}', '{$cargo}')";
$mysqli->query($sql);
}



function update_vacante_admin($id, $nombre, $numero, $carrera, $inicio, $termino, $hr_inicio, $hr_termino, $actividad, $area, $apoyo, $dispersion, $competencia, $descripcion, $tutor, $cargo)
{
  global $mysqli;
  $sql = "UPDATE vacante SET dt_nombre = '{$nombre}',
   dt_numero = '{$numero}',
    dt_carrera = '{$carrera}',
    dt_inicio = '{$inicio}',
     dt_termino = '{$termino}',
      dt_hr_inicio = '{$hr_inicio}',
      dt_hr_termino = '{$hr_termino}',
       dt_actividades = '{$actividad}',
        dt_area = '{$area}',
         dt_apoyo = '{$apoyo}' ,
          dt_dispersion = '{$dispersion}',
           dt_competencias = '{$competencia}',
            dt_descripcion = '{$descripcion}',
             dt_tutor = '{$tutor}',
              dt_cargo = '{$cargo}'  WHERE id_vacante ='{$id}' ";
  $mysqli->query($sql); 
}

// Se agrega el insert de la vacante desde el admin
function insert_vacante_admin($id, $nombre, $numero, $carrera, $inicio, $termino, $hr_inicio, $hr_termino, $apoyo, $dispersion){
  global $mysqli;


//   $sql = "INSERT INTO vacante (id_vacante, id_usuario,dt_nombre, dt_numero,dt_carrera,dt_inicio,dt_termino,dt_hr_inicio,dt_hr_termino,dt_apoyo,dt_dispersion)
// SELECT null, id_usuario, '{$nombre}', '{$numero}', '{$carrera}', '{$inicio}', '{$termino}', '{$hr_inicio}', '{$hr_termino}',  '{$apoyo}', '{$dispersion}'
// FROM empresa 
// WHERE dt_nombre_comercial = '{$id}'";

// $sql="INSERT INTO vacante
// SELECT null,id_usuario, '{$nombre}','{$numero}','{$carrera}','{$inicio}','{$termino}','{$hr_inicio}', '{$hr_termino}',null,null,'{$apoyo}', '{$dispersion}',null,null,null,null,0
// FROM empresa 
// WHERE dt_nombre_comercial = '{$id}'";

$sql = "INSERT INTO vacante (id_vacante, id_usuario, dt_nombre, dt_numero, dt_carrera, dt_inicio, dt_termino, dt_hr_inicio, dt_hr_termino, dt_apoyo, dt_dispersion)
VALUES (null, '{$id}', '{$nombre}', '{$numero}', '{$carrera}', '{$inicio}', '{$termino}', '{$hr_inicio}', '{$hr_termino}', '{$apoyo}', '{$dispersion}')
";



$mysqli->query($sql);


}




function run_vacante_info($id){
  global $mysqli;
  // $sql ="SELECT * FROM vacante left join empresa using (id_usuario) WHERE dt_razon_social != 'null' ";
  $sql ="SELECT * FROM vacante left join empresa using (id_usuario) where id_vacante = '{$id}'";
  return $mysqli->query($sql);
}

function run_vacante($id)
{
  global $mysqli, $result;
  $sql ="SELECT * FROM vacante WHERE id_usuario = '{$id}'";
  return $mysqli->query($sql);
}

// Se agrega la funcion para visualisar las vacantes desde el view/new_vacante_admin_view.php para ver el listado de las vacantes

function run_vacantes()
{
  global $mysqli;
  // $sql ="SELECT * FROM vacante left join empresa using (id_usuario) WHERE dt_razon_social != 'null' ";
  $sql ="SELECT *,vacante.dt_fh_registro as fecha_registro_vacante FROM vacante left join empresa using (id_usuario) order by vacante.dt_fh_registro DESC ";
  return $mysqli->query($sql);
}
// Se agrega la funcion para eliminar una vacante creada sin la relacion entre ninguna empresa es decir si no tiene empresa registrada y esta en null la posibilidad de eliminarla
function delete_vacante($id){
  global $mysqli;
  $sql ="DELETE FROM vacante Where id_vacante =  '{$id}' ";
  return $mysqli->query($sql);
}

// Se agrega el select list para el new_vacante_admin.php para ver el listado de las empresas registradas por nombre comercial
function run_empresas(){
  global $mysqli;
  $sql ="SELECT *  FROM empresa Where dt_nombre_comercial <> 'NULL'";
  return $result = $mysqli->query($sql);
}
// Se obtiene el numero total de empresas sin ambiguedad registradas
function count_empresas(){
  global $mysqli;
$sql ="SELECT count(*) as numeralia FROM empresa Where dt_nombre_comercial <> 'NULL' ";
 return $result = $mysqli->query($sql);
//  return $result->fetch_assoc(); 
}

?>