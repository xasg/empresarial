<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   // Verificar si la sesión está iniciada
      if (!isset($_SESSION['id'])) {
         // La sesión no está iniciada, redireccionar a la página de inicio de sesión
         header('Location: ../index.php');
         exit(); // Asegurarse de que el script se detenga después de la redirección
      }
   $id=$_GET['vac'];
   $vac = run_vacanteinfo($id);
   $nom = run_vacante_info($id);
   $nom_comercial = "nom";
   foreach ($nom as $key => $value) {
      $nom_comercial = $value['dt_nombre_comercial'];
   }
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
          <li class="active"><a href="#">Inicio</a></li>
          <li><a href="vacantes.php">Vacantes</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Perfil <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Privacidad</a></li>
              <li><a href="#">Terminos</a></li>
              <li><a href="../index.php">Cerrar Sesión</a></li>              
            </ul>
          </li>
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
                            <li class="active"><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li class=""><a class="colora" href="new_vacante_admin_view.php" >vacantes</a></li>
                        </ul>
                </div>
               </div>
          </div>

                <div class="row">
                   <form action="../controller/update_vacante_admin.php" method="POST">
                      <div class="col-md-12">
                        <h2>Datos de la Vacante<br><br></h2>
                      </div>                  

                      <div class="col-md-12">
                        <h3>Empresa:</h3>
                        <h4 style="border-bottom:2px solid #ccc; font-size:22px;" ><?php echo $nom_comercial; ?></h4> 
                     </div>

                        <div class="col-md-12">
                           <div class="form-group">
                              <!-- Full Name -->
                          <label class="control-label">Nombre de la Vacante:</label>
                          <input type="text" name="nombre" class="form-control" value="<?php echo $vac['dt_nombre']?>" >
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Número de vacantes</label>
                              <input type="text" name="numero" class="form-control" value="<?php echo $vac['dt_numero']?>">
                           </div>
                        </div>

                        <div class="col-md-8">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Carrera</label>
                              <input type="text" name="carrera" class="form-control" value="<?php echo $vac['dt_carrera']?>">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- City-->
                              <label class="control-label">Fecha de inicio</label>
                              <input type="text" name="inicio" class="form-control" value="<?php echo $vac['dt_inicio']?>">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Fecha de término </label>
                               <input type="text" name="termino" class="form-control" value="<?php echo $vac['dt_termino']?>">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- City-->
                              <label class="control-label">Hora de inicio de actividades</label>
                              <input type="text" name="hr_inicio" class="form-control" value="<?php echo $vac['dt_hr_inicio']?>">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Hora de fin de actividades</label>
                                <input type="text" name="hr_termino" class="form-control" value="<?php echo $vac['dt_hr_termino']?>">
                           </div>
                        </div>



                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Actividades a realizar</label>
                              <textarea type="text" name="actividad" class="form-control" rows="4"><?php echo $vac['dt_actividades'];?></textarea>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Área de la Empresa</label>
                              <input type="text" name="area" class="form-control" value="<?php echo $vac['dt_area']?>">                              
                           </div>
                        </div>                        
                        

                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Apoyo ecónomico menusal </label>
                              <input type="text" name="apoyo" class="form-control" value="<?php echo $vac['dt_apoyo']?>">
                           </div>
                        </div>
                        
                         <div class="col-md-6">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Dispersión al beneficiario</label>
                               <input type="text" name="dispersion" class="form-control" value="<?php echo $vac['dt_dispersion']?>">
                           </div>
                        </div>  

                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Competencias</label><br>
                             <input type="text" class="form-control" name="competencia" value="<?php echo $vac['dt_competencias']?>">
                           </div>
                        </div>  

                                         
                        <!-- <div class="col-md-12"><h3><br><strong>DIRECCIÓN</strong></h3></div>-->
                        <div class="col-md-12">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Descripción adicional</label>                              
                              <textarea type="text" class="form-control" name="descripcion" rows="4"><?php echo $vac['dt_descripcion']?></textarea>
                           </div>
                        </div>

                      <div class="col-md-12">
                        <h2><br>Tutor Empresarial<br><br></h2>
                      </div>

                      <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Nombre Completo</label>
                              <input type="text" class="form-control" name="tutor" value="<?php echo $vac['dt_tutor']?>">
                           </div>
                        </div>

                       <div class="col-md-6">
                           <div class="form-group">
                              <!-- Zip Code-->
                              <label class="control-label">Puesto</label>
                              <input type="text" class="form-control" name="cargo" value="<?php echo $vac['dt_cargo']?>">
                           </div>
                        </div>
                         
                       <div class="col-md-6 col-md-offset-3">
                           <div class="form-group"><br><br>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />    
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                           </div>
                        </div>
                  </form>
               </div>
            

         </div>
      </section>
</body>
</html>