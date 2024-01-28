<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   // Verificar si la sesión está iniciada
    if (!isset($_SESSION['id'])) {
      // La sesión no está iniciada, redireccionar a la página de inicio de sesión
      header('Location: ../index.php');
      exit(); // Asegurarse de que el script se detenga después de la redirección
    }
   $id=$_SESSION["id"];
  //  $empresa = run_empresas_baja();
  $fecha_actual = isset($_POST['year']) ? $_POST['year'] : date('Y') ;
  $empresa = run_empresas_baja($fecha_actual);
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
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
      <style>
  table{
  table-layout: auto;
  overflow: auto;
  border: 1px solid;
  margin-left: 2%;
  max-width:500px !important;
  }
  table thead,
  table th,
  table td {
    width: 99%;
    max-width: 200px !important;
    overflow: auto;
    border: 1px solid;
  }
</style>
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
          <li class=""><a href="empresarial.php">Inicio</a></li>
          <li><a href="catalogos.php">Catálogos</a></li>
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
                            <li class="active"><a class="colora" href="#" >Empresas</a></li>
                            <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li class=""><a class="colora" href="noaplica.php" >No aplica</a></li>
                            <li class=""><a class="colora" href="new_vacante_admin.php" >Vacantes</a></li>
                        </ul>
                </div>
               </div>
          </div>

        <div class="row">
          <div class="col-md-12 m-auto">
            <div class="panel-heading">
              <ul class="nav nav-tabs">                  
                <li class="active"><a class="colora" href="#" >Empresas</a></li>
                <li ><a class="colora" href="new_empresa_admin.php" >Registrar empresa</a></li>
              </ul>
              <ul class="nav nav-tabs"><br>
              <li><a class="colora" href="empresarial.php" >Nuevas / Pendientes</a></li>
                <li class=""><a class="colora" href="empresarial_validadas.php" >Validadas</a></li>
                <li class="active"><a class="colora" href="empresarial_bajas.php" >Bajas</a></li>
              </ul>
            </div>
          </div>
                <form action="empresarial_bajas.php" method="POST">
          
                  <div class=" col-md-3 " style="margin-left:40px;">
                    <label for="" class="form-label">Selecciona el periodo</label>
                    <select
                      class="row form-control col-md-3"
                      name="year"
                      id="year"
                    >
                    <option selected disabled><?php echo $fecha_actual;?></option>
                      <?php
                                
                    $anio = date('Y') - 2019 ;
                    // $yearf = date('Y') - $anio; 
                  for ($i=0; $i <= $anio ; $i++) {
                    $yearf = date('Y') - $i;
                    echo "<option >".$yearf."</option>";
                  }
                  ?>
                    </select>
                    <button class="btn btn-md " type="submit">Seleccionar</button>
                  </div>
                  
                  
                </form>
                
          
          <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                        <th>ENTIDAD</th>
                        <th>RAZÓN SOCIAL</th>
                        <th>Nombre COMERCIAL</th>
                        <th>RFC</th>                  
                        <th>CONTACTO</th>
                        <th>ACCESO</th>
                        <th>ESTATUS</th>
                        <th>VACANTES</th>
                        <th>EDITAR</th>
                
                  </tr>
              </thead>
                    <tbody>
                      <?php
                      while($emp = $empresa->fetch_assoc())
                      {
                      ?>
                      <tr>
                        <td><?php echo $emp['nombre_entidad']; ?></td>
                        <td><?php echo $emp['dt_razon_social']; ?></td>
                        <td><?php echo $emp['dt_nombre_comercial']; ?></td>
                        <td><?php echo $emp['dt_rfc']; ?></td>  
                        <td><?php echo "Contacto:<br>Nombre: ".$emp['dt_nombre_contacto']."<br>correo:".$emp['dt_correo_contacto']."<br>Teléfono: ".$emp['dt_telefono_contacto']; ?></td>                  
                        <td><?php echo "<br>correo: ".$emp['dt_correo']."<br>contraseña: ".$emp['dt_password'];?></td>   
                <td>
                <?php if( $emp['estatus']==-1){ 
                  echo "Baja";
                } ?>
                </td>
                <td class="text-center">
                        <?php if($emp['dt_nombre']!=NULL){ ?>
                          <a href="num_vacantes.php?vac=<?php echo $emp['id_usuario']; ?>" class="colora"><br><button type="button" class="btn btn-success" ><i class='glyphicon glyphicon-search'></i> consultar</button> </a>
                        <?php } ?>
                        </td>
                        <td class="text-center m-2">
                          <a style="margin:3px;" href="edit_empresa_admin.php?vac=<?php echo $emp['id_usuario']; ?>" class="colora"><br><button type="button" class="btn btn-warning" ><i class='glyphicon glyphicon-pencil'></i> editar</button></a>
                          <?php
                          if ($emp['estatus'] == -1 ) {
                          ?>
                          <br>
                          <a style="margin:3px;" href="../controller/valida_empresa_admin.php?vac=<?php echo $emp['id_usuario']; ?>" class="colora"><br><button type="button" class="btn btn-primary" ><i class='glyphicon glyphicon-pencil'></i>validar</button></a>
                          <br>
                          <div class="container-fluid">
                            <br>
                            <!-- Boton -->
                            <button data-toggle="modal" href="#mi_modal" class="btn btn-danger">Eliminar</button>
                            <br><br>
                            <!-- Link -->
                            <a data-toggle="modal" href="#mi_modal">eliminar</a>

                            <!-- si se necesita cambiar tamaño de modal agregar modal-lg a la linea 
                            <div class="modal-dialog"> por <div class="modal-dialog modal-lg">-->

                            <!-- Modal-->
                            <div class="modal fade" id="mi_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                      <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Estas Seguro de eliminar la empresa <?php echo $emp['dt_razon_social']; ?>?</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row" style="padding:15px">
                                      Si eliminas la empresa se eliminaran los registros del usuario(incluyendo las vacantes).
                                      <br>
                                      <a class="btn btn-default" href="../controller/elimina_empresa.php?vac=<?php echo $emp['id_empresa']; ?>">Eliminar</a>
                                      <button type="button" class="btn btn-danger " data-dismiss="modal">Cancelar</button>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </td>                                  
                      </tr> 
                      <?php
                        }
                      ?>               
                    </tbody>         
        </table>
   
  </section>


    <!-- Mensaje de confirmacion de eliminacion -->
    <div id="miModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title"></h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bg-success text-center">
            ¡Se ha eliminado correctamente!
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

  <?php


if (isset($_GET['eliminado']) && $_GET['eliminado'] === 'si') {
    echo "<script>
            $(document).ready(function(){
                $('#miModal').modal('show');
            });
          </script>";
}
?>


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