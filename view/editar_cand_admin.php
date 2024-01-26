<?php   
   include_once('../model/databases_beneficiario.php');
   session_start();
  //  error_reporting(0);
   mysqli_set_charset( $mysqli, 'utf8');
   // Verificar si la sesión está iniciada
    if (!isset($_SESSION['id'])) {
      // La sesión no está iniciada, redireccionar a la página de inicio de sesión
      header('Location: ../index.php');
      exit(); // Asegurarse de que el script se detenga después de la redirección
    }
   $id=$_GET['ben'];
   $_SESSION['beneficiarop'] = $id;
   $beneficiario = acces_beneficiario($id);
   $result = run_entidad();
   $empresas=view_empresas();
   $rel=view_relacion($id);
   $relacion=view_rel_ben_us($id);
   ?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta name="author" content="">
 <title>Empresarial</title>
     <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
      <link href="../css/style.css" rel="stylesheet" type="text/css">
      <link href="../css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
      <script language="javascript" src="../js/jquery-2.1.3.min.js"></script>   
      <!--<script type="text/javascript" src="../js/jquery.min.js"></script>-->
      <!-- Initialize the plugin: -->
<!-- Initialize the plugin: -->



     <script language="javascript">
      $(document).ready(function(){
        $("#empresa").change(function () {          
          $("#empresa option:selected").each(function () {
            id_usuario = $(this).val();
            $.post("../includes/getVacante.php", { id_usuario: id_usuario }, function(data){
              $("#vacante").html(data);
            });            
          });
        })
      });      
    </script>

    <script language="JavaScript"> 
        function conMayusculas(field) 
        { 
            field.value = field.value.toUpperCase() 
        }   
</script>
</head>

   <body>
<div class="container-fluid" style="background-color: #f5f5f5">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="../img/empresarial.png" alt="Dispute Bills">
        </a>
      </div>
      <div id="navbar1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class=""><a href="#">Inicio</a></li>
          <li><a href="#">Vacantes</a></li>
           <li><a href="../admin.php">Salir</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>

    <section>
         <div class="container-fluid">

          <div class="row"><br><br><br>
               <div class="col-md-10 col-md-offset-1">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class="active"><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li><a class="colora" href="noaplica.php" >No aplica</a></li>
                        </ul>
                </div>
               </div>
          </div>

          <div class="row">      
      <!-- seccion datos -->      
      <div class="col-md-5 col-md-offset-1">
              <h3><br>Datos Personales</h3><br> 
              <form action="../controller/edit_beneficiario_admin.php" method="POST">            
                <div class="col-md-4">
                <div class="form-group">
                  <label>Nombre(s)</label>
                  <input type="text" name="nombre" class="form-control" onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_nombres'] ?>" required>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Apellido Paterno</label>
                  <input type="text" name="apaterno" class="form-control" onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_apaterno']?>" required>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Apellido Materno</label>
                   <input type="text" name="amaterno" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_amaterno']?>" required>
                </div>
                </div>

                <div class="col-md-12">
                <div class="form-group">
                  <label>CURP</label>
                   <input type="text" name="curp" class="form-control" id="curp_input" oninput="validarInput(this)" placeholder="Ingrese su CURP"  value="<?php echo $beneficiario['dt_curp'] ?>" required>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Teléfono</label>
                   <input type="text" class="form-control"   maxlength="10" value="<?php echo $beneficiario['dt_telefono'] ?>">
                </div>
                </div> 
                <div class="col-md-6">
                <div class="form-group">
                  <label>Correo</label>
                   <input class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_correo']?>" >
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Dirección(calle y número)</label>
                   <input type="text" name="direccion" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_direccion']?>" required>
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label>Colonia/Barrio/Zona..</label>
                   <input type="text" name="colonia" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_colonia']?>" required>
                </div>
                </div>   

                <div class="col-md-12">
                <div class="form-group">
                  <label>Municipio</label>
                  <input type="text" name="municipio" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_municipio']?>" required>
                </div>
                </div> 

                <div class="col-md-6">
                           <div class="form-group">
                              <!-- State Button -->
                              <label class="control-label">Entidad federativa:</label>
                              <?php if($beneficiario['id_cat_entidad']!=NULL){?>
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" required>
                              <?php 
                                 echo '<option value="'.$beneficiario['id_cat_entidad'].'">'.$beneficiario['nombre_entidad'].'</option>'
                                 ?>
                                 <?php
                                     while ($resul = $result->fetch_assoc()) { 
                                       echo '<option value="'.$resul['id_cat_entidad'].'">'.$resul['nombre_entidad'].'</option>';
                                     }
                                 ?>
                              </select>
                              <?php } else { ?>
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" required>
                                 <option value="" <?php if (!(strcmp("", $beneficiario['nombre_entidad']))) {echo "selected=\"selected\"";} ?>></option>
                                 <?php  
                                    if ($result->num_rows > 0) {
                                     while ($resul = $result->fetch_assoc()) { 
                                       echo '<option value="'.$resul['id_cat_entidad'].'">'.$resul['nombre_entidad'].'</option>';
                                    }
                                    }       
                                    ?>
                              </select>
                              <?php } ?>
                           </div>
                        </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label>Codigo Postal</label>
                  <input type="text" name="cp" class="form-control" maxlength="5" value="<?php echo $beneficiario['dt_cp']?>" required>
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">  
                  <input type="hidden" name="id" value="<?php echo $beneficiario['id_usuario']?>" />
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Actualizar</button><br><br>
                  </div>
                </div>
              </form>

                <hr>
                <div class="col-md-12">
                <h3>Datos Academicos</h3><br>
                </div>     
                <form action="../controller/edit_datosacademicos_admin.php" method="POST"> 
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>IES</label>
                      <?php

                        $id_valida_ies = buscar_ies_final($beneficiario['id_ies_relacion'], $beneficiario['dt_nombre_ies']);
                        // $id_valida_carrera = buscar_carrera_final($beneficiario['id_cat_carrera'], $beneficiario['dt_nombre_carrera']);
                        $validacion = valida_ies($id_valida_ies, $beneficiario['id_cat_entidad']);
                        // $validacion_nombre = valida_ies_nombre($id_valida_ies, $beneficiario['id_cat_entidad']) ?? '' ;
                        if (valida_ies_nombre($id_valida_ies, $beneficiario['id_cat_entidad']) !== null) {
                          $validacion_nombre = valida_ies_nombre($id_valida_ies, $beneficiario['id_cat_entidad']);
                      } else {
                          $validacion_nombre = 'falso';
                      }

                        if ($validacion == null && $validacion_nombre == 'falso' ) {

                          ?>
                          <input type="text" class="form-control"  style=" border:1px solid red" value="Sin registro" disabled>
                          <?php
                          
                      }

                        elseif ($validacion === 0 ) {
                            echo "Agregada en la entidad ".$validacion_nombre['nombre_entidad']." esta IES se puede agregar a esta entidad";
                            ?>

                            <!-- <form action="../controller/agregar_ies_al_catalogo.php" method="POST"> -->
                              <input type="text" class="form-control " id="id_ies" style="display:none;" name="id_ies"  value="<?php echo $id_valida_ies; ?>"  >
                              <input type="text" class="form-control " id="id_entidad" style="display:none;" name="id_entidad"  value="<?php echo $beneficiario['id_cat_entidad']; ?>" >
                              <input type="text" class="form-control" id="nueva_ies" name="nueva_ies" style="color:#fff; background:red; border:1px solid red" value="<?php echo $beneficiario['dt_nombre_ies'] ?>" required>
                              <br>
                              <!-- <button type="submit" class="btn btn-primary p-2 ">Agregar al catalogo de IES</button> -->
                              <button type="button" data-toggle="modal" href="#mi_modal" name="accion" value="ies" class="btn btn-primary p-2 ">Agregar al catalogo de IES</button>
                            <!-- </form> -->
                            <?php
                        } elseif ($validacion_nombre['nombre_entidad'] != null){
                      ?>
                      <h5>Ubicada en la <b>Entidad de: </b> <?php echo $validacion_nombre['nombre_entidad'];?></h5>
                      <input type="text" class="form-control " id="id_ies" style="display:none;" name="id_ies"  value="<?php echo $id_valida_ies; ?>"  >
                      <input type="text" class="form-control" id="nombre_ies" name="nombre_ies"  value="<?php echo $beneficiario['dt_nombre_ies'];?>" required>
                      <p>Si se edita este campo se editara en la base de datos, y asi es como les aparecera a los candidatos</p>
                    <?php }else{ ?>
                      <input type="text" class="form-control"  style=" border:1px solid red" value="Sin registro" disabled>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Carrera</label>
                     <input type="text" class="form-control" value="<?php echo $beneficiario['dt_nombre_carrera']?>" required>
                    </div>
                  </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Matricula o Número de control</label>
        <input type="text" name="matricula" class="form-control" value="<?php echo $beneficiario['dt_matricula'] ?>" required>
      </div>
    </div>


    <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Tipo de periodo que cursas</label>

                                 <?php if($beneficiario['dt_periodo']!=NULL){?>
                              <select class="form-control" name="periodo">
                              <?php 
                                 echo '<option value="'.$beneficiario['dt_periodo'].'" selected="">'.$beneficiario['dt_periodo'].'</option>'
                                 ?>
                                <option value="SEMESTRE">SEMESTRE</option>
                                <option value="CUATRIMESTRE">CUATRIMESTRE</option>
                                <option value="SEMESTRE">TRIMESTRE</option>
                              </select>
                              <?php } else { ?>
                              
                            <select class="form-control" name="periodo" required>
                                 <option value="SEMESTRE">SEMESTRE</option>
                                <option value="CUATRIMESTRE">CUATRIMESTRE</option>
                                <option value="SEMESTRE">TRIMESTRE</option>
                            </select> 
                          <?php }?>

                           </div>
                        </div>


    <div class="col-md-6">
      <div class="form-group">
        <label>No. Periodo que cursa</label>
        <input type="text" name="no_periodo" placeholder="Ejemplo: 8" maxlength="2" class="form-control" value="<?php echo $beneficiario['dt_periodo_num'] ?>" required>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Porcentaje de Créditos</label>
        <input type="text" name="no_creditos" maxlength="3" placeholder="Ejemplo: 80" class="form-control" value="<?php echo $beneficiario['dt_creditos'] ?>"  required>
      </div>
    </div> 

    <div class="col-md-4">
                <div class="form-group">  
                   <input type="hidden" name="id" value="<?php echo $beneficiario['id_usuario']?>" />
                    <button type="button" data-toggle="modal" href="#mi_modal2" name="accion" value="datos" class="btn btn-block btn-primary btn-lg">Actualizar</button><br><br>
                  </div>
                </div>

                            <div class="modal fade" id="mi_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                      <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Estas Seguro de Actualizar los datos?</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row" style="padding:15px">
                                      Se agregara la IES al catalogo.
                                      <br>
                                      <!-- <a class="btn btn-default" href="../controller/elimina_empresa.php?vac=<?php echo $emp['id_empresa']; ?>">Eliminar</a> -->
                                      <button type="submit"  name="accion" value="ies" class="btn  btn-default ">Actualizar</button>
                                      <button type="button" class="btn btn-danger " data-dismiss="modal">Cancelar</button>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade" id="mi_modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                      <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Estas Seguro de Actualizar los datos?</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row" style="padding:15px">
                                      Si actualizaste el campo de la IES o CARRERA, le aparecera a los demas candidatos el mismo nombre.
                                      <br>
                                      <!-- <a class="btn btn-default" href="../controller/elimina_empresa.php?vac=<?php echo $emp['id_empresa']; ?>">Eliminar</a> -->
                                      <button type="submit"  name="accion" value="datos" class="btn  btn-default ">Actualizar</button>
                                      <button type="button" class="btn btn-danger " data-dismiss="modal">Cancelar</button>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
  </form>

    <hr>
                <div class="col-md-12">
                <h3>Datos Bancarios</h3><br>
                </div>     
            <form action="../controller/update_bancarios_admin.php" method="POST"> 
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>CLABE</label>
                      <input type="text" name="clabe" class="form-control"  value="<?php echo $beneficiario['dt_clabe']?>" required>
                    </div>
                  </div>

                  <div class="col-md-4">
                <div class="form-group">  
                  <input type="hidden" name="id" value="<?php echo $beneficiario['id_usuario']?>" />
                  <button type="submit"  class="btn btn-block btn-primary btn-lg">Actualizar</button><br><br>
                  </div>
                </div>


            </form>

                  <br><br><br>
                  </div>
    <!-- /seccion datos --> 

              <div class="col-md-1">
              </div>

<!-- Digitales-->
<div class="col-md-4">  
<div class="col-md-12">  
  <form action="../controller/update_digitales_admin.php" enctype="multipart/form-data" method="post">
              <div class="row"><br><br><h3>Archivos Digitales</h3><br> 
                <!-- COMPONENT START -->
                <div class="col-md-12"> 
                           <label>CURRICULUM VITAE</label>
                          <?php if($beneficiario['url_cv']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_cv'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div>              
                <div class="form-group">
                  <div class="input-group input-file" name="cv" required>
                      <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->
                <!-- COMPONENT START -->
               
                <!-- COMPONENT START -->
                  <div class="col-md-12"> 
                           <label>CURP</label>
                          <?php if($beneficiario['url_curp']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_curp'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group"> 
                  <div class="input-group input-file" name="curp">
                    <span class="input-group-btn">
                           <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->
                     
                <!-- COMPONENT START -->
                  <div class="col-md-12"> 
                           <label>ACTA DE NACIMIENTO</label>
                          <?php if($beneficiario['url_acta']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_acta'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group">
                  <div class="input-group input-file" name="acta">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->

                <!-- COMPONENT START -->
                  <div class="col-md-12"> 
                           <label>COMPROBANTE DE DOMICILIO</label>
                          <?php if($beneficiario['url_com_domicilio']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_com_domicilio'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group">
                  <div class="input-group input-file" name="domicilio">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->
                       
                <!-- COMPONENT START -->
                  <div class="col-md-12"> 
                           <label>INE / CARTILLA / PASAPORTE(por ambos lados)</label>
                          <?php if($beneficiario['url_identificacion']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_identificacion'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group"> 
                  <div class="input-group input-file" name="identificacion">
                    <span class="input-group-btn">
                         <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->
                

                <!-- COMPONENT START -->
                  <div class="col-md-12"> 
                           <label>SEGURO MÉDICO VIGENTE</label>
                          <?php if($beneficiario['url_seguro']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_seguro'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group">
                  <div class="input-group input-file" name="seguro">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->
                     
                <!-- COMPONENT START -->
                <div class="col-md-12"> 
                           <label>COMPROBANTE DE ESTUDIOS(Que muestre Nombre, Institución y Carrera)</label>
                          <?php if($beneficiario['url_com_estudios']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_com_estudios'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group"> 
                  <div class="input-group input-file" name="com_estudios">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                <!-- / -->

                <!-- COMPONENT START -->
                  <div class="col-md-12"> 
                           <label>COMPROBANTE DE CUENTA BANCARIA (Que muestre Banco, Tipo de Cuenta, Nombre y Clabe)
                          <?php if($beneficiario['url_cuenta']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_cuenta'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?></label>

                </div> 
                <div class="form-group"> 
                  <div class="input-group input-file" name="cuenta">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>



                <div class="col-md-12">
                  <div class="form-group">
                    <label>CLABE de 18 dígitos</label>
                    <input type="text" name="clabe" maxlength="18" class="form-control" value="<?php echo $beneficiario['dt_clabe'];?>" required>
                  </div>
                </div>
                <!-- / -->
              </div> 


              <div class="col-md-3 col-md-offset-9"><br><br>
                           <div class="form-group">
                              <input type="hidden" name="id" value="<?php echo $beneficiario['id_usuario']?>" />
                              <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Actualizar">
                              <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                           </div>
             </div>
  </form> 
</div>



<div class="col-md-12">
<form action="../controller/edit_relacion_admin.php" method="POST">
              <div class="row"><br><h3>Vacante</h3><br>             
                <!-- COMPONENT START -->
                <div class="col-md-5"> 
                 <div class="form-group">
                      <label>EMPRESA</label>
                      <input type="text" name="clabe" class="form-control"  value="<?php echo $relacion['dt_nombre_comercial']?>" required>
                 </div>                                
                 <div class="form-group">
                              <!-- State Button -->
                        <label class="control-label">SELECCIONA OTRA EMPRESA</label>
                        <select class="form-control" name="empresa" id="empresa"> 
                        <option value="">Seleccionar Empresa</option>                         
                          <?php while($row = $empresas->fetch_assoc()) { ?>
                          <option value="<?php echo $row['id_usuario']; ?>"><?php echo $row['dt_nombre_comercial']; ?></option>
                          <?php } ?>
                        </select>                         
                </div>
                </div> 
                <!-- / -->
                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>
                <!-- COMPONENT START -->
                <div class="col-md-5">
                <div class="form-group">
                      <label>VACANTE</label>
                      <input type="text" name="clabe" class="form-control"  value="<?php echo $relacion['dt_nombre']?>" required>
                 </div> 
                <div class="form-group"> 
                  <label>SELECCIONA OTRA VACANTE</label>
                  <select class="form-control" name="vacante" id="vacante"></select>
                </div>
                </div> 
                <div class="col-md-3 col-md-offset-9">
                  <div class="form-group"><br><br>
                  <input type="hidden" name="id" value="<?php echo $beneficiario['id_usuario']?>" />    
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Actualizar</button><br><br>
                  </div>
                </div>
              </div>  
</form>
</div>


    </div>  <!-- /Digitales-->




 










       
 


</div> <!--/row -->

         </div>
    </section>


<script>
function bs_input_file() {
  $(".input-file").before(
    function() {
      if ( ! $(this).prev().hasClass('input-ghost') ) {
        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
        element.attr("name",$(this).attr("name"));
        element.change(function(){
          element.next(element).find('input').val((element.val()).split('\\').pop());
        });
        $(this).find("button.btn-choose").click(function(){
          element.click();
        });
        $(this).find("button.btn-reset").click(function(){
          element.val(null);
          $(this).parents(".input-file").find('input').val('');
        });
        $(this).find('input').css("cursor","pointer");
        $(this).find('input').mousedown(function() {
          $(this).parents('.input-file').prev().click();
          return false;
        });
        return element;
      }
    }
  );
}
$(function() {
  bs_input_file();
});
</script>



</body>
</html>