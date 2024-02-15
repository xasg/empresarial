<?php   
   include_once('../model/databases_beneficiario.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   // Verificar si la sesión está iniciada
    if (!isset($_SESSION['id'])) {
      // La sesión no está iniciada, redireccionar a la página de inicio de sesión
      header('Location: ../index.php');
      exit(); // Asegurarse de que el script se detenga después de la redirección
    }
   $id=$_GET['ben'];
   $beneficiario = acces_beneficiario($id);
   $val = valida($id);
   $result = run_entidad();
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
      <!--<script type="text/javascript" src="../js/jquery.min.js"></script>-->
      <!-- Initialize the plugin: -->
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>
        <script language="javascript">
      $(document).ready(function(){
        $("#entidad").change(function () {          
          $("#entidad option:selected").each(function () {
            id_cat_entidad = $(this).val();
            $.post("../includes/getIES.php", { id_cat_entidad: id_cat_entidad }, function(data){
              $("#ies").html(data);
            });            
          });
        })
      });      


      $(document).ready(function(){
        $("#ies").change(function () {          
          $("#ies option:selected").each(function () {
            id_cat_ies = $(this).val();
            $.post("../includes/getCarrera.php", { id_cat_ies: id_cat_ies }, function(data){
              $("#carrera").html(data);
            });            
          });
        })
      });      

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
              <form action="../controller/update_beneficiario_admin.php" method="POST">            
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
                <form action="../controller/update_datosacademicos_admin.php" method="POST"> 
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>IES</label>
                      <input type="text" class="form-control"  value="<?php echo $beneficiario['dt_nombre_ies']?>" required>
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
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Actualizar</button><br><br>
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
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Actualizar</button><br><br>
                  </div>
                </div>
            </form>

                  <br><br><br>
                  </div>
    <!-- /seccion datos --> 

              <div class="col-md-1">
              </div>

<form action="../controller/update_validacion_admin.php" method="POST">
<!-- Digitales-->
<div class="col-md-4">  
  <br><br>  <br><br>  <br><br>
 <h4>VALIDAR DOCUMENTOS DIGITALES</h4> 
              <div class="panel panel-default">
                <div class="panel-heading">                   
                  <div class="form-group">
                   
                      <label class="radio-inline"><input type="radio" value="1" name="curp" <?php if($val['dt_eval_curp']==1){ ?>  checked <?php  } ?>>Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" >No procede</label>  
                      <label data-toggle="collapse" href="#collapse1" class="radio-inline"><strong>CURP</strong></label>
                      <?php if($val['dt_eval_curp']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?>                     
                  </div>
                </div>

                <div id="collapse1" class="panel-collapse collapse">
                     <a class="colora" target="_blank" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_curp'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_curp']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" value="1" name="acta" <?php if($val['dt_eval_acta']==1){ ?>  checked <?php  } ?>>Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" name="acta">No procede</label> 
                      <label data-toggle="collapse" href="#collapse2" class="radio-inline"><strong>ACTA</strong></label>
                       <?php if($val['dt_eval_acta']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?> 
                  </div>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_acta'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_acta']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" value="1" name="domicilio" <?php if($val['dt_eval_domicilio']==1){ ?>  checked <?php  } ?>>Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" name="domicilio">No procede</label> 
                      <label data-toggle="collapse" href="#collapse3" class="radio-inline"><strong>COMPROBANTE DE DOMICILIO</strong>
                      </label>   
                       <?php if($val['dt_eval_domicilio']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?>                    
                  </div>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_com_domicilio'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_com_domicilio']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" value="1" name="identificacion" <?php if($val['dt_eval_identificacion']==1){ ?>  checked <?php  } ?>>Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" name="identificacion">No procede</label>
                      <label data-toggle="collapse" href="#collapse4" class="radio-inline"><strong>IDENTIFICACIÓN</strong></label>  <?php if($val['dt_eval_identificacion']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?>                                         
                  </div>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_identificacion'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_identificacion']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" value="1" name="estudios" <?php if($val['dt_eval_estudios']==1){ ?>  checked <?php  } ?>>Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" name="estudios">No procede</label>
                      <label data-toggle="collapse" href="#collapse5" class="radio-inline"><strong>COMPROBANTE DE ESTUDIOS</strong></label>   
                      <?php if($val['dt_eval_estudios']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?>                   
                  </div>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_com_estudios'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_com_estudios']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" value="1" name="seguro" <?php if($val['dt_eval_seguro']==1){ ?>  checked <?php  } ?>>Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" name="seguro">No procede</label>
                      <label data-toggle="collapse" href="#collapse6" class="radio-inline"><strong>COMPROBANTE SEGURO MEDICO</strong></label> 
                      <?php if($val['dt_eval_seguro']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?>                     
                  </div>
                </div>
                <div id="collapse6" class="panel-collapse collapse">
                    <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_seguro'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                      <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_seguro']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                      ?>
                  </div>        
                </div>
              </div>



              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label class="radio-inline"><input type="radio" value="1" name="bancario" <?php if($val['dt_eval_bancario']==1){ ?>  checked <?php  } ?> >Procede</label>
                      <label class="radio-inline"><input type="radio" value="2" name="bancario">No procede</label>
                      <label data-toggle="collapse" href="#collapse7" class="radio-inline"><strong>COMPROBANTE BANCARIO</strong></label>  
                      <?php if($val['dt_eval_bancario']==1){ ?>
                           <i class='glyphicon glyphicon glyphicon-ok'></i>
                      <?php } ?>                     
                  </div>
                </div>
                <div id="collapse7" class="panel-collapse collapse">
                    <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_cuenta'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                      <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$beneficiario['url_cuenta']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                      ?>
                  </div>        
                </div>
              </div>

    </div>  <!-- /Digitales-->
        <div class="col-md-4 col-md-offset-1">
                <div class="form-group"><br>
                      <label class="radio-inline"><h4><input type="radio" value="1" name="aplica">Aplica</h4></label>
                     <!-- <label class="radio-inline"><h4><input type="radio" value="2" name="aplica">No Aplica</h4></label> <br>-->
                  </div>
        </div>
 
    <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                  <label>Comentario:</label>
                  <textarea class="form-control" name="comentario" rows="5"><?php echo $val['dt_eval_comentario']; ?></textarea>
                </div>
    </div>
    <div class="col-md-3 col-md-offset-1"><br><br> 
                  <div class="form-group">  
                  <input type="hidden" name="id" value="<?php echo $beneficiario['id_usuario']?>" />
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Validar</button><br><br>
                  </div>
    </div>
</form>


</div> <!--/row -->

         </div>
    </section>


</body>
</html>