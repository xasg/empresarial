<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   if(isset($_SESSION['id'])){  
   $id=$_SESSION["id"];
   $empresa = get_usuario($id);
   $result = run_entidad();
   $giro = run_giro();
   $doc=get_docs($id);
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: ../"); 
  }  
  
   ?>
   <!DOCTYPE html>
   <html lang="es">
   <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="FESE" content="">
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
              <li class=""><a href="#">Inicio</a></li>
              <li><a href="#">Vacantes</a></li>
               <li><a href="../controller/logout.php">Salir</a></li>
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
            <a href="datos_empresa.php"><h5>Datos</h5> <span>Empresa</span></a>
          </li>
          <li class="completed">
           <a href="digital_empresa.php"><h5>Archivos</h5> <span>Digitales</span></a>
         </li>
         <li>
           <a href="vacantes.php"><h5>Lista de</h5> <span>Vacantes</span></a>
         </li>       
       </ul>
     </div>
   </div>
   <div class="row">
    <form action="../controller/upload.php" enctype="multipart/form-data" method="post">
      <div class="col-sm-12 col-md-12"><br><br></div>  
      <!-- /seccion 1 -->
      <div class="col-xs-12 col-sm-5 col-md-5">
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
     </div>
     <!-- /seccion 1 -->
     <div class="col-sm-1 col-md-1">
     </div>




     <div class="col-xs-12 col-sm-5 col-md-5">
      <div class="col-md-12"> 
       <label>Comprobante que acredite tener facultades para subscribir convenios</label>
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
   </div>

                      <div class="col-md-12"> 
                        <div class="col-md-3 col-md-offset-8"><br>
                         <div class="form-group">
                          <input name="uploadFiles" type="submit" class="btn btn-block btn-primary btn-lg" value="Subir">
                          <input name="MM_upload_file" type="hidden" id="MM_upload" value="formDocumentos">
                        </div>
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