<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $id=$_SESSION["id"];
   $beneficiarios = run_benefiaciario2019();
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
                            <li class="dropdown active">
							<a class="dropdown-toggle" data-toggle="dropdown" href="beneficiario.php">Beneficiarios
							<span class="caret"></span></a>
							<ul class="dropdown-menu">
							  <li><a href="empresarial2023.php">2023</a></li>
							  <li><a href="beneficiario.php">2022</a></li>
							  <li><a href="empresarial2021.php">2021</a></li>
							  <li><a href="empresarial2020.php">2020</a></li>
							  <li><a href="empresarial2019.php">2019</a></li>
							</ul>
						    </li>
                            <li class=""><a class="colora" href="noaplica.php" >No aplica</a></li>
                        </ul>
                </div>
               </div>
          </div>

	<div class="row"><br><br><br>
      <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>  
                  <th>#</th>
                  <th>NOMBRE</th>
                  <th>EMPRESA</th> 
                  <th>VACANTE</th>
                  <th>INICIO ACTIVIDADES</th>
                  <th>FIN ACTIVIDADES</th>
                  <th>PAGO</th>
                  <th>PERFIL</th>
                  <th>CONVENIO</th>
                  <th>PAQUETERIA</th>
            </tr>
          </thead>
              <tbody>
                <?php
                 $counter = 1;
                while($ben = $beneficiarios->fetch_assoc())
                {
                ?>
                <tr>
                  <td class="text-center"><?php echo $counter++ ?></td>
                  <td><?php echo $ben['dt_nombres']. " ".$ben['dt_apaterno']. " ".$ben['dt_amaterno']. "<br>" ?>
                    <?php echo $ben['dt_correo']."<br>"."Contraseña:".$ben['dt_password'] ?>
                    <a href="editar_ben_admin.php?ben=<?php echo $ben['id_usuario']; ?>">                    
                    <span class="glyphicon glyphicon-edit" style="color: #ff5733"></span></a>
                  </td>
                  <td><?php echo $ben['dt_razon_social']; ?></td>
                  <td><?php echo strtoupper($ben['dt_nombre']); ?></td>
                  <td><?php echo strtoupper($ben['dt_inicio']); ?></td>
                  <td><?php echo strtoupper($ben['dt_termino']); ?></td>
                  <td><?php echo "$ ".$ben['dt_apoyo']; ?></td>
                  <td class="text-center"><br><a href="beneficiario_juridico.php?ben=<?php echo $ben['id_usuario']; ?>">
                    <button type="button" class="btn btn-warning" ><i class='glyphicon glyphicon-search'></i>&nbsp;&nbsp;Ver</button>
                    </a>
                  </td>
                  <td>
                    <?php if($ben['url_convenio1']!=NULL) { ?>
                      <a target="_blank" class="colora" href="<?php echo str_replace("../","http://empresarial.fese.mx/",$ben['url_convenio1'])?> "><br><button type="button" class="btn btn-success" ><i class='glyphicon glyphicon-search'></i> consultar</button></a>
                    <?php } else { ?>
                      <br><button type="button" class="btn btn-info" data-toggle="modal" data-target="#convenio" data-nombre="<?php echo $ben['dt_nombres']. " ".$ben['dt_apaterno']. " ".$ben['dt_amaterno']; ?>" data-id="<?php echo $ben['id_usuario']?>"><i class='glyphicon glyphicon-upload'></i>&nbsp;&nbsp;&nbsp;&nbsp;subir&nbsp;&nbsp;&nbsp;&nbsp;</button> 
                   <?php } ?>
                 </td>
                 <td><?php echo $ben['dt_paqueteria']."<br>".$ben['dt_guia']?></td>
                </tr> 
                <?php
                  }
                ?>               
              </tbody>         
        </table>
      </div>
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