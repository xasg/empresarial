<?php
require_once('../controller/conec.php');
$servername = "localhost";
$dbname = "empresarial";
$username = "root";
$password = "";
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result ='';
if( $mysqli->connect_errno )
{
  echo '';
  exit;
}


/** usado para consultar datos de acceso del login **/

function acces_beneficiario($id)
{
  global $mysqli;
  $sql = "SELECT *, cat_ies.id_cat_ies as id_ies_relacion FROM beneficiario 
          LEFT JOIN usuario USING(id_usuario) 
          LEFT JOIN cat_entidad ON(beneficiario.id_cat_entidad=cat_entidad.id_cat_entidad)
          LEFT JOIN digital_beneficiario ON(beneficiario.id_usuario=digital_beneficiario.id_usuario)
          LEFT JOIN cat_ies ON(beneficiario.dt_ies=cat_ies.id_cat_ies )
          LEFT JOIN cat_carrera ON(beneficiario.dt_carrera=cat_carrera.id_cat_carrera) 
          WHERE beneficiario.id_usuario = '{$id}'";
  $result = $mysqli->query($sql);
   return $result->fetch_assoc();
}

function valida($id)
{
  global $mysqli;
  $sql = "SELECT * FROM validacion_ben
          WHERE id_usuario = '{$id}'";
  $result = $mysqli->query($sql);
   return $result->fetch_assoc();
}

function get_user_acces($correo)
{
  global $mysqli;
  $sql = "SELECT * FROM usuario LEFT JOIN estatus USING(id_usuario) WHERE dt_correo = '{$correo}'";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}


function view_empresas()
{
  global $mysqli;
  $sql ='SELECT * FROM empresa WHERE tp_status=1 ORDER BY dt_nombre_comercial';
  return $mysqli->query($sql);  
  return $result->fetch_assoc();
}



function view_relacion($id)
{
  global $mysqli;
  $sql = "SELECT * FROM rel_beneficiario_vacante LEFT JOIN empresa ON(rel_beneficiario_vacante.id_empresa=empresa.id_usuario) LEFT JOIN vacante ON(rel_beneficiario_vacante.id_vacante=vacante.id_vacante) WHERE rel_beneficiario_vacante.id_usuario ='{$id}'";
  $result = $mysqli->query($sql);
   return $result->fetch_assoc();
}


function view_rel_ben_us($id)
{
  global $mysqli;
  $sql = "SELECT beneficiario.`id_usuario`, beneficiario.dt_apaterno, beneficiario.dt_amaterno, rel_beneficiario_vacante.`id_usuario`,rel_beneficiario_vacante.`id_empresa`, `dt_nombre_comercial`,`dt_nombre_comercial`,empresa.`dt_direccion`,empresa.`dt_localidad` ,empresa.`dt_cp`,`nombre_entidad`,vacante.dt_nombre, vacante.dt_inicio, vacante.dt_termino, digital_beneficiario.dt_tipocontacto, digital_beneficiario.dt_nom_contacto, digital_beneficiario.url_convenio1, digital_beneficiario.dt_paqueteria, digital_beneficiario.dt_guia, beneficiario.dt_nombres FROM beneficiario 
LEFT JOIN rel_beneficiario_vacante ON(rel_beneficiario_vacante.id_usuario=beneficiario.id_usuario) 
LEFT JOIN empresa ON(empresa.id_usuario=rel_beneficiario_vacante.id_empresa) 
LEFT JOIN cat_entidad ON(cat_entidad.id_cat_entidad=empresa.id_cat_entidad) 
LEFT JOIN vacante ON(vacante.id_vacante=rel_beneficiario_vacante.id_vacante)
LEFT JOIN digital_beneficiario ON(digital_beneficiario.id_usuario=rel_beneficiario_vacante.id_usuario) 
WHERE beneficiario.id_usuario='{$id}'";
  $result = $mysqli->query($sql);
   return $result->fetch_assoc();
}





function run_entidad()
{
  global $mysqli;
  $sql ='SELECT * FROM cat_entidad';
  return $mysqli->query($sql);
  return $result->fetch_assoc();
}


function update_beneficiario($id, $curp, $telefono, $direccion, $colonia, $municipio, $entidad, $cp)
{
  global $mysqli;
  $sql = "UPDATE beneficiario SET dt_curp = '{$curp}', dt_telefono = '{$telefono}', dt_direccion = '{$direccion}', dt_colonia = '{$colonia}', dt_municipio = '{$municipio}', id_cat_entidad = '{$entidad}', dt_cp = '{$cp}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}


function update_datosacademicos($id, $ies, $carrera, $matricula, $periodo, $no_periodo, $no_creditos, $habilidades)
{
  global $mysqli;
  $sql = "UPDATE beneficiario SET dt_ies = '{$ies}', dt_carrera = '{$carrera}', dt_matricula = '{$matricula}', dt_periodo = '{$periodo}', dt_periodo_num = '{$no_periodo}', dt_creditos = '{$no_creditos}', dt_ht = '{$habilidades}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}



function update_datoscomplementarios($id, $idioma, $nivel)
{
  global $mysqli;
  $sql = "UPDATE beneficiario SET dt_idioma = '{$idioma}', dt_idioma_nivel = '{$nivel}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}




function update_estatus($id, $estatus)
{
  global $mysqli;
  $sql = "UPDATE estatus SET tp_estatus = '{$estatus}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}


function update_valida($id, $valida)
{
  global $mysqli;
  $sql = "UPDATE validacion_ben SET dt_status_validacion = '{$valida}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}

function actualizarBeneficiarios20($id) 
{
  global $mysqli;

  $sql = "UPDATE `beneficiario`
  SET dt_avance_registro = '20'
  WHERE id_usuario = $id
  AND id_cat_entidad IS NOT NULL AND id_cat_entidad != ''  
  AND dt_nombres IS NOT NULL AND dt_nombres != ''
  AND dt_apaterno IS NOT NULL AND dt_apaterno != ''
  AND dt_amaterno IS NOT NULL AND dt_amaterno != ''
  AND dt_curp IS NOT NULL AND dt_curp != ''
  AND dt_telefono IS NOT NULL AND dt_telefono != ''
  AND dt_direccion IS NOT NULL AND dt_direccion != '' 
  AND dt_colonia IS NOT NULL  AND dt_colonia != ''
  AND dt_municipio IS NOT NULL AND dt_municipio != '' 
  AND dt_cp IS NOT NULL AND dt_cp != '';";

  if ($mysqli->query($sql) === TRUE)   // se realiza este if para verificar que se ejecuto la consulta 
  {
      //echo "Consulta ejecutada con éxito DEL USUARIO ". $id;
  } 
  else
  {
      //echo "Error al ejecutar la consulta: " . $mysqli->error;
  }
}

function actualizarBeneficiarios40($id)
{
  global $mysqli;
  $sql = 
    "UPDATE `beneficiario`
    SET dt_avance_registro = '40' 
    WHERE  id_usuario = $id    
    AND dt_ies IS NOT NULL AND dt_ies != ''	
    AND dt_carrera IS NOT NULL AND dt_carrera != ''
    AND dt_matricula IS NOT NULL AND dt_matricula != ''
    AND dt_periodo IS NOT NULL AND dt_periodo != ''
    AND dt_periodo_num IS NOT NULL AND dt_periodo_num != ''
    AND dt_creditos IS NOT NULL AND dt_creditos != '' 
    AND dt_ht IS NOT NULL AND dt_ht != ''
    AND dt_avance_registro = '20';";

    if ($mysqli->query($sql) === TRUE) 
    {
    //  echo "Consulta ejecutada con éxito";
    } 
    else
    {
      //echo "Error al ejecutar la consulta: " . $mysqli->error;
    }

  } 

  function actualizarBeneficiarios60($id)
  {
    global $mysqli;
    $sql = "UPDATE `beneficiario`
        SET dt_avance_registro = '60'
        WHERE id_usuario = $id
        AND dt_avance_registro = '40'
        AND (dt_idioma IS NOT NULL AND dt_idioma != '')
        AND (dt_idioma_nivel IS NOT NULL AND dt_idioma_nivel != '');";
      if ($mysqli->query($sql) === TRUE) 
      {
        //echo "Consulta ejecutada con éxito";
      } 
      else
      {
        //echo "Error al ejecutar la consulta: " . $mysqli->error;
      }
  }

  function actualizarBeneficiarios80($id)
  {
    global $mysqli;
    
    $sql = "UPDATE `beneficiario` b
    JOIN `digital_beneficiario` db ON b.id_usuario = db.id_usuario
    SET b.dt_avance_registro = '80'
    WHERE b.id_usuario = $id
    AND b.dt_avance_registro = '60'
    AND (db.url_cv IS NOT NULL AND db.url_cv != '')
    AND (db.url_curp IS NOT NULL AND db.url_curp != '')
    AND (db.url_acta IS NOT NULL AND db.url_acta != '')
    AND (db.url_com_domicilio IS NOT NULL AND db.url_com_domicilio != '')
    AND (db.url_identificacion IS NOT NULL AND db.url_identificacion != '')
    AND (db.url_seguro IS NOT NULL AND db.url_seguro != '')
    AND (db.url_cuenta IS NOT NULL AND db.url_cuenta != '');";


      if ($mysqli->query($sql) === TRUE) 
      {
        //echo "Consulta ejecutada con éxito";
      } 
      else
      {
        //echo "Error al ejecutar la consulta: " . $mysqli->error;
      }
  
    
  }


  function actualizarBeneficiarios100($id)
  {
    global $mysqli;
    $sql = "UPDATE `beneficiario` b
    JOIN `validacion_ben` db ON b.id_usuario = db.id_usuario
    SET b.dt_avance_registro = '100'
    WHERE b.id_usuario = $id
    AND b.dt_avance_registro = '80';";



      if ($mysqli->query($sql) === TRUE) 
      {
        //echo "Consulta ejecutada con éxito";
      } 
      else
      {
        //echo "Error al ejecutar la consulta: " . $mysqli->error;
      }
  
    
  }

  // Insertar la ies en caso de que el candidato seleccione Otros
  function insert_ies($nombreescuela, $id_entidad) {
    global $mysqli;
    $sql = "INSERT INTO cat_ies (id_cat_ies, dt_nombre_ies, id_cat_entidad) VALUES ('act', '{$nombreescuela}', '{$id_entidad}')";
    return $mysqli->query($sql);
}
  // Insertar la carrera
  function insert_carrera($nombrecarrera){
    global $mysqli;
    $sql = "INSERT INTO cat_carrera (id_cat_carrera, dt_nombre_carrera) VALUES ('act', '{$nombrecarrera}')";
    return $mysqli->query($sql);
  }
//  Buscar primero si la ies existe en el catalogo
function buscar_primero_ies($nombreescuela){
  global $mysqli;
  $sql = "SELECT * FROM cat_ies WHERE dt_nombre_ies = '{$nombreescuela}'";
  $result = $mysqli->query($sql);  // Corregido el nombre de la variable
  $id_general = $result->fetch_assoc();
  return $id_final = $id_general['id'];
}

// valida_ies
function valida_ies($id_cat_ies, $id_entidad) {
  global $mysqli;
  // $sql = "SELECT * FROM cat_ies LEFT JOIN relacion USING(id_cat_ies) LEFT JOIN cat_entidad USING (id_cat_entidad) WHERE cat_ies.id_cat_ies = '{$id_cat_ies}' and relacion.id_cat_entidad = '{$id_entidad}'";
  $sql = "SELECT * 
  FROM cat_ies 
  -- LEFT JOIN cat_entidad USING (id_cat_entidad) 
  LEFT JOIN relacion USING(id_cat_ies) 
  WHERE cat_ies.id_cat_ies = '{$id_cat_ies}' AND relacion.id_cat_entidad = '{$id_entidad}';
  ";
  $result = $mysqli->query($sql);

  if ($result && $result->num_rows > 0) {
      $id_general = $result->fetch_assoc();
      return $id_general['id'];
  } else {
      return 0; // o cualquier otro valor predeterminado que desees devolver en caso de que no haya resultados
  }
}

// La siguiente funcion valida el nombre de la entidad con que se registro
function valida_ies_nombre($id_cat_ies,$id_entidad){
  global $mysqli;
  $sql = "SELECT * 
  FROM cat_ies 
  LEFT JOIN cat_entidad USING (id_cat_entidad)  
  LEFT JOIN relacion USING (id_cat_entidad)  
  WHERE (cat_ies.id_cat_ies = '{$id_cat_ies}' AND relacion.id_cat_entidad = '{$id_entidad}')  ";
  $result = $mysqli->query($sql);
  return $result->fetch_assoc();
}

// Buscar el catalogo 
function buscar_ies($nombreescuela){
  global $mysqli;
  $sql = "SELECT * FROM cat_ies WHERE id_cat_ies = 'act' AND dt_nombre_ies = '{$nombreescuela}'";
  $result = $mysqli->query($sql);  // Corregido el nombre de la variable
  $id_general = $result->fetch_assoc();
  return $id_final = $id_general['id'];
}
// Buscar la carrera
function buscar_carrera($nombrecarrera){
  global $mysqli;
  $sql = "SELECT * FROM cat_carrera WHERE id_cat_carrera = 'act' AND dt_nombre_carrera = '{$nombrecarrera}'";
  $result = $mysqli->query($sql);  // Corregido el nombre de la variable
  $id_general = $result->fetch_assoc();
  return $id_final = $id_general['id'];
}

// Actualizar el catalogo
function update_ies($id_escuela){
  global $mysqli;
  $sql = "UPDATE cat_ies SET id_cat_ies = '{$id_escuela}' WHERE id = '{$id_escuela}'";
  $mysqli->query($sql);  // Corregido el nombre de la variable
}

// Actualizar el catalogo
function update_carrera($id_escuela){
  global $mysqli;
  $sql = "UPDATE cat_carrera SET id_cat_carrera = '{$id_escuela}' WHERE id = '{$id_escuela}'";
  $mysqli->query($sql);  // Corregido el nombre de la variable
}

// Busqueda ya completa en el catalogo
function buscar_ies_final($id_ies,$nombreescuela){
  global $mysqli;
  $sql = "SELECT * FROM cat_ies WHERE id = '{$id_ies}' AND dt_nombre_ies = '{$nombreescuela}'";
  $result = $mysqli->query($sql);  // Corregido el nombre de la variable
  $id_general = $result->fetch_assoc();
  return $id_final = $id_general['id'];
}
// carrera agregada correctamente al catalogo tanto campo id como id_cat_carrera
function buscar_carrera_final($id_carrera,$nombrecarrera){
  global $mysqli;
  $sql = "SELECT * FROM cat_carrera WHERE id = '{$id_carrera}' AND dt_nombre_carrera = '{$nombrecarrera}'";
  $result = $mysqli->query($sql);  // Corregido el nombre de la variable
  $id_general = $result->fetch_assoc();
  return $id_final = $id_general['id'];
}

// Buscar la relacion en la tabla relacion para validar si ya se encuentra la IES sino se agrega al catalogo de relacion con la carrera y la IES


function insert_relacion($id, $empresa, $vacante)
{
global $mysqli;
$sql="INSERT INTO rel_beneficiario_vacante(id_rel_beneficiario_vacante, id_usuario, id_empresa, id_vacante) VALUES (null, '{$id}', '{$empresa}', '{$vacante}')";
$mysqli->query($sql);
}


function update_relacion($id, $empresa, $vacante)
{
  global $mysqli;
  $sql = "UPDATE rel_beneficiario_vacante SET id_empresa = '{$empresa}', id_vacante = '{$vacante}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}



function update_clabe($id, $clabe)
{
  global $mysqli;
  $sql = "UPDATE digital_beneficiario SET dt_clabe = '{$clabe}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}




function update_dig_con($id, $entregacontacto, $tipocont)
{
  global $mysqli;
  $sql = "UPDATE digital_beneficiario SET dt_nom_contacto = '{$entregacontacto}', dt_tipocontacto = '{$tipocont}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}




function update_guia($id, $paqueteria, $guia)
{
  global $mysqli;
  $sql = "UPDATE digital_beneficiario SET dt_paqueteria = '{$paqueteria}', dt_guia = '{$guia}' WHERE id_usuario ='{$id}' ";
  $mysqli->query($sql); 
}

?>