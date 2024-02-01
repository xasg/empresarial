<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset($mysqli, 'utf8');
   // Verificar si la sesión está iniciada
    if (!isset($_SESSION['id'])) {
      // La sesión no está iniciada, redireccionar a la página de inicio de sesión
      header('Location: ../index.php');
      exit(); // Asegurarse de que el script se detenga después de la redirección
    }
    
    $id=$_GET['ben'];
   echo "el id es ".$id; 
   ?>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
<div class="row">
    <div class="col-md-12">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <!--<li><a class="colora" href="beneficiario_bajas.php" >Actualizacion de FECHA</a></li>                      -->
            </ul>
        </div>
        <div class="container">
            <h2 class="mt-5">Fecha de extención</h2>
            <form action="extencion_fecha.php" method="POST">
                <div class="form-group">
                    <label for="dia">Día:</label>
                    <input type="number" class="form-control" name="dia" id="dia" min="1" max="31" required>
                </div>
                <div class="form-group">
                    <label for="mes">Mes:</label>
                    <input type="number" class="form-control" name="mes" id="mes" min="1" max="12" required>
                </div>
                <div class="form-group">
                    <label for="año">Año:</label>
                    <input type="number" class="form-control" name="año" id="año" min="1900" max="2099" required>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>




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


