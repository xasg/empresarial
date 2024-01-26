<?php
require_once('../controller/conec.php');
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';
if( $mysqli->connect_errno )
{
  echo '';
  exit;
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



function run_giro()
{
  global $mysqli, $result;
  $sql ='SELECT * FROM cat_giro';
  return $mysqli->query($sql);
}


function run_actividades()
{
  global $mysqli, $result;
  $sql ='SELECT * FROM cat_fh_actividades';
  return $mysqli->query($sql);
}


function get_docs($id)
{
global $mysqli;
$sql ="SELECT * FROM cor_digital_empresa WHERE id_usuario = '{$id}'";
$result = $mysqli->query($sql);
return $result->fetch_assoc();
}



function run_empresas($fecha)
{
  global $mysqli, $result;
  $sql ="SELECT empresa.id_usuario, usuario.dt_password, usuario.dt_correo, `nombre_entidad`, `dt_razon_social`, dt_nombre_comercial,`dt_rfc`, `dt_nombre_contacto`, `dt_correo_contacto`,`dt_telefono_contacto`,`dt_nombre`, url_convenio, empresa.`tp_status` AS estatus FROM `empresa`
LEFT JOIN usuario ON(empresa.id_usuario=usuario.id_usuario)
LEFT JOIN vacante ON(empresa.id_usuario=vacante.id_usuario) 
LEFT JOIN cor_digital_empresa ON(empresa.id_usuario=cor_digital_empresa.id_usuario)
LEFT JOIN cat_entidad ON(empresa.id_cat_entidad=cat_entidad.id_cat_entidad) 
Where empresa.tp_status = 1 and YEAR(empresa.dt_fh_registro) = '$fecha'
GROUP BY empresa.id_usuario ORDER BY  empresa.dt_fh_registro DESC";
        return $mysqli->query($sql);
}
function run_empresas_baja($fecha)
{
  global $mysqli, $result;
  $sql ="SELECT empresa.id_empresa,empresa.id_usuario, usuario.dt_password, usuario.dt_correo, `nombre_entidad`, `dt_razon_social`,dt_nombre_comercial,`dt_rfc`, `dt_nombre_contacto`, `dt_correo_contacto`,`dt_telefono_contacto`,`dt_nombre`, url_convenio, empresa.`tp_status` AS estatus FROM `empresa`
LEFT JOIN usuario ON(empresa.id_usuario=usuario.id_usuario)
LEFT JOIN vacante ON(empresa.id_usuario=vacante.id_usuario) 
LEFT JOIN cor_digital_empresa ON(empresa.id_usuario=cor_digital_empresa.id_usuario)
LEFT JOIN cat_entidad ON(empresa.id_cat_entidad=cat_entidad.id_cat_entidad) 
Where empresa.tp_status = -1 AND YEAR(empresa.dt_fh_registro) = '$fecha'
GROUP BY empresa.id_usuario ORDER BY  empresa.dt_fh_registro DESC";
        return $mysqli->query($sql);
}
function run_empresas_pendiente( $fecha)
{
  global $mysqli, $result;
  $sql ="SELECT empresa.id_usuario, usuario.dt_password, usuario.dt_correo, `nombre_entidad`, `dt_razon_social`,dt_nombre_comercial,`dt_rfc`, `dt_nombre_contacto`, `dt_correo_contacto`,`dt_telefono_contacto`,`dt_nombre`, url_convenio, empresa.`tp_status` AS estatus FROM `empresa`
LEFT JOIN usuario ON(empresa.id_usuario=usuario.id_usuario)
LEFT JOIN vacante ON(empresa.id_usuario=vacante.id_usuario) 
LEFT JOIN cor_digital_empresa ON(empresa.id_usuario=cor_digital_empresa.id_usuario)
LEFT JOIN cat_entidad ON(empresa.id_cat_entidad=cat_entidad.id_cat_entidad) 
Where empresa.tp_status = 0 AND YEAR(empresa.dt_fh_registro) = '$fecha'
GROUP BY empresa.id_usuario ORDER BY  empresa.dt_fh_registro DESC";
        return $mysqli->query($sql);
}




function run_empresas_juridico()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.id_usuario, usuario.dt_password, usuario.dt_correo, `nombre_entidad`, `dt_razon_social`,`dt_rfc`, `dt_nombre_contacto`, `dt_correo_contacto`,`dt_telefono_contacto`,`dt_nombre`, url_convenio FROM `empresa`
LEFT JOIN usuario ON(empresa.id_usuario=usuario.id_usuario)
LEFT JOIN vacante ON(empresa.id_usuario=vacante.id_usuario) 
LEFT JOIN cor_digital_empresa ON(empresa.id_usuario=cor_digital_empresa.id_usuario)
LEFT JOIN cat_entidad ON(empresa.id_cat_entidad=cat_entidad.id_cat_entidad) WHERE empresa.`tp_status`=1 
GROUP BY empresa.id_usuario ORDER BY `dt_nombre` DESC";
        return $mysqli->query($sql);
}


function vacantes($id_empresa)
{
  global $mysqli, $result;
  $sql ="SELECT * FROM vacante WHERE id_usuario= '{$id_empresa}'";
  			return $mysqli->query($sql);
}

  // inseetar relacion en database
  function insertar_relacion($id_entidad,$id_ies){
    global $mysqli;
    $sql = "INSERT INTO relacion(id_cat_entidad,id_cat_ies) VALUES('{$id_entidad}','{$id_ies}')";
    return $mysqli->query($sql);
  }

  function update_ies($nombre_ies , $id){
    global $mysqli;
    $sql = "UPDATE cat_ies SET dt_nombre_ies = '{$nombre_ies}' where id = '{$id}' ";
    return $mysqli->query($sql);
  }



function num_vacantes()
{
  global $mysqli, $result;
  $sql ="SELECT COUNT(id_usuario) FROM vacante GROUP BY vacante.id_usuario";
        return $mysqli->query($sql);
}

function apoyo_vacantes_total(){
  global $mysqli, $result;
  $sql ="SELECT SUM(dt_apoyo) as apoyoTotal FROM vacante ";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}
function apoyo_vacantes_actual(){
  global $mysqli, $result;
  $sql ="SELECT SUM(dt_apoyo) as apoyoActual FROM vacante WHERE YEAR(dt_fh_registro) = YEAR(CURDATE()) ";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}
function apoyo_vacantes_anterior(){
  global $mysqli, $result;
  $sql ="SELECT SUM(dt_apoyo) as apoyoAnterior FROM vacante WHERE YEAR(dt_fh_registro) = YEAR(CURDATE()) - 1 ";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}


function run_candidato()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario,`dt_avance_registro`,`dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,beneficiario.tp_status_beneficiario, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_eval_curp, dt_eval_acta, dt_eval_domicilio, dt_eval_identificacion, dt_eval_estudios, dt_eval_seguro, dt_eval_bancario, dt_eval_aplica, dt_eval_comentario, dt_status_validacion, usuario.dt_correo, usuario.dt_password, tp_estatus,
  --  CAST(beneficiario.dt_fh_registro AS DATE) AS fecha
  beneficiario.dt_fh_registro as fecha
    FROM beneficiario
        LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN estatus ON(usuario.id_usuario=estatus.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN validacion_ben ON(beneficiario.id_usuario=validacion_ben.id_usuario)
        WHERE beneficiario.tp_status_beneficiario=0 AND dt_eval_aplica <=1 AND YEAR(beneficiario.`dt_fh_registro`) LIKE '20%'  ORDER BY beneficiario.dt_fh_registro DESC ";
        // -- WHERE beneficiario.tp_status_beneficiario=0 AND dt_eval_aplica<=1 AND beneficiario.`dt_fh_registro` LIKE '%2023%' ";
        return $mysqli->query($sql);
}

function run_candidato_baja()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, dt_fin_registro, beneficiario.id_usuario,`dt_avance_registro`,`dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,beneficiario.tp_status_beneficiario, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_eval_curp, dt_eval_acta, dt_eval_domicilio, dt_eval_identificacion, dt_eval_estudios, dt_eval_seguro, dt_eval_bancario, dt_eval_aplica, dt_eval_comentario, dt_status_validacion, usuario.dt_correo, usuario.dt_password, tp_estatus,
  --  CAST(beneficiario.dt_fh_registro AS DATE) AS fecha
  beneficiario.dt_fh_registro as fecha
    FROM beneficiario
        LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN estatus ON(usuario.id_usuario=estatus.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN validacion_ben ON(beneficiario.id_usuario=validacion_ben.id_usuario)
        WHERE beneficiario.tp_status_beneficiario= -1 AND dt_eval_aplica <=1 AND YEAR(beneficiario.`dt_fh_registro`) LIKE '20%'  ORDER BY beneficiario.dt_fh_registro DESC ";
        // -- WHERE beneficiario.tp_status_beneficiario=0 AND dt_eval_aplica<=1 AND beneficiario.`dt_fh_registro` LIKE '%2023%' ";
        return $mysqli->query($sql);
}


function run_benefiaciario($fecha)
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario, dt_correo, `dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,`tp_status_beneficiario`, vacante.dt_nombre, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_clabe, SUBSTRING(dt_clabe, 1, 3) AS banco, url_cuenta, url_convenio1, url_convenio2, dt_paqueteria, usuario.dt_password, dt_guia,(SELECT dt_nombre FROM cat_banco WHERE id_banco=banco) AS banco ,(SELECT dt_clave_tranf FROM cat_banco WHERE id_banco=banco) AS trans , CAST(beneficiario.dt_fh_registro AS DATE) AS fecha FROM beneficiario
         LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN digital_beneficiario ON(beneficiario.id_usuario=digital_beneficiario.id_usuario)
        WHERE `tp_status_beneficiario`=1 AND year(beneficiario.`dt_fh_registro`) =  '{$fecha}'";
        return $mysqli->query($sql);
}



function run_benefiaciario2020()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario, dt_correo, `dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,`tp_status_beneficiario`, vacante.dt_nombre, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_clabe, SUBSTRING(dt_clabe, 1, 3) AS banco, url_cuenta, url_convenio1,dt_paqueteria, usuario.dt_password, dt_guia,(SELECT dt_nombre FROM cat_banco WHERE id_banco=banco) AS banco ,(SELECT dt_clave_tranf FROM cat_banco WHERE id_banco=banco) AS trans , CAST(beneficiario.dt_fh_registro AS DATE) AS fecha FROM beneficiario
         LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN digital_beneficiario ON(beneficiario.id_usuario=digital_beneficiario.id_usuario)
        WHERE `tp_status_beneficiario`=1 AND beneficiario.`dt_fh_registro` LIKE '%2020%'";
        return $mysqli->query($sql);
}

function run_benefiaciario2021()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario, dt_correo, `dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,`tp_status_beneficiario`, vacante.dt_nombre, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_clabe, SUBSTRING(dt_clabe, 1, 3) AS banco, url_cuenta, url_convenio1,dt_paqueteria, usuario.dt_password, dt_guia,(SELECT dt_nombre FROM cat_banco WHERE id_banco=banco) AS banco ,(SELECT dt_clave_tranf FROM cat_banco WHERE id_banco=banco) AS trans , CAST(beneficiario.dt_fh_registro AS DATE) AS fecha FROM beneficiario
         LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN digital_beneficiario ON(beneficiario.id_usuario=digital_beneficiario.id_usuario)
        WHERE `tp_status_beneficiario`=1 AND beneficiario.`dt_fh_registro` LIKE '%2021%'";
        return $mysqli->query($sql);
}


function run_benefiaciario2019()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario, dt_correo, `dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,`tp_status_beneficiario`, vacante.dt_nombre, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_clabe, SUBSTRING(dt_clabe, 1, 3) AS banco, url_cuenta, url_convenio1,dt_paqueteria, usuario.dt_password, dt_guia,(SELECT dt_nombre FROM cat_banco WHERE id_banco=banco) AS banco ,(SELECT dt_clave_tranf FROM cat_banco WHERE id_banco=banco) AS trans , CAST(beneficiario.dt_fh_registro AS DATE) AS fecha FROM beneficiario
         LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN digital_beneficiario ON(beneficiario.id_usuario=digital_beneficiario.id_usuario)
        WHERE `tp_status_beneficiario`=1 AND beneficiario.`dt_fh_registro` LIKE '%2019%'";
        return $mysqli->query($sql);
}


function run_benefiaciario2023()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario, dt_correo, `dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,`tp_status_beneficiario`, vacante.dt_nombre, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_clabe, SUBSTRING(dt_clabe, 1, 3) AS banco, url_cuenta, url_convenio1, url_convenio2, dt_paqueteria, usuario.dt_password, dt_guia,(SELECT dt_nombre FROM cat_banco WHERE id_banco=banco) AS banco ,(SELECT dt_clave_tranf FROM cat_banco WHERE id_banco=banco) AS trans , CAST(beneficiario.dt_fh_registro AS DATE) AS fecha FROM beneficiario
         LEFT JOIN usuario ON(beneficiario.id_usuario=usuario.id_usuario)
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN digital_beneficiario ON(beneficiario.id_usuario=digital_beneficiario.id_usuario)
        WHERE `tp_status_beneficiario`=1 AND beneficiario.`dt_fh_registro` LIKE '%2023%'";
        return $mysqli->query($sql);
}



function run_noaplica()
{
  global $mysqli, $result;
  $sql ="SELECT empresa.dt_razon_social, beneficiario.id_usuario,`dt_nombres`,`dt_apaterno`,`dt_amaterno`,`dt_curp`,`dt_nombre_carrera`,`dt_nombre_ies`,beneficiario.tp_status_beneficiario, vacante.dt_inicio, vacante.dt_termino, vacante.dt_apoyo, dt_eval_curp, dt_eval_acta, dt_eval_domicilio, dt_eval_identificacion, dt_eval_estudios, dt_eval_seguro, dt_eval_bancario, dt_eval_aplica, dt_eval_comentario FROM beneficiario
        LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies)
        LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera)
        LEFT JOIN rel_beneficiario_vacante ON(beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario)
        LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario)
        LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante)
        LEFT JOIN validacion_ben ON(beneficiario.id_usuario=validacion_ben.id_usuario)
        WHERE dt_eval_aplica=2";
        return $mysqli->query($sql);
}




function update_beneficiario($id, $nombre, $apaterno, $amaterno, $curp, $direccion, $colonia, $municipio, $cp, $entidad)
{
  global $mysqli;
  $sql = "UPDATE beneficiario SET dt_nombres = '{$nombre}', dt_apaterno = '{$apaterno}', dt_amaterno = '{$amaterno}', dt_curp = '{$curp}', dt_direccion = '{$direccion}', dt_colonia = '{$colonia}', dt_municipio = '{$municipio}', dt_cp = '{$cp}', id_cat_entidad = '{$entidad}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}




function update_postular($id, $aplica)
{
  global $mysqli;
  $sql = "UPDATE beneficiario SET tp_status_beneficiario = '{$aplica}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}



function run_entidad()
{
  global $mysqli;
  $sql ='SELECT * FROM cat_entidad';
  return $mysqli->query($sql);
  return $result->fetch_assoc();
}


function update_datosacademicos($id, $matricula, $periodo, $no_periodo, $no_creditos)
{
  global $mysqli;
  $sql = "UPDATE beneficiario SET  dt_matricula = '{$matricula}', dt_periodo = '{$periodo}', dt_periodo_num = '{$no_periodo}', dt_creditos = '{$no_creditos}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}


function update_datosbancarios($id, $clabe)
{
  global $mysqli;
  $sql = "UPDATE digital_beneficiario SET  dt_clabe = '{$clabe}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}


function update_validacion($id, $valida, $curp, $acta, $domicilio, $identificacion, $estudios, $seguro, $bancario, $aplica, $comentario)
{
  global $mysqli;
  $sql = "UPDATE validacion_ben SET  dt_eval_curp = '{$curp}', dt_eval_acta = '{$acta}', dt_eval_domicilio = '{$domicilio}', dt_eval_identificacion = '{$identificacion}', dt_eval_estudios = '{$estudios}', dt_eval_seguro = '{$seguro}', dt_eval_bancario = '{$bancario}' , dt_eval_aplica = '{$aplica}', dt_eval_comentario = '{$comentario}', dt_status_validacion = '{$valida}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}


// CREACION DE EMPRESAS
function  crear_empresa_admin($id_user, $nombreR, $nombreC,$entidad)
{
global $mysqli;
$sql="INSERT INTO empresa(id_empresa, id_usuario, dt_razon_social,dt_nombre_comercial,id_cat_entidad) 
       VALUES (null, '{$id_user}', '{$nombreR}','{$nombreC}','{$entidad}')";
$mysqli->query($sql);
}

function crear_digital_empresa($id_user)
{
global $mysqli;
$sql="INSERT INTO cor_digital_empresa(id_digital, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}

function crear_estatus($id_user)
{
global $mysqli;
$sql="INSERT INTO estatus(id_estatus, id_usuario) VALUES (null, '{$id_user}')";
$mysqli->query($sql);
}

function crear_usuario($correo, $password)
{
global $mysqli;
$sql="INSERT INTO usuario(id_usuario, dt_correo, dt_password) VALUES (null, '{$correo}', '{$password}')";
$mysqli->query($sql);
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

function get_limit_user(){
  global $mysqli;
  $sql ="SELECT * FROM `usuario` ORDER BY id_usuario desc LIMIT 1";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}

// Eliminar registro de usuarios y de empresas

function delete_empresa($idempresa){
  global $mysqli;
  $sql ="DELETE FROM empresa WHERE id_empresa = '{$idempresa}'";
  return $mysqli->query($sql);
}
function delete_empresa_usuario($idusuario){
  global $mysqli;
  $sql ="DELETE FROM usuario WHERE id_usuario = '{$idusuario}'";
  return $mysqli->query($sql);
}

function delete_empresa_usuario_vacante($idusuario){
  global $mysqli;
  $sql ="DELETE FROM vacante WHERE id_usuario = '{$idusuario}'";
  return $mysqli->query($sql);
}

function insert_actividades($dateinicio, $datefin)
{
global $mysqli;
$sql="INSERT INTO cat_fh_actividades(id, dt_fh_inicio, dt_fh_fin) VALUES (null, '{$dateinicio}', '{$datefin}')";
$mysqli->query($sql);
}

// validacion empresa cambiar estatus
function update_empresa($id){
  global $mysqli;
  $sql = "UPDATE empresa SET tp_status = 1 WHERE id_usuario='{$id}'";
  $mysqli->query($sql);
}
function down_empresa($id){
  global $mysqli;
  $sql = "UPDATE empresa SET tp_status = -1 WHERE id_usuario='{$id}'";
  $mysqli->query($sql);
}


// Se obtiene el numero total de candidatos sin ambiguedad registrados
function count_candidatos_total(){
  global $mysqli;
$sql ="SELECT COUNT(*) as numeralia 
FROM estatus
LEFT JOIN beneficiario USING(id_usuario)
LEFT join usuario USING(id_usuario)
WHERE usuario.tp_usuario = 2 ";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}

// Obtener los candidatos registrados que aun no terminan su registro
function count_candidatos_registrados(){
  global $mysqli;
$sql ="SELECT COUNT(*) as numeralia 
FROM estatus
LEFT JOIN beneficiario USING(id_usuario)
LEFT join usuario USING(id_usuario)
WHERE usuario.tp_usuario = 2 AND tp_estatus is null";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}
function count_candidatos_enproceso(){
  global $mysqli;
$sql ="SELECT COUNT(*) as numeralia 
FROM estatus
LEFT JOIN beneficiario USING(id_usuario)
LEFT join usuario USING(id_usuario)
WHERE usuario.tp_usuario = 2 AND tp_estatus BETWEEN 1 AND 3";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}
function count_candidatos_Finalizado(){
  global $mysqli;
$sql ="SELECT COUNT(*) as numeralia 
FROM estatus
LEFT JOIN beneficiario USING(id_usuario)
LEFT join usuario USING(id_usuario)
WHERE usuario.tp_usuario = 2 AND tp_estatus = 4";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}
function count_candidatos_registrados_actual(){
  global $mysqli;
$sql ="SELECT COUNT(*) as numeralia 
FROM estatus
LEFT JOIN beneficiario USING(id_usuario)
LEFT join usuario USING(id_usuario)
WHERE usuario.tp_usuario = 2 AND tp_estatus is null AND YEAR(beneficiario.dt_fh_registro) = YEAR(CURDATE())";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}

 function count_beneficiarios_actual(){
  global $mysqli;
$sql ="SELECT count(*) as numeralia FROM `beneficiario` where tp_status_beneficiario = 1 AND YEAR(dt_fh_registro) = YEAR(CURDATE()) ";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}

function count_beneficiarios_total_actual(){
  global $mysqli;
$sql ="SELECT count(*) as numeralias FROM `beneficiario`  where YEAR(dt_fh_registro) = YEAR(CURDATE()) ";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}
function count_beneficiarios_total(){
  global $mysqli;
$sql ="SELECT count(*) as numeralias FROM `beneficiario` where tp_status_beneficiario = 1 AND YEAR(dt_fh_registro) = YEAR(CURDATE())-1 ";
$result = $mysqli->query($sql);
 return  $result->fetch_assoc();
}
// Invitaciones por correo
function count_invitaciones(){
global $mysqli;
$sql="SELECT count(*) as numeralia FROM `candidatos_correos` where notificacion = 1 AND YEAR(dt_fecha) = YEAR(CURDATE()) ";
$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}
function count_invitaciones_pendientes(){
global $mysqli;
$sql="SELECT count(*) as numeralia FROM `candidatos_correos` where notificacion = 0";
$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}
function count_invitaciones_registrados(){
global $mysqli;
$sql="SELECT count(*) as numeralia FROM `candidatos_correos`LEFT JOIN usuario ON(dt_correo = correo) WHERE usuario.tp_usuario = 2";
$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}
// da la numearlia de todos los candidatos del año en curso
function count_candidatos_actual(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as total
FROM beneficiario 
WHERE YEAR(dt_fh_registro) =  YEAR(CURDATE())";

$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}
function count_candidatos_nuevos(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as total
FROM beneficiario 
WHERE YEAR(dt_fh_registro) =  YEAR(CURDATE()) AND ";

$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}
function count_candidatos_anterior(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as total
FROM beneficiario 
WHERE YEAR(dt_fh_registro) =  YEAR(CURDATE()) -1;";

$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}

function count_empresas_registradas_total(){
  global $mysqli;
$sql ="SELECT count(*) as numeralia FROM empresa ";
$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}


function count_empresas_registradas_actual(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as total
FROM empresa 
WHERE YEAR(dt_fh_registro) =  YEAR(CURDATE())";

$result = $mysqli->query($sql);
return  $result->fetch_assoc();
}


function count_empresas_registradas_anterior(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as total
FROM empresa 
WHERE YEAR(dt_fh_registro) =  YEAR(CURDATE()) - 1";

$result = $mysqli->query($sql); 
return  $result->fetch_assoc();
}

// Validacion de empresas nuevas

function count_empresas_nuevas(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as nums
  FROM empresa WHERE tp_status = 0";

$result = $mysqli->query($sql); 
return  $result->fetch_assoc();
}
function count_empresas_validadas(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as nums
  FROM empresa WHERE tp_status = 1";

$result = $mysqli->query($sql); 
return  $result->fetch_assoc();
}
function count_empresas_bajas(){
  global $mysqli;
  $sql = "SELECT 
  COUNT(*) as nums
  FROM empresa WHERE tp_status = -1";

$result = $mysqli->query($sql); 
return  $result->fetch_assoc();
}

?>
