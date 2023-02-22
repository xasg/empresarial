<?php   
   include_once('../model/databases_beneficiario.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $id=$_SESSION["id"];
   $empresas=view_empresas();
   $rel=view_relacion($id);
   $relacion=view_rel_ben_us($id);
   $val = valida($id);
   $beneficiario =acces_beneficiario($id);
   ?>
<!DOCTYPE html>
<html lang="es">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="author" content="">
     <title>Empresarial</title>
     <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
     <link href="../css/bootstrap.css" rel="stylesheet">
     <link href="../css/style.css" rel="stylesheet"> 
     <script language="javascript" src="../js/jquery-2.1.3.min.js"></script>    
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
        <div class="col-md-6">
        <a class="navbar-brand" href="#"><img src="../img/empresarial.png" alt="Dispute Bills">
        </a>
        </div>
      </div>
      <div id="navbar1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="#">Inicio</a></li>
          <li><a href="#">Vacantes</a></li>
          <li><a href="../index.php">Salir</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>
     <section>
         <div class="container">
          <?php if($relacion['id_empresa']==NULL){ ?>
            <div class="row">
               <div class="col-md-12">
                  <br><br>
               </div>
                    <div class="col-md-12">
                        <ul class="wizard-steps">
                          <li class="finalizado">
                            <a href="#"><h5>Datos</h5> <span>Personales<?php echo $id; ?></span></a>
                          </li>
                          <li class="finalizado">
                             <a href="#"><h5>Datos</h5> <span>Academicos</span></a>
                          </li>
                          <li class="finalizado">
                            <a href="#"><h5>Datos</h5> <span>Complementarios</span></a>
                          </li>            
                          <li class="finalizado">
                            <a href="#"><h5>Archivos</h5> <span>Digitales</span></a>
                          </li>     
                           <li class="completed">
                            <a href="#"><h5>Seleccionar</h5> <span>Vacante</span></a>
                          </li>        
                        </ul>
                    </div>
              

              <form action="../controller/insert_relacion.php" method="POST">
              <div class="row"><br><h2>Vacantes</h2><br>             
                <!-- COMPONENT START -->
                <div class="col-md-5">                 <!-- COMPONENT START -->
                 <div class="form-group">
                              <!-- State Button -->
                        <label class="control-label">EMPRESA</label>
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
                  <select class="form-control" name="vacante" id="vacante"></select>
                </div>
                </div> 
                <div class="col-md-3 col-md-offset-9">
                  <div class="form-group"><br><br>    
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                  </div>
                </div>
              </div>  
              </form>
              </div>

               <?php } else { ?> 
             

        <?php if($relacion['dt_tipocontacto']==NULL){ ?>       
             <div class="row">
           
 <?php if($val['dt_eval_aplica']==1){ ?>
           
              <div class="col-md-12"><br><br><br><br>
                   <div class="col-md-12 text-center">
                    <h1><strong>¡Bienvenido!</strong></h1>
                    <div class="col-md-12 text-center">
                    <h3>El área legal te hará llegar tu convenio con las instrucciones de firma y envío.<br><br></h3>
                  </div>
                </div>
                  <div class="col-md-12">
                    <h4>Te postulaste a la vacante: <?php echo  $relacion['dt_nombre']; ?></h4>
                  </div>
                  <div class="col-md-12">
                     <h4>En la empresa:<?php echo  " ".$relacion['dt_nombre_comercial']; ?></h4>
                      <h4>Con dirección en:<?php echo  " ".$relacion['dt_direccion']. ",".$relacion['dt_localidad']. ", ".$relacion['nombre_entidad']. ", C.P. ".$relacion['dt_cp'] ?></h4>
                  </div>
                  <div class="col-md-3">
                      <h4>Inicio:<?php echo  " ".$relacion['dt_inicio']; ?></h4>
                  </div>
                  <div class="col-md-3">  
                      <h4>Fin:<?php echo  " ". $relacion['dt_termino']; ?></h4>
                 </div>
              </div>

   <?php } else { ?> 



 <?php if($val['dt_eval_curp']==NULL AND $val['dt_eval_acta']==NULL AND $val['dt_eval_domicilio']==NULL AND $val['dt_eval_identificacion']==NULL AND $val['dt_eval_estudios']==NULL AND $val['dt_eval_seguro']==NULL AND $val['dt_eval_bancario']==NULL){ ?>



      <div class="container">
            <div class="row">
               <div class="col-md-8 col-md-offset-2">
                <h3><br><br><br>Gracias por completar tu registro, tu documentación está en proceso de validación mantente al pendiente de tu correo electrónico para saber si fuiste aceptado o si se requiere más información. </h3>
               </div>       

  <?php } else { ?>      


         <div class="col-md-12"> 
          <form action="../controller/update_digitales_candidato.php" enctype="multipart/form-data" method="post">
              <div class="row">
               <br>
                <h4><br><br>Estimado postulante, nos encontramos en proceso de revisión de tu expediente, sin embargo detectamos algunos documentos incorrectos, por lo cual te pedimos  los vuelvas a subir a la plataforma, atendiendo a los siguientes comentarios:<br><br>
                  <?php  echo $val['dt_eval_comentario'] ?>
</h4>
               <br> 


               <div class="col-md-12 text-center"> 
               <?php if($val['dt_status_validacion']==2){ ?>
                <h3 style="color: green">Se ha actualizado correctamente<br><br></h3>
               <?php } ?>
               </div>
                <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>ACTA</label>
                           <?php if($beneficiario['url_acta']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_acta'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                           <?php if($val['dt_eval_acta']==1){ ?>
                                       <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div>                 
                    </div> 
                <!-- / -->

                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>

                <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>CURP</label>
                           <?php if($beneficiario['url_curp']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_curp'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                           <?php if($val['dt_eval_curp']==1){ ?>
                          <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div> 
                
                    </div> 
                <!-- / -->

                <div class="col-md-12"><br>
                </div>

                 <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>COMPROBANTE DE DOMICILIO</label>
                            <?php if($beneficiario['url_com_domicilio']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_com_domicilio'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                           <?php if($val['dt_eval_domicilio']==1){ ?>
                           <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div> 
                
                    </div> 
                <!-- / -->

                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>


                <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>IDENTIFICACIÓN</label>
                           <?php if($beneficiario['url_identificacion']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_identificacion'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                           <?php if($val['dt_eval_identificacion']==1){ ?>
                          <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div> 
                
                    </div> 
                <!-- / -->
                <div class="col-md-12"><br>
                </div>


                <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>COMPROBANTE DE ESTUDIOS</label>
                           <?php if($beneficiario['url_com_estudios']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_com_estudios'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                            
                           <?php if($val['dt_eval_estudios']==1){ ?>
                           <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div> 
                
                    </div> 
                <!-- / -->

                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>

                <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>COMPROBANTE SEGURO MEDICO</label>
                            <?php if($beneficiario['url_seguro']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_seguro'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                           <?php if($val['dt_eval_seguro']==1){ ?>
                           <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div> 
                
                    </div> 
                <!-- / -->
                <div class="col-md-12"><br>
                </div>

                 <!-- COMPONENT START -->
                <div class="col-md-5">
                  <div class="col-md-12"> 
                           <label>COMPROBANTE BANCARIO</label>
                           <?php if($beneficiario['url_cuenta']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_cuenta'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>
                           <?php if($val['dt_eval_bancario']==1){ ?>
                           <button class="btn btn-warning btn-lg btn-block" type="button">Validado correctamente</button>
                           <?php } else { ?> 
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
                             
                            <?php } ?> 
                    </div> 
                
                    </div> 
                <!-- / -->

              </div>

              <div class="col-md-3 col-md-offset-9"><br><br>
                           <div class="form-group">
                              <input type="hidden" name="valida" value="2" />
                              <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Subir">
                              <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                           </div>
             </div> 

              </form>

              <br>
                <h4><br><br>Agradecemos tu colaboración y seguimos atentos a tu proceso de registro. Cualquier duda, puedes comunicarte al correo electrónico empresarial@fese.mx de Lunes a viernes, en un horario de 9 de la mañana a 6 de la tarde.<br><br><h4>
    </div> 
    

    <?php } ?> 


     <?php } ?> 

              </div>
         <?php } elseif ($relacion['dt_tipocontacto']==2) { ?> 
<!----->
                <div class="row">
<div class="col-md-12">
<h3><br><br><?php echo $relacion['dt_nombres']." ".$relacion['dt_apaterno']." ".$relacion['dt_amaterno']?></h3>
<div class="col-md-12"><br>
<p>En este momento se encuentra disponible para descarga el convenio mediante el cual se formalizará tu participación en el programa “Empresarial”, así como la entrega de tu apoyo económico.  Imprímelo y<strong> firma cada una de sus hojas</strong>, como se muestra en botón de ejemplo. Posteriormente, <strong> escanéalo y súbelo</strong> para concluir con el proceso.<p>
<p><strong>Recuerda que el convenio es indispensable para que tu apoyo económico se realice.</strong></p> 
<br></div>
<div class="col-md-12">
  <p>Te recomendamos revisar tus datos personales, si existe alguna aclaración, escríbenos al correo conveniospae@fese.org.mx</p>  
</div>

<div class="col-md-4"><br>
<div class="col-md-12"><br>
  <a target="_blank" class="colora" href="../docs/ejemploconvenio.pdf">
  <button type="button" class="btn btn-primary btn-lg btn-block">Ejemplo de firma de convenio</button>
</a>
</div>
<div class="col-md-12"><br>
<a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$relacion['url_convenio1'])?> ">
  <button type="button" class="btn btn-primary btn-lg btn-block">Descargar tú Convenio</button>
</a>
</div>
</div>

<div class="col-md-6 col-md-offset-1"><br><br><br>
    <form action="../controller/convenio_firmado.php" enctype="multipart/form-data" method="post">
      <div class="form-group">
                <?php if($beneficiario['url_convenio2']!=NULL){ ?>
                  <div class="alert alert-success content">
                      <a href="#" class="alert-link">El convenio se guardo correctamente</a>
                  </div>
                 <?php } ?>
                  <label  class="control-label">Subir convenio firmado:</label>
                  <div class="input-group input-file" name="convenio2">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
      </div>
      <div class="col-md-3 col-md-offset-9"><br><br>
                           <div class="form-group">
                              <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Subir">
                              <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                           </div>
             </div>      
  </form>
</div>

</div>
</div>
<!---/---->

          <?php } else { ?> 
<div class="row">
<div class="col-md-12">
<h3><br><br><?php echo $relacion['dt_nombres']." ".$relacion['dt_apaterno']." ".$relacion['dt_amaterno']?></h3>
<div class="col-md-12">
<p>En este momento se encuentra disponible para descarga el convenio mediante el cual se formalizará tu participación en el programa “Empresarial”, así como la entrega de tu apoyo económico.  Imprímelo y<strong> firma cada una de sus hojas</strong>, como se muestra en botón de ejemplo. Posteriormente, <strong> escanéalo y súbelo</strong> para concluir con el proceso.<p>
<p><strong>Recuerda que el convenio es indispensable para que tu apoyo económico se realice.</strong></p>
<p>Te recomendamos revisar tus datos personales, si existe alguna aclaración, escríbenos al correo conveniospae@fese.org.mx</p>  

<div class="col-md-3"><br>
<div class="col-md-12"><br>
<a target="_blank" class="colora" href="../docs/ejemploconvenio.pdf">
  <button type="button" class="btn btn-primary btn-lg btn-block">Ejemplo firma de convenio</button>
</a>
</div>
<div class="col-md-12"><br>
  <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$relacion['url_convenio1'])?> ">
  <button type="button" class="btn btn-primary btn-lg btn-block">Descargar tú Convenio</button>
</a>
</div>
</div>

<div class="col-md-6 col-md-offset-1"><br><br>
    <form action="../controller/convenio_firmado.php" enctype="multipart/form-data" method="post">
      <div class="form-group">
                 <?php if($beneficiario['url_convenio2']!=NULL){ ?>
                  <div class="alert alert-success content">
                      <a href="#" class="alert-link">El convenio se guardo correctamente</a>
                  </div>
                 <?php } ?>
                  <label  class="control-label">Sube tu convenio firmado:</label>
                  <div class="input-group input-file" name="convenio2">
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
      </div>
      <div class="col-md-3 col-md-offset-9"><br><br>
                           <div class="form-group">
                              <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Subir">
                              <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                           </div>
             </div>      
  </form>
</div>
</div>
</div>
          <?php } ?>
          
           <?php } ?> 


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