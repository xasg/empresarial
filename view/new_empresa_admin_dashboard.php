<?php   
   include_once('../model/databases_empresa.php');
   session_start();
   mysqli_set_charset( $mysqli, 'utf8');
if(isset($_SESSION['id'])){  
   $id=$_SESSION["id"];
   $empresa = get_usuario($id);
   $usuario = view_empresa($id);
   $result = run_entidad();
   $giro = run_giro();
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
     <meta name="FESE" content="">
     <title>Empresarial</title>
     <link href="../css/bootstrap.css" rel="stylesheet">
     <link href="../css/style.css" rel="stylesheet"> 
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
  <a class="navbar-brand" ><img src="../img/empresarial.png" alt="Dispute Bills">  
    <!--/.container-fluid -->
  </nav>
</div>
     <section>
         <div class="container">
            <div class="row"><br><br><br>
               <div class="col-md-12">
              
          </div>
            <br><br><br><br><br><br>
        
               </div>

               
               
               <div class="col-md-12">
                        <ul class="wizard-steps">
                          <li class="completed">
                            <a href="datos_empresa.php"><h5>Datos</h5> <span>Empresa</span></a>
                          </li>
                          <li>
                           <p style="color: #fafafa; margin: auto !important;">Ingresar datos</p>
                             <!-- <a href="empresarial.php" disabled><h5>Archivos</h5> <span>Digitales</span></a> -->
                          </li>
                          <!-- <li>
                             <a href="vacantes.php"><h5>Lista de</h5> <span>Vacantes</span></a>
                          </li>       
                        </ul> -->
                    </div>
              </div>
               <form action="../controller/new_empresa_admin.php" method="POST">
              <div class="container w-50"><br><h2>Datos de la empresa</h2><br> 
                  <div>
                        <div class="col-md-12 m-5">
                           <div class="form-group">
                              <!-- Street 1 --><br>
                              <label class="control-label">Nombre comercial:</label>
                              <input type="text" class="form-control" name="nombre" value="" pattern="[A-Za-z\. ]{1,50}" title="Proporcione un nombre correcto" onChange="conMayusculas(this)" required>
                           </div>
                        </div>
                       <div class="col-md-6 col-md-offset-3"><br><br>
                           <div class="form-group">
                              <!-- Submit Button -->
                              <input type="hidden" name="id" value="<?php echo $id; ?>" />
                              <button type="submit" class="btn btn-block btn-primary btn-lg">Crear Empresa</button><br><br>
                           </div>
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