<?php
  include_once('../model/databases_beneficiario.php');
   mysqli_set_charset( $mysqli, 'utf8'); 
   session_start();
   $id=$_SESSION["id"];
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
     <link href="../css/bootstrap.css" rel="stylesheet">
     <link href="../css/style.css" rel="stylesheet">
      <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
            <div class="row">
               <div class="col-md-12">
                  <br><br>
               </div>
                    <div class="col-md-12">
                        <ul class="wizard-steps">
                          <li class="finalizado">
                            <a href="#"><h5>Datos</h5> <span>Personales</span></a>
                          </li>
                          <li class="finalizado">
                             <a href="#"><h5>Datos</h5> <span>Academicos</span></a>
                          </li>
                          <li class="finalizado">
                            <a href="#"><h5>Datos</h5> <span>Complementarios</span></a>
                          </li>            
                          <li class="completed">
                            <a href="#"><h5>Archivos</h5> <span>Digitales</span></a>
                          </li>     
                           <li>
                            <a href="#"><h5>Seleccionar</h5> <span>Vacante</span></a>
                          </li>        
                        </ul>
                    </div>
              </div>
            


          <form action="../controller/update_digitales.php" enctype="multipart/form-data" method="post">
              <div class="row"><br><h2>Archivos Digitales</h2><br> 
                <!-- COMPONENT START -->
                <div class="col-md-5">   
                <div class="col-md-12"> 
                           <label>CURRICULUM VITAE</label>
                          <?php if($beneficiario['url_cv']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_cv'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div>              
                <div class="form-group">
                  <div class="input-group input-file" name="cv">
                      <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
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

                </div> 
                <div class="form-group"> 
                  <div class="input-group input-file" name="curp">
                    <span class="input-group-btn">
                           <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div> 
                <!-- / -->
              </div> 



                <div class="row">            
                <!-- COMPONENT START -->
                <div class="col-md-5">
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
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div> 
                <!-- / -->
                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>

                <!-- COMPONENT START -->
                <div class="col-md-5">
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
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div> 
                <!-- / -->
              </div> 


              <div class="row">            
                <!-- COMPONENT START -->
                <div class="col-md-5">
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
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div> 
                <!-- / -->
                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>

                <!-- COMPONENT START -->
                <div class="col-md-5">
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
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div> 
                <!-- / -->
              </div> 

              <div class="row">            
                <!-- COMPONENT START -->
                <div class="col-md-5">

                                    <div class="col-md-12"> 
                           <label>COMPROBANTE DE ESTUDIOS(Que muestre Nombre, Institución y Carrera)</label>
                          <?php if($beneficiario['url_com_estudios']!=NULL){ ?>
                          <a href="<?php echo $beneficiario['url_com_estudios'];?>" target="_black"> 
                            <label style="color: #0098A9;">Consultar</label></a>
                          <?php } ?>

                </div> 
                <div class="form-group"> 
                  <div class="input-group input-file" name="com_estudios" >
                    <span class="input-group-btn">
                          <button class="btn btn-warning btn-choose" type="button">Seleccionar</button>
                      </span>
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div> 
                <!-- / -->
                <!-- COMPONENT START -->
                <div class="col-md-2">
                </div>

                <!-- COMPONENT START -->
                <div class="col-md-5">
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
                      <input type="text" class="form-control" placeholder='Aún no seleccionas un archivo' required />
                      <span class="input-group-btn">
                           <button class="btn btn-default btn-reset" type="button">Limpiar</button>
                      </span>
                  </div>
                </div>
                </div>
                </div>
                <div class="row"> 
				        <div class="col-md-5">
                </div>

                <div class="col-md-2">
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label>CLABE de 18 dígitos</label>
                    <input type="text" name="clabe" maxlength="18" class="form-control" value="<?php echo $beneficiario['dt_clabe'];?>" required>
                  </div>
                </div>
                <!-- / -->
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