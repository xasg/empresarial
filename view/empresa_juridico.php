<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $id=$_GET['vac'];
   $empresa = get_usuario($id);
   $usuario = view_empresa($id);
   $result = run_entidad();
   $giro = run_giro();
   $doc=get_docs($id);
   ?>
<!DOCTYPE html>
<html lang="es">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="FESE" content="">
     <title>Empresarial</title>
     <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
     <link href="../css/bootstrap.css" rel="stylesheet">
     <link href="../css/style.css" rel="stylesheet"> 
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
         <div class="container">
            <div class="row"><br><br><br>
               <div class="col-md-12">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="colora" href="empresarial_juridico.php" >Empresas</a></li>
                            <li class=""><a class="colora" href="juridico.php" >Beneficiarios</a></li>
                        </ul>
                </div>
               </div>
          </div>


 <div class="row">  
    <div class="col-md-12">
      <br><h2>Datos de la empresa</h2>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Full Name --><br>
                              <label class="control-label">Nombre, denominación o razón social:</label>
                              <input type="text" class="form-control" name="razon" value="<?php echo $empresa['dt_razon_social']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 --><br>
                              <label class="control-label">Nombre comercial:</label>
                              <input type="text" class="form-control" name="nombre" value="<?php echo $empresa['dt_nombre_comercial']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">RFC:</label>
                              <input type="text" class="form-control" name="rfc" value="<?php echo $empresa['dt_rfc']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>
                        
                         <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Giro:</label>
                              <?php if($empresa['id_giro']!=NULL){?>
                              <select class="form-control" name="giro" >
                              <?php 
                                 echo '<option value="'.$empresa['id_giro'].'" selected="">'.$empresa['dt_nombre_giro'].'</option>'
                                 ?>
                                <?php  
                                     while ($gir = $giro->fetch_assoc()) { 
                                       echo '<option value="'.$gir['id_giro'].'">'.$gir['dt_nombre_giro'].'</option>';
                                    }     
                                ?>
                              </select>
                              <?php } else { ?>
                              
                            <select class="form-control" name="giro" >
                                <?php  
                                     while ($gir = $giro->fetch_assoc()) { 
                                       echo '<option value="'.$gir['id_giro'].'">'.$gir['dt_nombre_giro'].'</option>';
                                    }     
                                ?>
                              </select>
                          <?php }?>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Tamaño de la empresa:</label>

                                 <?php if($empresa['dt_tamano']!=NULL){?>
                              <select class="form-control" name="tamano">
                              <?php 
                                 echo '<option value="'.$empresa['dt_tamano'].'" selected="">'.$empresa['dt_tamano'].'</option>'
                                 ?>
                                <option value="MICRO">Micro de 1 a 10 trabajadores</option>
                                <option value="PEQUEÑA">Pequeña de 11 a 100 trabajadores</option>
                                <option value="MEDIANA">Mediana de 101 a 150 trabajadores</option>
                                <option value="GRANDE">Grande mas de 150 trabajadores</option>
                              </select>
                              <?php } else { ?>
                              
                            <select class="form-control" name="tamano" >
                                <option value="MICRO" selected="">Micro de 1 a 10 trabajadores</option>
                                <option value="PEQUEÑA">Pequeña de 11 a 100 trabajadores</option>
                                <option value="MEDIANA">Mediana de 101 a 150 trabajadores</option>
                                <option value="GRANDE">Grande mas de 150 trabajadores</option>
                            </select> 
                          <?php }?>

                           </div>
                        </div>                        

                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Organismos a los que esta afiliado:</label>
                              <?php if($empresa['dt_org_afiliado']!=NULL){?>
                              <select class="form-control" name="org" >
                              <?php 
                                 echo '<option value="'.$empresa['dt_org_afiliado'].'" selected="">'.$empresa['dt_org_afiliado'].'</option>'
                                 ?>
                                <option value="CANACINTRA">CANACINTRA</option>
                                <option value="CMIC">CMIC</option>
                                <option value="CONCAMIN">CONCAMIN</option>
                                <option value="COPARMEX">COPARMEX</option>
                                <option value="NINGUNO">NINGUNO</option>
                              </select>
                              <?php } else { ?>
                              
                            <select class="form-control" name="org" >
                                <option value="CANACINTRA"selected="" >CANACINTRA</option>
                                <option value="CMIC">CMIC</option>
                                <option value="CONCAMIN">CONCAMIN</option>
                                <option value="COPARMEX">COPARMEX</option>
                                <option value="NINGUNO">NINGUNO</option>
                            </select> 
                          <?php }?>
                           </div>
                        </div> 

                        <div class="col-md-12">
                           <div class="form-group">
                              <!-- City-->
                              <label class="control-label">Actividad fiscal:</label>
                              <input type="text" class="form-control" name="actividad" value="<?php echo $empresa['dt_actividad']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>                     

                                         
                        <!-- <div class="col-md-12"><h3><br><strong>DIRECCIÓN</strong></h3></div>-->
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Dirección (Calle y Número):</label>
                              <input type="text" class="form-control" name="direccion" value="<?php echo $empresa['dt_direccion']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Localidad, colonia o barrio:</label>
                              <input type="text" class="form-control" name="colonia" value="<?php echo $empresa['dt_localidad']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- State Button -->
                              <label class="control-label">Entidad federativa:</label>
                              <?php if($empresa['id_entidad']!=NULL){?>
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" id="entidad">
                              <?php 
                                 echo '<option value="'.$empresa['id_cat_entidad'].'">'.$empresa['nombre_entidad'].'</option>'
                                 ?>

                                 <?php
                                     while ($resul = $result->fetch_assoc()) { 
                                       echo '<option value="'.$resul['id_entidad'].'">'.$resul['nombre_entidad'].'</option>';
                                     }

                                 ?>
                              </select>
                              <?php } else { ?>
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" id="entidad" >
                                 <option value="" <?php if (!(strcmp("", $empresa['nombre_entidad']))) {echo "selected=\"selected\"";} ?>></option>
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
                              <!-- Zip Code-->
                              <label lass="control-label">Código Postal:</label>
                              <input type="text" class="form-control" name="cp" value="<?php echo $empresa['dt_cp']?>" >
                           </div>
                        </div>                       
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label for="zip_id" class="control-label">Email:</label>
                              <input type="text" class="form-control" name="email" onChange="conMayusculas(this)"  value="<?php echo $usuario['dt_correo'];?>" >
                           </div>
                        </div>

                        <div class="col-md-12">
                        <h2><br>Contacto Operativo <br><br></h2>
                      </div>

                       <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Nombre completo</label>
                              <input type="text" class="form-control" name="nombre_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_nombre_contacto']?>" >
                           </div>
                        </div>

                         <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Puesto</label>
                              <input type="text" class="form-control" name="puesto_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_puesto_contacto']?>" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Correo</label>
                              <input type="text" class="form-control" name="correo_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_correo_contacto']?>" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Teléfono<?php echo $id?></label>
                              <input type="text" class="form-control" name="telefono_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_telefono_contacto']?>" >
                           </div>
                        </div>

</div> 



<div class="col-md-12">
      <br><h2>Documentos Digitales</h2><br><br>
              <div class="panel panel-default">
                <div class="panel-heading">                   
                  <div class="form-group">
                      <label data-toggle="collapse" href="#collapse1" class="radio-inline"><strong>Constancia de situación fiscal</strong></label>                      
                  </div>
                </div>

                <div id="collapse1" class="panel-collapse collapse">
                     <a class="colora" target="_blank" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$doc['url_constancia'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$doc['url_constancia']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label data-toggle="collapse" href="#collapse2" class="radio-inline"><strong>INE representante legal</strong></label>
                  </div>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$doc['url_ine'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$doc['url_ine']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label data-toggle="collapse" href="#collapse3" class="radio-inline"><strong>Comprobante de acta constitutiva</strong></label>                      
                  </div>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$doc['url_acta'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$doc['url_acta']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>


              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label data-toggle="collapse" href="#collapse4" class="radio-inline"><strong>Comprobante que acredite tener facultades para subscribir convenios</strong></label>                      
                  </div>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$doc['url_facultades'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$doc['url_facultades']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="form-group">
                      <label data-toggle="collapse" href="#collapse5" class="radio-inline"><strong>Comprobante de domicilio de la empresa</strong></label>                      
                  </div>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
              <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$doc['dt_domicilio'])?> ">&nbsp;&nbsp;&nbsp;  Si no se visualiza descarga aquí</a> 
                  <div class="panel-body">
                  <?php
                      echo '<iframe src="http://docs.google.com/gview?url='.str_replace("../","http://empresarial.fese.mx/",$doc['dt_domicilio']).'&embedded=true" style="width:100%; height:400px;" frameborder="0"></iframe>'
                  ?>
                  </div>        
                </div>
              </div>
    </div>  <!-- /Digitales-->
</div>










              </div>
         </div>
      </section>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
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
</body>
</html>