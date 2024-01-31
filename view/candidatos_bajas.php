<?php   
   include_once('../model/databases_admin.php');
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

   $candidato = run_candidato_baja();
   
   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_candidato'])) {
    // Llama a la función cuando se presiona el botón
    
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
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>   
   </head>
   <body>
   <?php include("modal_modificar.php");?>
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
                </div>
              </nav>
            </div>
     <section>
         <div class="container">
          <div class="row"><br><br><br>
               <div class="col-md-12">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class="active"><a class="colora" href="#" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li class=""><a class="colora" href="noaplica.php" >No aplica</a></li>
                            <li class=""><a class="colora" href="new_vacante_admin.php" >Vacantes</a></li>
                        </ul>
                </div>
               </div>
          </div>

          <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <div class="panel-heading">
                    <ul class="nav nav-tabs">
                      <li><a class="colora" href="candidatos_bajas.php" >Bajas</a></li>                      
                    </ul>
                  </div>
                </div>
            </div>
          </div>


  <div class="row"><br><br><br>
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>  
                  <th class="text-center">ID</th>
                  <th class="text-center">NOMBRE</th>
                  <th class="text-center">CURP</th>
                  <th class="text-center">IES</th>
                  <th class="text-center">EMPRESA</th>
                  <th class="text-center">FECHA DE REGISTRO</th>
                  <th class="text-center">FECHA FIN DE REGISTRO</th>
                  <th class="text-center">ACCESOS</th>
                  <th class="text-center">ESTATUS</th>    
                  <th class="text-center">AVANCE</th>
            </tr>
        </thead>
              <tbody>
                <?php
                $counter = 1;
                // while($cand = $candidato->fetch_assoc())
                foreach ($candidato as $key => $cand) {
                
                ?>
                <tr>
                  <td class="text-center"><?php echo $cand['id_usuario']; ?></td>
                  <td><a href="editar_cand_admin.php?ben=<?php echo $cand['id_usuario']; ?>">                    
                    <span class="glyphicon glyphicon-edit" style="color: #ff5733"></span></a><?php echo " ".$cand['dt_nombres']. "<br>".$cand['dt_apaterno']. " ".$cand['dt_amaterno']; ?></td>
                  <td><?php echo $cand['dt_curp']; ?></td>
                  <td><?php echo $cand['dt_nombre_ies']. "<br> <strong>".$cand['dt_nombre_carrera']."</strong>" ?></td>
                  <td><?php echo $cand['dt_razon_social']; ?></td>
                  <td class="text-center"><?php echo $cand['fecha']; ?></td>
                  <!-----> 
                  <td class="text-center"><?php echo $cand['dt_fin_registro']; ?></td>
                  
                  <td><?php echo "usuario:".$cand['dt_correo']."<br>"."contraseña:".$cand['dt_password'] ?></td>
                  <td class="text-center"><br><br>
                    <!---->
                    <a href="restaurar_candidato.php?ben=<?php echo $cand['id_usuario']; ?>" class="colora">
                    <button type="button" class="btn btn-success"><i class='glyphicon glyphicon-star-empty'></i> Restaurar</button>
                    <!----->                
                    <td><?php echo $cand['dt_avance_registro'].'%'; ?></td>
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
<script src="../js/app.js"></script>




</body>
</html>