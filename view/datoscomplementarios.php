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
     
     <?php
        actualizarBeneficiarios40(); // se manda a llmar esta funcion para actualizar el avance al 40 %     
     ?>

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
                            <a href="datospersonales.php"><h5>Datos</h5> <span>Personales</span></a>
                          </li>
                          <li class="finalizado">
                            <a href="datosacademicos.php"><h5>Datos</h5> <span>Academicos</span></a>
                          </li>
                          <li class="completed">
                            <a href="#"><h5>Datos</h5> <span>Complementarios</span></a>
                          </li>            
                          <li>
                            <a href="#"><h5>Archivos</h5> <span>Digitales</span></a>
                          </li>
                           <li>
                            <a href="#"><h5>Seleccionar</h5> <span>Vacante</span></a>
                          </li>             
                        </ul>
                    </div>
              </div>

               <form action="../controller/update_datoscomplementarios.php" method="POST">
              <div class="row"><br><h2>Datos Personales</h2><br>             
                <div class="col-md-4">
                      <div class="form-group">  
                              <label class="control-label">Idioma</label>
                                 <?php if($beneficiario['dt_idioma']!=NULL){?>
                              <select class="form-control" name="idioma" required>
                              <?php 
                                 echo '<option value="'.$beneficiario['dt_idioma'].'" selected="">'.$beneficiario['dt_idioma'].'</option>'
                                 ?>
                                <option value="">Seleccionar</option>
                                <option value="Inglés">Inglés</option>
                                <option value="Chino mandarín">Chino mandarín</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Español">Español</option>
                                <option value="Árabe">Árabe</option>
                                <option value="Ruso">Ruso</option>
                                <option value="Portugués">Portugués</option>
                                <option value="Alemán">Alemán</option>
                                <option value="Japonés">Japonés</option>
                                <option value="Italiano">Italiano</option>
                                <option value="Otro">Otro</option>
                              </select>
                              <?php } else { ?>                              
                            <select class="form-control" name="idioma" required>
                                <option value="">Seleccionar</option>
                                <option value="Inglés">Inglés</option>
                                <option value="Chino mandarín">Chino mandarín</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Español">Español</option>
                                <option value="Árabe">Árabe</option>
                                <option value="Ruso">Ruso</option>
                                <option value="Portugués">Portugués</option>
                                <option value="Alemán">Alemán</option>
                                <option value="Japonés">Japonés</option>
                                <option value="Italiano">Italiano</option>
                                <option value="Otro">Otro</option>
                            </select> 
                          <?php }?>
                      </div>
                </div>


                <div class="col-md-4">
                      <div class="form-group">  
                              <label class="control-label">Nivel</label>
                                 <?php if($beneficiario['dt_idioma_nivel']!=NULL){?>
                              <select class="form-control" name="nivel" required>
                              <?php 
                                 echo '<option value="'.$beneficiario['dt_idioma_nivel'].'" selected="">'.$beneficiario['dt_idioma_nivel'].'</option>'
                                 ?>
                                <option value="">Seleccionar</option>
                                <option value="Alto">Alto</option>
                                <option value="Medio">Medio</option>
                                <option value="Bajo">Bajo</option>
                              </select>
                              <?php } else { ?>                              
                            <select class="form-control" name="nivel" required>
                              <option value="">Seleccionar</option>
                                <option value="Alto">Alto</option>
                                <option value="Medio">Medio</option>
                                <option value="Bajo">Bajo</option>
                            </select> 
                          <?php }?>
                      </div>
                </div> 
                    <div class="col-md-3 col-md-offset-9">
                      <div class="form-group" style="display:flex; gap:10px"><br><br>
                        <a href="datospersonales.php" class="  btn-primary btn-lg">Anterior</a>    
                        <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                      </div>
                    </div>           
              </div>          
              </form>
              </div>
         </div>
      </section>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>   
</body>
</body>
</html>