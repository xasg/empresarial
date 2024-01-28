<?php
include_once('../model/databases_beneficiario.php');
mysqli_set_charset( $mysqli, 'utf8'); 
session_start();
// Verificar si la sesión está iniciada
if (!isset($_SESSION['id'])) {
  // La sesión no está iniciada, redireccionar a la página de inicio de sesión
  header('Location: ../index.php');
  exit(); // Asegurarse de que el script se detenga después de la redirección
}
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
  // Manejar el cambio en el elemento con id "entidad"
  $("#entidad").change(function () {          
    $("#entidad option:selected").each(function () {
      id_cat_entidad = $(this).val();
      $.post("../includes/getIES.php", { id_cat_entidad: id_cat_entidad }, function(data){
        $("#ies").html(data);
        agregarOpcionOtros("ies");
        mostrarOcultarInputOtros("ies");
        obtenerCarreras(); // Llamada a la función para obtener las carreras al cambiar "entidad"
      });            
    });
  });

  // Manejar el cambio en el elemento con id "ies"
  $("#ies").change(function () {
    mostrarOcultarInputOtros("ies");
    obtenerCarreras(); // Llamada a la función para obtener las carreras al cambiar "ies"
  });

  // Manejar el cambio en el elemento con id "carrera"
  $("#carrera").change(function () {
    mostrarOcultarInputOtros("carrera");
  });

  // Agregar la opción "otros" al cargar la página para "ies" y "carrera"
  agregarOpcionOtros("ies");
  agregarOpcionOtros("carrera");

  // Función para agregar la opción "otros" al select de "ies" y "carrera"
  function agregarOpcionOtros(elementId) {
    // Verificar si la opción "otros" ya está presente
    if ($(`#${elementId} option[value='otros']`).length === 0) {
      // Agregar la opción "otros" al final del select
      $(`#${elementId}`).append("<option value='otros'>Otros</option>");
    }
  }

  // Función para mostrar u ocultar el input "nombre_ies_input" o "nombre_carrera_input" según la opción seleccionada
  function mostrarOcultarInputOtros(elementId) {
    var selectedOption = $(`#${elementId}`).val();

    // Verificar si la opción seleccionada es 'otros'
    if (selectedOption === 'otros') {
      // Mostrar un input adicional
      $(`#nombre_${elementId}_input`).show();
      // Hacer que el input sea requerido
      $(`#nombre_${elementId}_input`).prop('required', true);

      // Si el elemento es "carrera", hacer que el campo de carrera también sea requerido
      if (elementId === 'carrera') {
        $("#carrera").prop('required', true);
      }
    } else {
      // Ocultar el input si la opción no es 'otros'
      $(`#nombre_${elementId}_input`).hide();
      // Hacer que el input no sea requerido
      $(`#nombre_${elementId}_input`).prop('required', false);

      // Si el elemento es "carrera", hacer que el campo de carrera no sea requerido
      if (elementId === 'carrera') {
        $("#carrera").prop('required', false);
      }
    }
  }

  // Función para obtener las carreras mediante AJAX
  function obtenerCarreras() {
    var id_cat_ies = $("#ies").val(); // Obtener el valor seleccionado en "ies"
    
    // Enviar 0 como valor si la opción seleccionada es 'otros'
    if (id_cat_ies === 'otros') {
      id_cat_ies = 0;
    }

    // Realizar una solicitud AJAX para obtener las carreras
    $.post("../includes/getCarrera.php", { id_cat_ies: id_cat_ies }, function(data){
      $("#carrera").html(data);
      agregarOpcionOtros("carrera");
      mostrarOcultarInputOtros("carrera");
    });
  }
});



    </script>






<script language="JavaScript"> 
           $(document).ready(function () {
            // Selecciona todos los inputs de tipo texto y añade un controlador de eventos
            $("input[type='text']").on('input', function () {
              // Convierte el valor del input a mayúsculas
              $(this).val($(this).val().toUpperCase());
            });
          }); 
    </script>

<?php
  actualizarBeneficiarios20($id);  // se manda a llamar esta funcion para actualizar los datos del registro al 20% 
?>
</head>
<body >     <!---MANDO A LLAMAR MI FUNCION PARA ACTUALIZAR LOS DATOS DEL AVANCE DEL USUARIO ---->
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
          <a href="datospersonales.php"><h5>Datos</h5> <span>Personales</span></a>
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
        <select class="form-control" name="ies" id="ies" required>
          <option selected disabled>Selecciona la IES</option>
          <!-- Opciones de IES -->
        </select>
        <!-- <select class="form-control" name="ies" id="ies" required>
          <option selected disabled>Selecciona la IES</option>
          
        </select> -->
        
        <br>
        <!-- Campo de entrada para el nombre de la IES -->
        <input class="form-control" type="text" id="nombre_ies_input" name="nombre_ies_input" style="display: none;" placeholder="Ingrese el nombre de la IES" required>

        
        <!-- <input class="form-control" type="text" id="nombre_ies_input" name="nombre_ies_input" style="display: none;" placeholder="Ingrese el nombre de la IES"> -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Carrera</label>
        <select class="form-control" name="carrera" id="carrera" required></select>
        <br>
        <input class="form-control" type="text" id="nombre_carrera_input" name="nombre_carrera_input" style="display: none;" placeholder="Ingrese la carrera" required>
      </div>
    </div>                             
  </div>
  <div class="row"> 
    <div class="col-md-3">
      <div class="form-group">
        <label>Matricula o Número de control</label>                          

        <input type="text" name="matricula" class="form-control" value="<?php echo $beneficiario['dt_matricula'] ? $beneficiario['dt_matricula'] : ''; ?>" pattern="[A-Za-z0-9 ]{1,20}" title="Proporcione una matricula o número de control  correcto" required>
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
                                  <option value="" disabled >SELECIONAR</option>
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
      <div class="form-group" style="display:flex; gap:10px"><br><br>    
        <!--<a href="datospersonales.php" class="  btn-primary btn-lg">Anterior</a>  -->
        <button type="submit" class="btn  btn-block btn-primary btn-lg">Guardar</button><br><br>
      </div>
    </div>          
  </div>

</form>
</div>
</div>
</section> 

    <!-- Mensaje de confirmacion de existe ies -->
    <div id="miModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title"></h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bg-warning text-center">
            ¡La Institución que intentas registrar ya se encuentra en la base de datos, verifica nuevamente tu selección!
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Mensaje de confirmacion de falta carrera -->
    <div id="miModalcarrera" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title"></h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bg-warning text-center">
          ¡Por favor, completa todos los campos! Parece que no has seleccionado una carrera. <br> ¡Verifica tu selección e inténtalo nuevamente!
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

<?php


if (isset($_GET['existeies']) && $_GET['existeies'] === 'si') {
    echo "<script>
            $(document).ready(function(){
                $('#miModal').modal('show');
            });
          </script>";
}
if (isset($_GET['faltacarrera']) && $_GET['faltacarrera'] === 'si') {
    echo "<script>
            $(document).ready(function(){
                $('#miModalcarrera').modal('show');
            });
          </script>";
}
?>
</body>
</html>