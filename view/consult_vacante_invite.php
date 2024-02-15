<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   mysqli_set_charset($mysqli, 'utf8');
   if (!isset($_SESSION['tp_user']) == 3) {
       // La sesión no está iniciada, redireccionar a la página de inicio de sesión
       // Si no está logueado lo redireccion a la página de login.
       header("HTTP/1.1 302 Moved Temporarily"); 
       header("Location: ../"); 
       die();
   }
   
   // Verificar si la sesión está iniciada
   if (!isset($_SESSION['id'])) {
       // La sesión no está iniciada, redireccionar a la página de inicio de sesión
       
           // Si no está logueado lo redireccion a la página de login.
       header("HTTP/1.1 302 Moved Temporarily"); 
       header("Location: ../"); 
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- <link rel="icon" type="image/png" href="imgs/logo-mywebsite-urian-viera.svg"> -->

    <!-- <link rel="stylesheet" type="text/css" href="css/material.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/cssGenerales.css">
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
                            <!-- <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li> -->
                            <li class=""><a class="colora" href="new_vacante_admin_view.php" >vacantes</a></li>
                        </ul>
                </div>
               </div>
          </div>

                <div class="row">
                   <!-- <form action="" method="POST"> -->
                      <div class="col-md-12">
                        <h2>Datos de la Vacante<br><br></h2>
                      </div>                  

                      <div class="col-md-12">
                        <h3>Empresa:</h3>
                        <h4 style="border-bottom:2px solid #ccc; font-size:22px;" ><?php echo $nom_comercial; ?></h4> 
                        <hr>
                     </div>
                     <div class="col-md-12" style=" margin-bottom:50px;">
                      <h2>Cargar candidatos desde un archivo</h2>
                        <form action="../controller/recibe_excel_validando.php" method="POST" enctype="multipart/form-data">
                          <div class="row">
                             <!-- Input File para subir lista de excel -->
                             <div class="col-lg-6 file-input text-center">
                              <input type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".csv" />
                              <!-- <input  type="file" name="dataCliente" id="file-input" class="file-input__input"/> -->
                              <label class="file-input__label" for="file-input">
                              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
                              <span>Elegir Archivo CSV(separado por comas)</span></label>
                            </div>
                            <!-- BTN subir EXCEL -->
                            <div class="col-lg-6 text-center mt-2">
                                <input type="number" id="idvac" name="idvac" value="<?php echo $id ?>" hidden>
                                <input type="submit" name="subir" class="btn-lg btn-primary" value="Subir Excel"/>
                            </div>
                          </div>
                        </form>
                      </div>
                     <br>

                     <h2 style="margin-top:100px;">Cargar candidatos manualmente</h2>
                     <form action="../controller/agregar_invitacion.php" method="POST">
                        <div class="row">
                            <input type="number" id="idvac" name="idvac" value="<?php echo $id; ?>" hidden>
                            <div class="col-sm-6">
                            <label for="" class="form-label">Nombre del caldidato</label>
                            <input type="text" class="form-control" name="nombreCandidato" id="nombreCandidato" aria-describedby="helpId" placeholder="" required>
                            </div>
                            <div class="col-sm-6">
                            <label for="" class="form-label">correo</label>
                            <input type="email" class="form-control" name="correoCandidato" id="correoCandidato" aria-describedby="helpId" placeholder="" required>
                            </div>
                            <br>
                            <div class="col-sm-3" >
                                <br>
                                <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar Candidato</button><br>
                            </div>
                        </div>
                     </form>

                        <div class="col-md-12">
                           <div class="form-group">
                              <!-- Full Name -->
                          <label class="control-label">Nombre de la Vacante:</label>
                          <input type="text" name="nombre" class="form-control" value="<?php echo $vac['dt_nombre']?>" disabled >
                           </div>
                        </div>

                        <!-- Aqui se visualizan los candidatos agregaods -->


                        <div class="container mt-5"> 

  
                    <h3 class="text-center mb-5" style="font-weight: 800; font-size: 35px">
                        Invitacion de vacantes
                        <hr>
                    </h3>



<?php
// include('config.php');
include('../model/database_emails.php');
  // $QueryInmuebleDetalle = ("SELECT * FROM clients WHERE correo !='' limit 50 ");
  $resultadoInmuebleDetalle = get_cantidad($id);
  $cantidad = mysqli_num_rows($resultadoInmuebleDetalle);
?>


<form action="email.php" method="post">
    
<input type="number" id="idvac" name="idvac" value="<?php echo $id; ?>" hidden>
  <div class="row mb-5">
    <div class="col-4">
      <input type="checkbox" onclick="marcarCheckbox(this);"/>
      <label id="marcas">Marcar todos</label>
    </div>
    <div class="col-4">
       <p id="resp"></p>
    </div>
     <div class="col-sm-4" style="margin:10px;">
      <input type="submit" style="display: none;" name="enviarform" id="enviarform" class="btn btn-round btn-primary btn-block" value="Enviar Emails">
    </div>
  </div>


  <div class="table-responsive mb-5">
  <table class="table  table-hover table-bordered">
         <thead class="thead-dark">
           <tr>
                <th> # </th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Estatus de Notificación</th>
                <th>Ultimo envio</th>
                <th>acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          while ($dataClientes = mysqli_fetch_array($resultadoInmuebleDetalle)) { 
            // while ($resultadoInmuebleDetalle as $key => $dataClientes) {
            ?>

            <tr>
                <td>
                  <?php echo $i; ?>
                    <input type="checkbox"  name="correo[]" class="CheckedAK" correo="<?php echo $dataClientes['correo']; ?>" value="<?php echo $dataClientes['correo']; ?>"/>
                  </td>
                <td><?php echo $dataClientes['nombre']; ?></td>
                <td><?php echo $dataClientes['correo']; ?></td>
                <td>
                  <?php
                  echo ($dataClientes['notificacion']) ? '<i class="zmdi zmdi-check-all zmdi-hc-2x green"></i>' : '<i class="zmdi zmdi-check zmdi-hc-2x black"></i>';
                  ?>
                </td>
                <td>
                  <?php
                   if ($dataClientes['notificacion'] == 1) {
                     echo $dataClientes['dt_fecha']; 
                  }else{
                    echo "0000-00-00 00:00:00";
                  }
                   ?>
                </td>
                <td>
                    <!-- <form action="../controller/eliminar_vacante_correo.php" method="POST">
                        <input type="number" id="idvac" name="idvac" value="<?php echo $id; ?>" hidden>
                        <input type="text" id="id_vacante_correo" name="id_vacante_correo" value="<?php echo $dataClientes['id']; ?>" hidden>
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form> -->
                    <a href="../controller/eliminar_vacante_correo.php?vac=<?php echo $dataClientes['id']; ?>" class="colora">
                                <button type="button" class="btn btn-warning" style="margin-top:10px;">
                                    <i class='glyphicon glyphicon-pencil'></i> Eliminar
                                </button>
                    </a>
                </td>
            </tr>
          <?php $i++; } ?>
        </tbody>
    </table>
  </div>
</div>
</form>

</div>

                        <!-- cierra la vista de candidatos -->
   
                       <div class="col-md-6 col-md-offset-3">
                           <div class="form-group"><br><br>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />    
                            <!-- <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br> -->
                           </div>
                        </div>
                  <!-- </form> -->
               </div>
            

         </div>
      </section>
      <script  src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="../js/script.js"></script>
</body>
</html>