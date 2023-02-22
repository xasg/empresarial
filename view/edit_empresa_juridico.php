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
        <a class="navbar-brand" href="#"><img src="../img/empresarial.png" >
        </a>
      </div>
      <div id="navbar1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class=""><a href="empresarial_juridico.php">Inicio</a></li>
          <li><a href="#">Catálogos</a></li>
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
    <div class="col-md-6">
      <br><h2>Datos de la empresa</h2>
               <form action="../controller/update_empresa_juridico.php" method="POST">  
                        <div class="col-md-12">
                           <div class="form-group">
                              <!-- Full Name --><br>
                              <label class="control-label">Nombre, denominación o razón social:</label>
                              <input type="text" class="form-control" name="razon" value="<?php echo $empresa['dt_razon_social']?>" onChange="conMayusculas(this)" >
                           </div>
                        </div>
                        <div class="col-md-12">
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
                        <div class="col-md-12">
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

                         <div class="col-md-12">
                        <h2><br>Representante Legal<br><br></h2>
                      </div>


                      <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Nombre completo</label>
                              <input type="text" class="form-control" name="nombre_representante" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_representante']?>" required>
                           </div>
                        </div>

                       <div class="col-md-6 col-md-offset-3"><br><br>
                           <div class="form-group">
                              <!-- Submit Button -->
                              <input type="hidden" name="id" value="<?php echo $id; ?>" />
                              <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                           </div>
                        </div>
              </form>
</div> 



  <div class="col-md-5 col-md-offset-1"><br><h2>Archivos de la empresa</h2>
    <form action="../controller/upload_juridico.php" enctype="multipart/form-data" method="post">
      <div class="col-sm-12 col-md-12"><br></div>  
      <!-- /seccion 1 -->


        <div class="col-md-12"> 
         <label>Constancia de situación fiscal</label>
         <?php if($doc['url_constancia']!=NULL){ ?>
          <a href="<?php echo $doc['url_constancia'];?>" target="_black"> 
            <label style="color: #0098A9;">Consultar</label></a>
          <?php } ?>
        </div> 
        <div class="form-group">
          <div class="input-group input-file" name="file1">
            <span class="input-group-btn">
              <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
            </span>
            <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
            <span class="input-group-btn">
             <button class="btn btn-default btn-reset" type="button">Reiniciar</button>
           </span>
         </div>
       </div>

       <div class="col-md-12"> 
         <label>INE representante legal</label>
         <?php if($doc['url_ine']!=NULL){ ?>
          <a href="<?php echo $doc['url_ine'];?>" target="_black"> 
            <label style="color: #0098A9;">Consultar</label></a>
          <?php } ?>
        </div> 
        <div class="form-group">
          <div class="input-group input-file" name="file2">
            <span class="input-group-btn">
               <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
            </span>
            <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
            <span class="input-group-btn">
             <button class="btn btn-default btn-reset" type="button">Reiniciar</button>
           </span>
         </div>
       </div>

       <div class="col-md-12"> 
         <label>Comprobante de acta constitutiva</label>
         <?php if($doc['url_acta']!=NULL){ ?>
          <a href="<?php echo $doc['url_acta'];?>" target="_black"> 
            <label style="color: #0098A9;">Consultar</label></a>
          <?php } ?>
        </div> 
        <div class="form-group">
          <div class="input-group input-file" name="file3">
            <span class="input-group-btn">
              <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
            </span>
            <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
            <span class="input-group-btn">
             <button class="btn btn-default btn-reset" type="button">Reiniciar</button>
           </span>
         </div>
       </div>




      <div class="col-md-12"> 
       <label>Poder del Representante Legal</label>
       <?php if($doc['url_facultades']!=NULL){ ?>
        <a href="<?php echo $doc['url_facultades'];?>" target="_black"> 
          <label style="color: #0098A9;">Consultar</label></a>
        <?php } ?>
      </div> 
      <div class="form-group">
        <div class="input-group input-file" name="file4">
          <span class="input-group-btn">
            <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
          </span>
          <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
          <span class="input-group-btn">
           <button class="btn btn-default btn-reset" type="button">Reiniciar</button>
         </span>
       </div>
     </div>

      <div class="col-md-12"> 
       <label>Comprobante de domicilio de la empresa</label>
       <?php if($doc['dt_domicilio']!=NULL){ ?>
        <a href="<?php echo $doc['dt_domicilio'];?>" target="_black"> 
          <label style="color: #0098A9;">Consultar</label></a>
        <?php } ?>
      </div> 
      <div class="form-group">
        <div class="input-group input-file" name="file5">
          <span class="input-group-btn">
            <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
          </span>
          <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
          <span class="input-group-btn">
           <button class="btn btn-default btn-reset" type="button">Reiniciar</button>
         </span>
       </div>
     </div>

                        <div class="col-md-4 col-md-offset-4"><br>
                         <div class="form-group">
                          <input type="hidden" name="id" value="<?php echo $id; ?>" />
                          <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Actualizar">
                          <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                        </div>
                      </div>
 </form>
            </div>
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