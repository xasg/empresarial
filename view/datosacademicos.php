<?php
include_once('../model/databases_beneficiario.php');
mysqli_set_charset( $mysqli, 'utf8'); 
session_start();
$id=$_SESSION["id"];
$beneficiario =acces_beneficiario($id);
$entidad=run_entidad()
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
      <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
      <!--<script type="text/javascript" src="../js/jquery.min.js"></script>-->
      <!-- Initialize the plugin: -->
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>
        <script language="javascript">
      $(document).ready(function(){
        $("#entidad").change(function () {          
          $("#entidad option:selected").each(function () {
            id_cat_entidad = $(this).val();
            $.post("../includes/getIES.php", { id_cat_entidad: id_cat_entidad }, function(data){
              $("#ies").html(data);
            });            
          });
        })
      });      


      $(document).ready(function(){
        $("#ies").change(function () {          
          $("#ies option:selected").each(function () {
            id_cat_ies = $(this).val();
            $.post("../includes/getCarrera.php", { id_cat_ies: id_cat_ies }, function(data){
              $("#carrera").html(data);
            });            
          });
        })
      });      

    </script>
    <script language="JavaScript"> 
        function conMayusculas(field) 
        { 
            field.value = field.value.toUpperCase() 
        }   
    </script>
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
          <li><a href="#">Inicio</a></li>
          <li><a href="#">Vacantes</a></li>
          <li><a href="../index.php">Salir</a></li>
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
     <div class="col-md-12">
      <br><br>
    </div>
    <div class="col-md-12">
      <ul class="wizard-steps">
        <li class="finalizado">
          <a href="#"><h5>Datos</h5> <span>Personales</span></a>
        </li>
        <li class="completed">
         <a href="#"><h5>Datos</h5> <span>Academicos</span></a>
       </li>
       <li>
        <a href="#"><h5>Datos</h5> <span>Complementarios</span></a>
      </li>            
      <li >
        <a href="#"><h5>Archivos</h5> <span>Digitales</span></a>
      </li>  
      <li>
        <a href="#"><h5>Seleccionar</h5> <span>Vacante</span></a>
      </li>           
    </ul>
  </div>
</div>

<form action="../controller/update_datosacademicos.php" method="POST">
  <div class="row"><br><h2>Datos Academicos</h2><br>

    <div class="col-md-4">
      <label>Entidad </label>
      <select class="form-control" name="entidad" id="entidad" required>
                          <option value="">Seleccionar Entidad</option>
                          <?php while($row = $entidad->fetch_assoc()) { ?>
                          <option value="<?php echo $row['id_cat_entidad']; ?>"><?php echo $row['nombre_entidad']; ?></option>
                          <?php } ?>
      </select> 
    </div> 

    <div class="col-md-4">
      <div class="form-group">
        <label>Institución de Educación Superior</label>
        <select class="form-control" name="ies" id="ies" required></select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Carrera</label>
        <select class="form-control" name="carrera" id="carrera" required></select>
      </div>
    </div>                             
  </div>
  <div class="row"> 
    <div class="col-md-3">
      <div class="form-group">
        <label>Matricula o Número de control</label>
        <input type="text" name="matricula" class="form-control" value="<?php echo $beneficiario['dt_matricula'] ?>" pattern="[A-Za-z0-9 ]{1,20}" title="Proporcione una matricula o número de control  correcto" required>
      </div>
    </div>             
    <div class="col-md-3">
      <div class="form-group">
        <label>Tipo de periodo que cursas</label>
        <select class="form-control" name="periodo" value="<?php echo $beneficiario['dt_periodo'] ?>" required>
          <option value="SEMESTRE">SEMESTRE</option>
          <option value="CUATRIMESTRE">CUATRIMESTRE</option>
          <option value="SEMESTRE">TRIMESTRE</option>
        </select>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>No. Periodo que cursa</label>
        <input type="text" name="no_periodo" placeholder="Ejemplo: 8" maxlength="2" class="form-control" value="<?php echo $beneficiario['dt_periodo_num'] ?>" pattern="[0-9]{1,2}" title="Proporcione un numero" required>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label>Porcentaje de Créditos</label>
        <input type="text" name="no_creditos" placeholder="Ejemplo: 80" class="form-control" value="<?php echo $beneficiario['dt_creditos'] ?>" pattern="[0-9]{2,3}"  title="Proporcione un numero" required>
      </div>
    </div> 


    <div class="col-md-3">
                           <div class="form-group">
                              <label class="control-label">habilidades transversales</label><br>
                             <select id="example-getting-started" name="habilidades[]" multiple="multiple"  required>
                                  <option value="">SELECIONAR</option>
                                  <option value="COMUNICACIÓN,">COMUNICACIÓN</option>
                                  <option value="LIDERAZGO,">LIDERAZGO</option>
                                  <option value="TRABAJO EN EQUIPO,">TRABAJO EN EQUIPO</option>
                                  <option value="INTELIGENCIA EMOCIONAL">INTELIGENCIA EMOCIONAL</option>
                                  <option value="EFICIENCIA PERSONAL">EFICIENCIA PERSONAL</option>
                                  <option value="INNOVACIÓN">INNOVACIÓN</option>
                                  <option value="EMPRENDIMIENTO">EMPRENDIMIENTO</option>
                                  <option value="ACTUALIDAD">ACTUALIDAD</option>
                                  <option value="TIC">TIC</option>
                            </select>
                           </div>
    </div> 



<!--
    <div class="col-md-3">
      <div class="form-group">
                             
                              <label class="control-label">Habilidades Transversales</label>
                                 <?php //if($beneficiario['dt_ht']!=NULL){?>
                              <select class="form-control" name="habilidades" required>
                              <?php 
                                // echo '<option value="'.$beneficiario['dt_ht'].'" //selected="">'.$beneficiario['dt_ht'].'</option>'
                                 ?>
                                <option value="COMUNICACIÓN">COMUNICACIÓN</option>
                                <option value="LIDERAZGO">LIDERAZGO</option>
                                <option value="TRABAJO EN EQUIPO">TRABAJO EN EQUIPO</option>
                                <option value="INTELIGENCIA EMOCIONAL">INTELIGENCIA EMOCIONAL</option>
                                <option value="EFICIENCIA PERSONAL">EFICIENCIA PERSONAL</option>
                                <option value="INNOVACIÓN">INNOVACIÓN</option>
                                <option value="EMPRENDIMIENTO">EMPRENDIMIENTO</option>
                                <option value="ACTUALIDAD">ACTUALIDAD</option>
                                <option value="TIC">TIC</option>
                              </select>
                              <?php //} else { ?>
                              
                            <select class="form-control" name="habilidades" >
                               <option value="COMUNICACIÓN">COMUNICACIÓN</option>
                                <option value="LIDERAZGO">LIDERAZGO</option>
                                <option value="TRABAJO EN EQUIPO">TRABAJO EN EQUIPO</option>
                                <option value="INTELIGENCIA EMOCIONAL">INTELIGENCIA EMOCIONAL</option>
                                <option value="EFICIENCIA PERSONAL">EFICIENCIA PERSONAL</option>
                                <option value="INNOVACIÓN">INNOVACIÓN</option>
                                <option value="EMPRENDIMIENTO">EMPRENDIMIENTO</option>
                                <option value="ACTUALIDAD">ACTUALIDAD</option>
                                <option value="TIC">TIC</option>
                            </select> 
                          <?php //}?>

                           </div>     
    </div>  

-->


    <div class="col-md-3 col-md-offset-9">
      <div class="form-group"><br><br>    
        <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
      </div>
    </div>          
  </div>

</form>
</div>
</div>
</section> 
</body>
</html>