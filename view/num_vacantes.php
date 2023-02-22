<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $id_empresa=$_GET['vac'];
   $vacantes = vacantes($id_empresa);
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
   </hea
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
                            <li class="active"><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                        </ul>
                </div>
               </div>
          </div>

  <div class="row"><br><br><br>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                  <th>NOMBRE</th>
                  <th>CARRERA</th>
                  <th>NÚMERO DE VACANTES</th>
                  <th>DETALLE</th> 
            </tr>
        </thead>
              <tbody>
                <?php
                while($vac = $vacantes->fetch_assoc())
                {
                ?>
                <tr>
                  <td><?php echo $vac['dt_nombre']; ?></td>
                  <td><?php echo $vac['dt_carrera']; ?></td>
                  <td class="text-center"><?php echo $vac['dt_numero']; ?></td> 
                  <td class="text-center"> <a href="consult_vacante.php?vac=<?php echo $vac['id_vacante']; ?>" class="colora"><button type="button" class="btn btn-danger" ><i class='glyphicon glyphicon-pencil'></i> editar</button></a></td>                                   
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