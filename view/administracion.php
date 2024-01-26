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
    $fecha_actual = isset($_POST['year']) ? $_POST['year'] : date('Y');
    $beneficiarios = run_benefiaciario($fecha_actual);
   ?>
<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Empresarial</title>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
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
          <li class=""><a href="#">Inicio</a></li>
          <li><a href="#">Catálogos</a></li>
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
                           <li class="dropdown active">
                        <a  href="empresarial_juridico.php">Beneficiarios</a>
                        <!-- <span class="caret"></span></a> -->
                        <!-- <ul class="dropdown-menu">                         
                          <li><a href="administracion2021.php">2021</a></li>
						               <li><a href="administracion2020.php">2020</a></li>
                        </ul> -->
                      </li>
                        </ul>
                </div>
               </div>
          </div>

  <div class="row">
  <div class="row">
    <form action="administracion.php" method="POST">
      <div class=" col-md-3 " style="margin-left:40px;">
        <label for="" class="form-label">Selecciona el periodo</label>
          <select class="row form-control col-md-3" name="year" id="year">
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
    </form><br>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                  <th>NOMBRE</th>
                  <th>EMPRESA</th> 
                  <th>INICIO</th>
                  <th>FIN</th>
                  <th>PAGO</th>
                  <th>BANCO</th>
                  <th>CLAVE TRANFER</th>
                  <th>CLABE</th>
                  <th>CONSULTAR</th>
                  <!--<th>PAGOS</th>-->
            </tr>
        </thead>
              <tbody>
                <?php
                while($ben = $beneficiarios->fetch_assoc())
                {
                ?>
                <tr>
                  <td><?php echo $ben['dt_nombres']. " ".$ben['dt_apaterno']. " ".$ben['dt_amaterno']; ?></td>
                  <td><?php echo $ben['dt_razon_social']; ?></td>
                  <td><?php echo strtoupper($ben['dt_inicio']); ?></td>
                  <td><?php echo strtoupper($ben['dt_termino']); ?></td>
                  <td><?php echo "$ ".$ben['dt_apoyo']; ?></td>
                  <td><?php echo $ben['banco']; ?></td>
                  <td><?php echo $ben['trans']; ?></td>                  
                  <td><?php echo $ben['dt_clabe']; ?></td>
                  <td class="text-center"> <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$ben['url_cuenta'])?> ">                 
                    <span class="glyphicon glyphicon-search" style="color: #ff5733"></span></a></td>
                   <!-- <td>
                      <a style="color: #000">pdf1 xml1</a><br>
                      <a style="color: #000">pdf2 xml2</a><br>
                      <a style="color: #000">pdf3 xml3</a><br>
                      <a style="color: #000">pdf4 xml4</a><br>
                      <a style="color: #000">pdf5 xml5</a><br>
                      <a style="color: #000">pdf6 xml6</a>
                    </td>-->
                </tr> 
                <?php
                  }
                ?>               
              </tbody> 
        
      </table>
  </div>
                    
            

         </div>
      </section>

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