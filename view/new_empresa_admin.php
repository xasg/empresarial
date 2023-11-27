<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
if(isset($_SESSION['id'])){  
   $id=$_SESSION["id"];
   $empresa = get_usuario($id);
   $usuario = view_empresa($id);
   $result = run_entidad();
   $giro = run_giro();
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
            <div class="row"><br><br><br>
               <div class="col-md-12">
               <!-- <div class="row"> -->
               <div class="col-md-12">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="colora" href="#" >Empresas</a></li>
                            <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li class=""><a class="colora" href="noaplica.php" >No aplica</a></li>
                            <li class=""><a class="colora" href="new_vacante_admin.php" >Vacantes</a></li>
                        </ul>
                <!-- </div> -->
               </div>
          </div>
            <br><br><br><br><br><br>
                  
                  <div class="col-md-12 m-auto">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class=""><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class="active" ><a class="" href="new_empresa_admin.php" >Registrar empresa</a></li>
                        </ul>
                  </div>
            </div>
               </div>
                    <div class="col-md-12">
                        <ul class="wizard-steps">
                          <li class="completed">
                            <a href="datos_empresa.php"><h5>Datos</h5> <span>Empresa</span></a>
                          </li>
                          <li>
                             <a href="digital_empresa.php"><h5>Archivos</h5> <span>Digitales</span></a>
                          </li>
                          <!-- <li>
                             <a href="vacantes.php"><h5>Lista de</h5> <span>Vacantes</span></a>
                          </li>       
                        </ul> -->
                    </div>
              </div>
               <form action="../controller/update_empresa.php" method="POST">
              <div class="row"><br><h2>Datos de la empresa</h2><br> 
                                   <div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Full Name --><br>
                              <label class="control-label">Nombre, denominación o razón social:</label>
                              <input type="text" class="form-control" name="razon" value="<?php echo $empresa['dt_razon_social']?>" pattern="[A-Za-z\. ]{1,50}" title="Proporcione un nombre correcto" onChange="conMayusculas(this)" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 --><br>
                              <label class="control-label">Nombre comercial:</label>
                              <input type="text" class="form-control" name="nombre" value="<?php echo $empresa['dt_nombre_comercial']?>" pattern="[A-Za-z\. ]{1,50}" title="Proporcione un nombre correcto" onChange="conMayusculas(this)" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">RFC:</label>
                              <input type="text" class="form-control" name="rfc" value="<?php echo $empresa['dt_rfc']?>" onChange="conMayusculas(this)" pattern="[A-Za-z0-9 ]{12,13}" title="Proporcione un RFC correcto" required>
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
                              
                            <select class="form-control" name="giro" required>
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
                              
                            <select class="form-control" name="tamano" required>
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
                              <!-- City-->
                              <label class="control-label">Actividad fiscal:</label>
                              <input type="text" class="form-control" name="actividad" value="<?php echo $empresa['dt_actividad']?>" onChange="conMayusculas(this)" pattern="[A-Za-z ]{1,50}" title="Proporcione un nombre correcto" required>
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
                              
                            <select class="form-control" name="org" required>
                                <option value="CANACINTRA"selected="" >CANACINTRA</option>
                                <option value="CMIC">CMIC</option>
                                <option value="CONCAMIN">CONCAMIN</option>
                                <option value="COPARMEX">COPARMEX</option>
                                <option value="NINGUNO">NINGUNO</option>
                            </select> 
                          <?php }?>
                           </div>
                        </div>                      

                                         
                        <!-- <div class="col-md-12"><h3><br><strong>DIRECCIÓN</strong></h3></div>-->
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Dirección (Calle y Número):</label>
                              <input type="text" class="form-control" name="direccion" value="<?php echo $empresa['dt_direccion']?>" onChange="conMayusculas(this)" pattern="[A-Za-z\# ]{1,50}" title="Proporcione una dirección correcto" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Localidad, colonia o barrio:</label>
                              <input type="text" class="form-control" name="colonia" value="<?php echo $empresa['dt_localidad']?>" onChange="conMayusculas(this)" pattern="[A-Za-z ]{1,50}" title="Proporcione un nombre correcto" required>
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
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" id="entidad" required>
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
                              <input type="text" class="form-control" name="cp"  value="<?php echo $empresa['dt_cp']?>" pattern="[0-9]{5}" title="Proporcione un Código Postal correcto" required>
                           </div>
                        </div>                       
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label for="zip_id" class="control-label">Email:</label>
                              <input type="text" class="form-control" name="email" onChange="conMayusculas(this)"  value="<?php echo $usuario['dt_correo'];?>" required>
                           </div>
                        </div>

                      <div class="col-md-12">
                        <h2><br>Contacto Operativo <br><br></h2>
                      </div>

                       <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Nombre completo</label>
                              <input type="text" class="form-control" name="nombre_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_nombre_contacto']?>" pattern="[A-Za-z ]{1,50}" title="Proporcione un nombre correcto" required>
                           </div>
                        </div>

                         <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Puesto</label>
                              <input type="text" class="form-control" name="puesto_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_puesto_contacto']?>" pattern="[A-Za-z ]{1,50}" title="Proporcione un >Puesto correcto" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Correo</label>
                              <input type="email" class="form-control" name="correo_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_correo_contacto']?>" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Teléfono</label>
                              <input type="text" class="form-control" name="telefono_contacto" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_telefono_contacto']?>" pattern="[0-9]{10}" title="Proporcione un Teléfono correcto" required>
                           </div>
                        </div>

                      <div class="col-md-12">
                        <h2><br>Representante Legal<br><br></h2>
                      </div>


                      <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Nombre completo</label>
                              <input type="text" class="form-control" name="nombre_representante" onChange="conMayusculas(this)" value="<?php echo $empresa['dt_representante']?>" pattern="[A-Za-z ]{1,50}" title="Proporcione un nombre correcto" required>
                           </div>
                        </div>




                       <div class="col-md-6 col-md-offset-3"><br><br>
                           <div class="form-group">
                              <!-- Submit Button -->
                              <input type="hidden" name="id" value="<?php echo $id; ?>" />
                              <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                           </div>
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