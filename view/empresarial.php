<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $id=$_SESSION["id"];
   $empresa = run_empresas();
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
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li class=""><a class="colora" href="noaplica.php" >No aplica</a></li>
                        </ul>
                </div>
               </div>
          </div>

  <div class="row"><br><br><br>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                  <th>ENTIDAD</th>
                  <th>RAZÓN SOCIAL</th>
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
                  <td><?php echo $emp['dt_rfc']; ?></td>  
                  <td><?php echo "Contacto:<br>Nombre: ".$emp['dt_nombre_contacto']."<br>correo:".$emp['dt_correo_contacto']."<br>Teléfono: ".$emp['dt_telefono_contacto']; ?></td>                  
                  <td><?php echo "<br>correo: ".$emp['dt_correo']."<br>contraseña: ".$emp['dt_password'];?></td>   
				  <td>
				  <?php if( $emp['estatus']==1){ 
				     echo "Participando";
				   } ?>
				  </td>
				  <td class="text-center">
                  <?php if($emp['dt_nombre']!=NULL){ ?>
                    <a href="num_vacantes.php?vac=<?php echo $emp['id_usuario']; ?>" class="colora"><br><button type="button" class="btn btn-success" ><i class='glyphicon glyphicon-search'></i> consultar</button> </a>
                  <?php } ?>
                  </td>
                   <td class="text-center">
                    <a href="edit_empresa_admin.php?vac=<?php echo $emp['id_usuario']; ?>" class="colora"><br><button type="button" class="btn btn-danger" ><i class='glyphicon glyphicon-pencil'></i> editar</button></a>
                   </td>                                  
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