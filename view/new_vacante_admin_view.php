<?php   
  // Desactivar toda notificación de error
  error_reporting(0);
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   if(isset($_SESSION['id'])){  
   $id=$_SESSION["id"];   
//    $empresa = get_usuario($id);
   $vacante = run_vacantes();
   $empresas = run_empresas();
   $conteos = count_empresas();
   foreach($conteos as $num){
       $conteo = $num['numeralia'];
   }
  //  $_REQUEST['eliminado'] = false;
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
      <meta name="author" content="">
      <title>Empresarial</title>
      <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
      <link href="../css/style.css" rel="stylesheet" type="text/css">
      <link href="../css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../plugins/calendar/css/bootstrap-iso.css" />
      <link rel="stylesheet" href="../plugins/calendar/css/bootstrap-datepicker3.css"/>
      <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
      
     

      <!--<script type="text/javascript" src="../js/jquery.min.js"></script>-->
      <!-- Initialize the plugin: -->
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>
<?php

  if ($_REQUEST['eliminado']  ) {
    ?>
    <script>alert('Vacante Eliminada')</script>
    <?php
    
  }
  if ($_REQUEST['vacante'] ) {
    ?>
    <script>alert('Vacante Registrada')</script>
    <?php
    
  }
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
          <li class="active"><a href="#">Inicio</a></li>
          <li><a href="vacantes.php">Vacantes</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Perfil <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Privacidad</a></li>
              <li><a href="#">Terminos</a></li>
               <li><a href="../controller/logout.php">Salir</a></li>              
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
                            <li><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li><a class="colora" href="noaplica.php" >No aplica</a></li>
                            <li class="active"><a class="colora" href="#" >Vacantes</a></li>
                        </ul>
               </div>
               <div class="col-md-12 m-auto">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li ><a class="colora" href="new_vacante_admin.php" >Crear Vacante</a></li>
                            <li class="active"><a class="colora" href="#" >Ver vacantes</a></li>
                        </ul>
                </div>
               </div>
           </div>
           
           <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa - razon social</th>
                <th>Empresa - comercial</th>
                <th>Nombre vacante</th>
                <th>Carrera</th>
                <th>Numero de vacantes</th>
                <th>Fecha de inicio</th>
                <th>Fecha de término</th>
                <th>Apoyo ecónomico</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $vacante = run_vacantes();
                $i = 0;
                foreach ($vacante as $key => $vac) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $vac['dt_razon_social']; ?></td>
                        <td><?php echo $vac['dt_nombre_comercial']; ?></td>
                        <td><?php echo $vac['dt_nombre']; ?></td>
                        <td><?php echo $vac['dt_carrera']; ?></td>
                        <td><?php echo $vac['dt_numero']; ?></td>
                        <td><?php echo $vac['dt_inicio']; ?></td>
                        <td><?php echo $vac['dt_termino']; ?></td>
                        <td><?php echo $vac['dt_apoyo']; ?></td>
                        <!-- <td><?php echo date('Y-m-d', strtotime($vac['fecha_registro_vacante'])); ?></td> -->
                        <td><?php echo $vac['fecha_registro_vacante']; ?></td>
                        <td>
                            <?php //if ($vac['dt_razon_social'] == null) { ?>
                                <form action="../controller/eliminar_vacante.php" method="POST">
                                    <input type="text" id="id_vacante" name="id_vacante" value="<?php echo $vac['id_vacante']; ?>" hidden>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            <!-- <?php// } ?> -->
                            <a href="consult_vacante.php?vac=<?php echo $vac['id_vacante']; ?>" class="colora">
                                <button type="button" class="btn btn-warning" style="margin-top:10px;">
                                    <i class='glyphicon glyphicon-pencil'></i> editar
                                </button>
                            </a>
                            <a href="consult_vacante_invite.php?vac=<?php echo $vac['id_vacante']; ?>" class="colora">
                                <button type="button" class="btn btn-primary" style="margin-top:10px;">
                                <i class="glyphicon glyphicon-user"></i> Invitar
                                </button>
                            </a>
                        </td>
                    </tr>
            <?php
                }
            } catch (Exception $e) {
                echo "Error al ejecutar la consulta: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
                  
            </div>
            

         </div>
      </section>


<!--
<script type="text/javascript" src="../plugins/calendar/js/jquery-1.11.3.min.js"></script>
-->
<script type="text/javascript" src="../plugins/calendar/js/bootstrap-datepicker.min.js"></script>


<script>

</script>


<script>

</script>

<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    } );
} );


$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>