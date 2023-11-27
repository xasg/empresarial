<?php   
   include_once('../model/databases_beneficiario.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
   $id=$_SESSION["id"];
   $beneficiario=acces_beneficiario($id);
   $result = run_entidad();
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
     <script type="text/javascript">
    function validarInput(input) {
  var curp = input.value.toUpperCase(),
      resultado = document.getElementById("resultado"),
        valido = "No válido";        
    if (curpValida(curp)) {
      valido = "Válido";
        resultado.classList.add("ok");
    } else {
      resultado.classList.remove("ok");
    }
        
    resultado.innerText = "CURP: " + curp + "\nFormato: " + valido;
}

function curpValida(curp) {
  var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0\d|1[0-2])(?:[0-2]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
      validado = curp.match(re);  
    if (!validado)  //Coincide con el formato general?
      return false;    
    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i<17; i++)
            lngSuma= lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if(lngDigito == 10)
            return 0;
        return lngDigito;
    }
    if (validado[2] != digitoVerificador(validado[1])) 
      return false;        
  return true; //Validado
}
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
                          <li class="completed">
                            <a href="datospersonales.php"><h5>Datos</h5> <span>Personales</span></a>
                          </li>
                          <li>
                            <a href="#"><h5>Datos</h5> <span>Academicos</span></a>
                          </li>
                          <li>
                            <a href="#"><h5>Datos</h5> <span>Complementarios</span></a>
                          </li>            
                          <li>
                            <a href="#"><h5>Archivos</h5> <span>Digitales</span></a>
                          </li>  
                          <li>
                            <a href="#"><h5>Seleccionar</h5> <span>Vacante</span></a>
                          </li>           
                        </ul>
                    </div>
              </div>
               <form action="../controller/update_beneficiario.php" method="POST">
              <div class="row"><h3>Datos Personales</h3><br>             
                <div class="col-md-4">
                <div class="form-group">
                  <label>Nombre(s):</label>
                  <input type="text" class="form-control" onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_nombres'] ?>" pattern="[A-Za-z ]{1,30}" title="Proporcione un nombre correcto" required>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Apellido Paterno:</label>
                  <input type="text" class="form-control" onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_apaterno']?>" pattern="[A-Za-z ]{1,30}" title="Proporcione un Apellido correcto" required>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Apellido Materno:</label>
                   <input type="text" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_amaterno']?>" pattern="[A-Za-z ]{1,30}" title="Proporcione un Apellido correcto" required>
                </div>
                </div>              
              </div>

              <div class="row">             
                <div class="col-md-4">
                <div class="form-group">
                  <label>CURP:</label>
                   <!--<input type="text" name="curp" class="form-control" value="<?php //echo $beneficiario['dt_curp'] ?>">-->
                   <input type="text" name="curp" class="form-control" id="curp_input" oninput="validarInput(this)" placeholder="Ingrese su CURP"  value="<?php echo $beneficiario['dt_curp'] ?>" required>
                    <p id="resultado"></p>
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                  <label>Teléfono(10 Dígitos):</label>
                   <input type="text" name="telefono" class="form-control"  onChange="conMayusculas(this)"  maxlength="10" value="<?php echo $beneficiario['dt_telefono'] ?>" placeholder="Ejemplo:5546268266" pattern="[0-9]{10}" title="Proporcione un Teléfono correcto" required>
                </div>
                </div> 
                <div class="col-md-4">
                <div class="form-group">
                  <label>Correo:</label>
                   <input type="email" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_correo']?>" required>
                </div>
                </div>           
              </div>
              <div class="row">             
                <div class="col-md-6">
                <div class="form-group">
                  <label>Dirección (Calle y Número):</label>
                   <!-- <input type="text" name="direccion" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_direccion']?>" pattern="[A-Za-z\# ]{1,1000}" title="Proporcione una dirección correcto" required> -->
                   <input type="text" name="direccion" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_direccion']?>" pattern="[A-Za-0-9]+" title="Proporcione una dirección correcto" required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label>Localidad, colonia o barrio:</label>
                   <input type="text" name="colonia" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_colonia']?>"  pattern="[A-Z-a-z]" title="Proporcione un nombre correcto"required>
                </div>
                </div>                           
              </div>
              <div class="row">  
                <div class="col-md-6">
                <div class="form-group">
                  <label>Municipio:</label>
                  <input type="text" name="municipio" class="form-control"  onChange="conMayusculas(this)" value="<?php echo $beneficiario['dt_municipio']?>" pattern="[A-Za-z ]{1,50}" title="Proporcione un nombre correcto" required>
                </div>
                </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <!-- State Button -->
                              <label class="control-label">Entidad federativa:</label>
                              <?php if($beneficiario['id_cat_entidad']!=NULL){?>
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" required>
                              <?php 
                                 echo '<option value="'.$beneficiario['id_cat_entidad'].'">'.$beneficiario['nombre_entidad'].'</option>'
                                 ?>
                                 <?php
                                     while ($resul = $result->fetch_assoc()) { 
                                       echo '<option value="'.$resul['id_cat_entidad'].'">'.$resul['nombre_entidad'].'</option>';
                                     }
                                 ?>
                              </select>
                              <?php } else { ?>
                              <select class="form-control" name="entidad" onChange="conMayusculas(this)" required>
                                 <option value="" <?php if (!(strcmp("", $beneficiario['nombre_entidad']))) {echo "selected=\"selected\"";} ?>></option>
                                 <?php  
                                    if ($result->num_rows > 0) {
                                     while ($resul = $result->fetch_assoc()) { 
                                       echo '<option value="'.$resul['id_cat_entidad'].'">'.$resul['nombre_entidad'].'</option>';
                                    }
                                    }       
                                    ?>
                              </select>
                              <?php } ?>
                           </div>
                        </div>

                        
                <div class="col-md-3">
                <div class="form-group">
                  <label>Codigo Postal:</label>
                  <input type="text" name="cp" class="form-control" maxlength="5" value="<?php echo $beneficiario['dt_cp']?>" pattern="[0-9]{5}" title="Proporcione un Código Postal correcto" required>
                </div>
                </div>
                <div class="col-md-3 col-md-offset-9">
                  <div class="form-group">
                  <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br>
                  </div>
                </div>
              </div>
              </form>
              </div>
         </div>
      </section>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>   
</body>
</body>
</html>