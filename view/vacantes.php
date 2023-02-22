<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   if(isset($_SESSION['id'])){  
   $id=$_SESSION["id"];
   $empresa = get_usuario($id);
   $vacante = run_vacante($id);
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
          <li class=""><a href="#">Inicio</a></li>
          <li><a href="#">Vacantes</a></li>
            <li><a href="../controller/logout.php">Salir</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>



     <section>
         <div class="container">

          <div class="row">
               <div class="col-md-12"><br><br><br>
               </div>
                   <div class="col-md-12">
                        <ul class="wizard-steps">
                          <li class="finalizado">
                            <a href="datos_empresa.php"><h5>Datos</h5> <span>Empresa</span></a>
                          </li>
                          <li class="finalizado">
                             <a href="digital_empresa.php"><h5>Archivos</h5> <span>Digitales</span></a>
                          </li>   
                          <li class="completed">
                             <a href="digital_empresa.php"><h5>Vacantes</h5> <span>Registradas</span></a>
                          </li>    
                        </ul><br><br>
                    </div>
              </div>

                <div class="row">
            <div class="col-md-12">
              <a href="new_vacante.php"><img src="../img/nueva.png"></a>
            </div>

             <div class="col-md-12"><br>
             </div>





                  <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>  
                  <th>Nombre vacante</th>
                  <th>Carrera</th>
                  <th>Numero de vacantes</th>                  
                  <th>Fecha de inicio</th>
                  <th>Fecha de término</th>
                  <th>Apoyo ecónomico</th>
                  <th>Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
                <?php
                while($vac = $vacante->fetch_assoc())
                {
                ?>
                <tr>
                  <td><?php echo $vac['dt_nombre']; ?></td>
                  <td><?php echo $vac['dt_carrera']; ?></td>                                      
                  <td><?php echo $vac['dt_numero']; ?></td>
                  <td><?php echo $vac['dt_inicio']; ?></td>
                  <td><?php echo $vac['dt_termino']; ?></td>
                  <td><?php echo $vac['dt_apoyo']; ?></td>
                  <td><?php echo $vac['dt_fh_registro']; ?></td>                  
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
function bs_input_file() {
  $(".input-file").before(
    function() {
      if ( ! $(this).prev().hasClass('input-ghost') ) {
        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
        element.attr("name",$(this).attr("name"));
        element.change(function(){
          element.next(element).find('input').val((element.val()).split('\\').pop());
        });
        $(this).find("button.btn-choose").click(function(){
          element.click();
        });
        $(this).find("button.btn-reset").click(function(){
          element.val(null);
          $(this).parents(".input-file").find('input').val('');
        });
        $(this).find('input').css("cursor","pointer");
        $(this).find('input').mousedown(function() {
          $(this).parents('.input-file').prev().click();
          return false;
        });
        return element;
      }
    }
  );
}
$(function() {
  bs_input_file();
});
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