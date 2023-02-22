<?php   
   include_once('../model/databases_admin.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $fecha = run_actividades();   
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
    <link rel="stylesheet" href="../plugins/calendar/css/bootstrap-iso.css" />
    <link rel="stylesheet" href="../plugins/calendar/css/bootstrap-datepicker3.css"/>
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
                            <li><a class="colora" href="empresarial.php" >Empresas</a></li>
                            <li class="active"><a class="colora" href="#" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li class=""><a class="colora" href="noaplica.php" >No aplica</a></li>
                        </ul>
                </div>
               </div>
          </div>

  <div class="row"><br><br><br>

<div class="col-md-4"> 
  <div class="col-md-12">     
    <div class="col-md-1">
     <h4 class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" style="color:#008000"> </h4>
   </div>
   <div class="col-md-11"> 
      <h4>CATALOGO DE ACTIVIDADES</h4>
    </div>
</div>
      <table class="table table-bordered" style="width:100%">
        <thead>
            <tr>
                  <th class="text-center">FECHA INICIO</th>
                  <th class="text-center">FECHA FIN</th>
                  
            </tr>
        </thead>
              <tbody>
                <?php
                while($fh = $fecha->fetch_assoc())
                {
                ?>
                <tr>
                  <td class="text-center"><?php echo date('d-m-y', strtotime($fh['dt_fh_inicio'])); ?></td>
                  <td class="text-center"><?php echo date('d-m-y', strtotime($fh['dt_fh_fin']));  ?></td>
                </tr> 
                <?php
                  }
                ?>               
              </tbody> 
        
      </table>



<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2>Crear fecha de actividades</h2>
        </div>
        <div class="modal-body">
          <div class="row">
            <form action="../controller/insert_fh_actividad.php" method="POST">                                  
                        <div class="col-md-4 col-md-offset-1">
                           <div class="form-group">
                              <label class="control-label">Inicio:</label>
                             <input class="form-control" id="date" name="date" placeholder="yyyy-dd-mm" type="text"/>
                           </div>
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                           <div class="form-group">
                              <label class="control-label">Fin:</label>
                             <input class="form-control" id="date2" name="date2" placeholder="yyyy-dd-mm" type="text"/>
                           </div>
                        </div>

                        <div class="col-md-4 col-md-offset-4"><br>
                          <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                        </div>
            </form>
          </div>
      
    </div>
  </div>
    </div>
  </div>
                    
            

         </div>
      </section>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--  jQuery -->
<script type="text/javascript" src="../plugins/calendar/js/jquery-1.11.3.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="../plugins/calendar/js/bootstrap-datepicker.min.js"></script>


<script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>


<script>
    $(document).ready(function(){
      var date_input=$('input[name="date2"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>

</body>
</html>