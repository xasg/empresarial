<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   if(isset($_SESSION['id'])){  
   $id=$_SESSION["id"];   
   $empresas = run_empresas();
   $empresasVacantes = count_empresas();
   $conteo = $empresasVacantes['numeralia'];
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
      <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
      <link href="../css/style.css" rel="stylesheet" type="text/css">
      <link href="../css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../plugins/calendar/css/bootstrap-iso.css" />
      <link rel="stylesheet" href="../plugins/calendar/css/bootstrap-datepicker3.css"/>
      <script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
      
      <!--<script type="text/javascript" src="../js/jquery.min.js"></script>-->
      <!-- Initialize the plugin: -->
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
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
          <li class="active"><a href="#">Inicio</a></li>
          <li><a href="vacantes.php">Vacantes</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Perfil <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Privacidad</a></li>
              <li><a href="#">Terminos</a></li>
               <li><a href="../controller/logout.php">Salir</a></li>              
            </ul>
          </li>
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
                            <li class=""><a class="colora" href="candidato.php" >Candidatos</a></li>
                            <li class=""><a class="colora" href="beneficiario.php" >Beneficiarios</a></li>
                            <li><a class="colora" href="noaplica.php" >No aplica</a></li>
                            <li class="active"><a class="colora" href="#" >Vacantes</a></li>
                        </ul>
                </div>
               <div class="col-md-12 m-auto">
                 <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="colora" href="#" >Crear Vacante</a></li>
                            <li ><a class="colora" href="new_vacante_admin_view.php" >Ver vacantes</a></li>
                        </ul>
                </div>
               </div>
          </div>
          <div class="row">
               <div class="col-md-12"><br><br>
                <div class="row">
                    
                   <form action="../controller/update_vacante_admin_vacantes.php" method="POST">

                        <div class="col-md-12">
                            <h2>Selecciona la empresa<br><br></h2>
                        </div>                  
                        <div class="col-md-12">
                            <div class="mb-3">
                            <label for="" class="form-label">Empresas registradas validadas [<?php echo $conteo; ?>]</label>
                                          <select id="id_usuario_empresa" name="id_usuario_empresa"   class="form-control" name="hr_inicio" required>
                                            <option selected>Selecciona la empresa</option>
                                            <?php
                                            // $conteos;
                                            foreach ($empresas as $value) {
                                                $i++;
                                            ?>
                                              <?php
                                                if (  $value['dt_nombre_comercial'] != null) {
                                              ?>
                                                <option value=<?php echo $value['id_usuario'];?> ><?php echo $i." - ".$value['dt_nombre_comercial'];?></option>
                                              <?php  
                                                }else{
                                              ?>
                                                <option value=<?php echo $value['id_usuario']; ?> ><?php echo $i."- No ha registrado nombre comercial (".$value['dt_razon_social'].")";?></option>
                                            <?php 
                                              } 
                                            }
                                            ?>
                                        </select>
                                
                            </div>
                        </div>                  
                       

                        <div class="col-md-12">
                            <h2>Datos de la Vacante<br><br></h2>
                        </div>                  


                        <div class="col-md-12">
                           <div class="form-group">
                              <!-- Full Name -->
                              <label class="control-label">Nombre de la Vacante:</label>
                              <input type="text" class="form-control" name="nombre" onChange="conMayusculas(this)" required>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Número de vacantes</label>
                              <input type="text" class="form-control" name="numero" onChange="conMayusculas(this)" required>
                           </div>
                        </div>

                        <div class="col-md-8">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Carrera</label>
                              <input type="text" class="form-control" name="carrera" onChange="conMayusculas(this)" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- City-->
                              <label class="control-label">Fecha de inicio</label>
                              <input class="form-control" id="date" name="date" placeholder="yyyy-dd-mm" type="text" required/>
                              <!--
                              <select class="form-control" name="inicio" required>
                                    <option value="">Selecionar</option>
                                    <option value="01 de julio 2019">01 de julio 2019</option>
                                    <option value="12 de agosto 2019">12 de agosto 2019</option>
                                    <option value="12de agosto 2019">12de agosto 2019</option>
                                    <option value="19 de agosto 2019">19 de agosto 2019</option>
									<option value="26 de agosto 2019">26 de agosto 2019</option>
                                    <option value="02 septimbre 2019">02 septimbre 2019</option>
                                    <option value="17  septimbre 2019">17  septimbre 2019</option>
                                    <option value="30 septimbre 2019">30 septimbre 2019</option>
                                    <option value="14 de octubre 2019">14 de octubre 2019</option>
                                    <option value="04 de noviembre 2019">04 de noviembre 2019</option>
                                    <option value="18 de noviembre 2019">18 de noviembre 2019</option>
                                    <option value="02 de diciembre 2019">02 de diciembre 2019</option>
                                    <option value="16 de diciembre 2019">16 de diciembre 2019</option>
                                    <option value="06 de enero 2020">06 de enero 2020</option>
                                    <option value="20 de enero 2020">20 de enero 2020</option>
                                    <option value="03 de febrero 2020">03 de febrero 2020</option>
                                    <option value="17 de febrero 2020">17 de febrero 2020</option>
                                    <option value="02 de marzo 2020">02 de marzo 2020</option>
                                    <option value="16 de marzo 2020">16 de marzo 2020</option>
                                    <option value="30 de marzo 2020">30 de marzo 2020</option>
                                    <option value="15 de abril 2020">15 de abril 2020</option>
                                    <option value="04 de mayo 2020">04 de mayo 2020</option>
                                    <option value="18 de mayo 2020">18 de mayo 2020</option>
                                    <option value="01 de junio 2020">01 de junio 2020</option>
                                    <option value="15 de junio 2020">15 de junio 2020</option>
                                    <option value="06 de jilio 2020">06 de jilio 2020</option>
                                    <option value="20 de julio 2020">20 de julio 2020</option>
                                    <option value="03 de agosto 2020">03 de agosto 2020</option>
                                    <option value="17 de agosto 2020">17 de agosto 2020</option>
									 
                               </select>-->                               
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Fecha de término </label>
                              <input class="form-control" id="date2" name="date2" placeholder="yyyy-dd-mm" type="text" required/>
                              <!--
                               <select class="form-control" name="termino" required>
                                      <option value="">Selecionar</option>
                                      <option value="31 de diciembre 2019">31 de diciembre 2019</option>
                                      <option value="13 de diciembre 2019">13 de diciembre 2019</option>
                                      <option value="30 de agosto 2019">30 de agosto 2019</option>
                                      <option value="14 de febrero 2020">14 de febrero 2020</option>
                                      <option value="28 de febrero 2020">28 de febrero 2020</option>
                                      <option value="13 de marzo 2020">13 de marzo 2020</option>
                                      <option value="31 de marzo 2020">31 de marzo 2020</option>
                                      <option value="15 de abril 2020">15 de abril 2020</option>
                                      <option value="15 de mayo 2020">15 de mayo 2020</option>
                                      <option value="29 de mayo 2020">29 de mayo 2020</option>
                                      <option value="15 de junio 2020">15 de junio 2020</option>
                                      <option value="30 de junio 2020">30 de junio 2020</option>
                                      <option value="15 de julio 2020">15 de julio 2020</option>
                                      <option value="31 de julio 2020">31 de julio 2020</option>
                                      <option value="14 de agosto 2020">14 de agosto 2020</option>
                                      <option value="24 de agosto 2020">24 de agosto 2020</option>
                                      <option value="15 de septiembre 2020">15 de septiembre 2020</option>
                                      <option value="30 de septiembre 2020">30 de septiembre 2020</option>
                                      <option value="16 de octubre 2020">16 de octubre 2020</option>
                                      <option value="30 de octubre 2020">30 de octubre 2020</option>
                                      <option value="13 de noviembre 2020">13 de noviembre 2020</option>
                                      <option value="27 de noviembre 2020">27 de noviembre 2020</option>
                                      <option value="15 de diciembre 2020">15 de diciembre 2020</option>
                                      <option value="30 de diciembre 2020">30 de diciembre 2020</option>
                                      <option value="15 de enero 2021">15 de enero 2021</option>
                                      <option value="29 de enero 2021">29 de enero 2021</option>
                                      <option value="12 de enero 2021">12 de enero 2021</option>
                               </select>
                              -->


                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- City-->
                              <label class="control-label">Hora de inicio de actividades</label>
                              <select class="form-control" name="hr_inicio" required>
                                    <option value="">Selecionar</option>
                                    <option value="07:00">7:00</option>
                                    <option value="07:30">7:30</option>
                                    <option value="08:00">8:00</option>
                                    <option value="08:30">8:30</option>
                                    <option value="09:00">9:00</option>
                                    <option value="09:30">9:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                               </select>
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Hora de fin de actividades</label>
                               <select class="form-control" name="hr_termino" required>
                                    <option value="">Selecionar</option>
                                    <option value="07:00">7:00</option>
                                    <option value="07:30">7:30</option>
                                    <option value="08:00">8:00</option>
                                    <option value="08:30">8:30</option>
                                    <option value="09:00">9:00</option>
                                    <option value="09:30">9:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:30">11:30</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:30">12:30</option>
                                    <option value="13:00">13:00</option>
                                    <option value="13:30">13:30</option>
                                    <option value="14:00">14:00</option>
                                    <option value="14:30">14:30</option>
                                    <option value="15:00">15:00</option>
                                    <option value="15:30">15:30</option>
                                    <option value="16:00">16:00</option>
                                    <option value="16:30">16:30</option>
                                    <option value="17:00">17:00</option>
                                    <option value="17:30">17:30</option>
                                    <option value="18:00">18:00</option>
                                    <option value="18:30">18:30</option>
                                    <option value="19:00">19:00</option>
                                    <option value="19:30">19:30</option>
                                    <option value="20:00">20:00</option>
                                    <option value="20:30">20:30</option>
                                    <option value="21:00">21:00</option>
                                    <option value="21:30">21:30</option>
                                    <option value="22:00">22:00</option>
                                    <option value="22:30">22:30</option>
                                    <option value="23:00">23:00</option>
                               </select>
                           </div>
                        </div>



                        <!-- <div class="col-md-12">
                           <div class="form-group">
                              <label class="control-label">Actividades a realizar</label>
                              <textarea type="text" class="form-control" name="actividad" onChange="conMayusculas(this)" required rows="4"></textarea>
                           </div>
                        </div> -->

                        <!-- <div class="col-md-4">
                           <div class="form-group">
                              
                              <label class="control-label">Área de la Empresa</label>
                              <input type="text" class="form-control" name="area" onChange="conMayusculas(this)" required>                              
                           </div>
                        </div>                         -->
                        

                        <div class="col-md-4">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Apoyo ecónomico</label>
                              <input type="text" class="form-control" name="apoyo"  onChange="conMayusculas(this)" required>
                           </div>
                        </div>
                        
                         <div class="col-md-4">
                           <div class="form-group">
                              <!-- Street 1 -->
                              <label class="control-label">Dispersión al beneficiario</label>
                               <select class="form-control" name="dispersion" required>
                                 <option value="">SELECCIONAR</option>
                                 <option value="QUINCENAL">QUINCENAL</option>
                                 <option value="MENSUAL">MENSUAL</option>
                               </select>
                           </div>
                        </div>  
<!-- 
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Competencias</label><br>
                             <select id="example-getting-started" name="competencia[]" multiple="multiple"  required>
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
                        </div>   -->

                                         
                        <!-- <div class="col-md-12"><h3><br><strong>DIRECCIÓN</strong></h3></div>-->
                        <!-- <div class="col-md-12">
                           <div class="form-group">

                              <label class="control-label">Descripción adicional</label>                              
                              <textarea type="text" class="form-control" name="descripcion" onChange="conMayusculas(this)" required rows="4"></textarea>
                           </div>
                        </div>
 -->
                      <!-- <div class="col-md-12">
                        <h2><br>Tutor Empresarial<br><br></h2>
                      </div> -->

                      <!-- <div class="col-md-6">
                           <div class="form-group">

                              <label class="control-label">Nombre Completo</label>
                              <input type="text" class="form-control" name="tutor" onChange="conMayusculas(this)" required>
                           </div>
                        </div>

                       <div class="col-md-6">
                           <div class="form-group">

                              <label class="control-label">Puesto</label>
                              <input type="text" class="form-control" name="cargo" onChange="conMayusculas(this)" required>
                           </div>
                        </div> -->
                         
                       <div class="col-md-6 col-md-offset-3">
                           <div class="form-group"><br><br>    
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                           </div>
                        </div>
                  </form>
               </div>
            

         </div>
      </section>


<!--
<script type="text/javascript" src="../plugins/calendar/js/jquery-1.11.3.min.js"></script>
-->
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