<?php
  // Desactivar toda notificación de error
    include_once ('../model/database_admin.php');
     // Desactivar toda notificación de error
  session_start();
  error_reporting(0);
//    require_once('../model/databases_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   if(isset($_SESSION['tp_user']) == 3){  

//    $id=$_SESSION["id"];   
    
   $id=$_GET['vac'];
   $vac = run_vacanteinfo($id);
   $nom = run_vacante_info($id);
   $nom_comercial = "nom";
//    foreach ($nom as $key => $value) {
//       $nom_comercial = $value['dt_nombre_comercial'];
//    }

   $vacante = run_vacantes();
   $empresas = run_empresas_vacante();
   $conteos = count_empresas();
   foreach($conteos as $num){
       $conteo = $num['numeralia'];
   }

// Reporte Candidatos/Beneficiarios
   $conteosCandidatos = count_candidatos_total();
   $conteoCan = $conteosCandidatos['numeralia'];
   $conteosActCan = count_candidatos_actual();
   $conteosAntCan = count_candidatos_anterior();
   $conteoActCan = $conteosActCan['total'];
   $conteoAntCan = $conteosAntCan['total'];
// Beneficiarios
$beneficiariosActual = count_beneficiarios_actual();
$beneficiarioA = $beneficiariosActual['numeralia'];
$beneficiariosTotalActual = count_beneficiarios_total_actual();
$beneficiarioTotalA = $beneficiariosTotalActual['numeralias'];
$beneficiariosTotales = count_beneficiarios_total();
$beneficiarioT = $beneficiariosTotales['numeralias'];  

// Candidatos

$candidatosRegistrados = count_candidatos_registrados();
$registrados = $candidatosRegistrados['numeralia'];
$candidatosRegistradosActual = count_candidatos_registrados_actual();
$registradosActual = $candidatosRegistradosActual['numeralia'];
$candidatosProceso = count_candidatos_enproceso();
$registradosProceso = $candidatosProceso['numeralia'];
$candidatosFinalizados = count_candidatos_Finalizado();
$registradosFinalizado = $candidatosFinalizados['numeralia'];

// Invitaciones
$invitacionesTotales = count_invitaciones() ;
$invitacion = $invitacionesTotales['numeralia'];
$invitacionesRegistrados = count_invitaciones_registrados();
$invitacionR = $invitacionesRegistrados['numeralia'];
$invitacionesPendientes = count_invitaciones_pendientes();
$invitacionP = $invitacionesPendientes['numeralia'];  

// Reporte Empresas
   $conteos = count_empresas_registradas_total();
   $conteosAct = count_empresas_registradas_actual();
   $conteosAnt = count_empresas_registradas_anterior();
   $conteo = $conteos['numeralia'];
   $conteoAct = $conteosAct['total'];
   $conteoAnt = $conteosAnt['total'];

  //  Empresas nuevas, validadas bajas
  $empNuevas = count_empresas_nuevas();
  $empN = $empNuevas['nums'];
  $empValidadas = count_empresas_validadas();
  $empV = $empValidadas['nums'];
  $empBajas = count_empresas_bajas();
  $empB = $empBajas['nums'];

  // Apoyos vacantes
  $apoyosVacantes = apoyo_vacantes_total();
  $apoyoVac = $apoyosVacantes['apoyoTotal'];
  $apoyosVacantesAct = apoyo_vacantes_actual();
  $apoyoVacAct = $apoyosVacantesAct['apoyoActual'];
  $apoyosVacantesAnt = apoyo_vacantes_anterior();
  $apoyoVacAnt = $apoyosVacantesAnt['apoyoAnterior'];

  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: ../"); 
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Registro Empresas</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- dognut chart -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

     <link href="../../css/style.css" rel="stylesheet"> 
     <link rel="stylesheet" type="text/css" href="../css/cssGenerales.css">
  <!-- Demas estilos -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <style>
    .active{
      background: #af4dac !important;
    }
    a:hover{
    background: #af4dac !important;
    color:#fafafa !important;
    border-radius: 22px;
    }

    .tablas-estilos{
      border-radius: 22px;  border: 4px solid #964094 !important;
      /* background: linear-gradient(#964094 -10%,#fafafa ); color:#fafafa; */
      background: #f8f9fa;
      box-shadow: -1px 2px 7px #964094 !important;
      transition: all .3s;
    }
    .tablas-estilos:hover,.tablas-estilos-datos:hover{
      /* border: 1px solid #964094 !important; */
      box-shadow: -7px 7px 4px #964094, -2px 5px 30px #964094 !important;
    }
    .tablas-estilos-datos{
      border-radius: 22px;  border: 4px solid #964094 !important;  color:#964094; box-shadow: -1px 2px 7px #964094 !important;
      transition:all .3s;
    }
    
    table{
  table-layout: auto;
  overflow: auto;
  border: 1px solid;
  margin-left: 2%;
  max-width:500px !important;
  }
  table thead,
  table th,
  table td {
    width: 99%;
    max-width: 200px !important;
    overflow: auto;
    border: 1px solid;
  }

  table th{
    height: 20px !important;
  }

  .btn-primary{
    background: #6E2463 !important;
  }
  </style>
  
  <script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
  </script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<?php
        if (isset($_REQUEST['registrada'])) {
    ?>
        <script>
            alert("Empresa registrada correctamente puedes validar en la seccion de empresas Nuevas o pendientes");
        </script>
    <?PHP
        }   
    ?>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php
          if ($empN) {
            
          ?>
          <span class="badge badge-warning navbar-badge">15</span>
          <?php
          }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Usuario</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Configuración
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
          <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
          </a>
          
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-black elevation-4" style="min-height:100vh; position:fixed;" >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <img src="../../img/empresarial.png" alt="FESE" class="brand-image elevation-5" style="opacity: .8; ">
      <span class="brand-text font-weight-light">.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background:#410541; " >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../img/logo.png" class="elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block text-white">Panel de Administrador</a>
        </div>
      </div>
 
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="min-height:160vh">
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="#" class="nav-link ">
            <i class="nav-icon fa fa-building "></i>
              <p>
                Empresas
                <i class="fas fa-angle-left right"></i>
                
                <span class="badge badge-info right">4</span>
                <?php
                // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                  if ($empN > 0) {
                ?>
                <span class="badge badge badge-danger"><?php echo $empN;?></span>
                <?php
                  # code...
                  }
                ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="registrar_empresa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar Empresa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="empresas_nuevas_pendientes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Nuevas/Pendientes
                  <?php
                  // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                    if ($empN > 0) {
                  ?>
                  <span class="badge badge badge-danger"><?php echo $empN;?></span>
                  <?php
                    # code...
                    }
                  ?>
                  </p>
                </a>
              </li>
              <!-- Nav Validadas -->
              <li class="nav-item">
                <a href="validadas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validadas <span class="badge badge-info right"><?php echo $empV; ?></span></p>
                </a>
              </li>
              <!-- Nav Bajas -->
              <li class="nav-item">
                <a href="bajas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bajas <span class="badge badge-info right"><?php echo $empB; ?></span></p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user "></i>
              <p>
                Candidatos
                <i class="fas fa-angle-left right"></i>
                
                <span class="badge badge-info right">2</span>
                <?php
                // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                  if ($registradosActual > 0) {
                ?>
                <span class="badge badge badge-danger"><?php echo $registradosActual;?></span>
                <?php
                  # code...
                  }
                ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Solo Registro
                    <?php
                      if ($registrados > 0) {
                    ?>
                    <span class="badge badge badge-danger"><?php echo $registrados;?></span>
                    <?php
                      }
                    ?>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    En proceso
                  <?php
                  // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                    if ($registradosProceso > 0) {
                  ?>
                  <span class="badge badge-warning right"><?php echo $registradosProceso; ?></span>
                  <?php
                    # code...
                    }
                  ?>
                  </p>
                </a>
              </li>
              <!-- Nav Validadas -->
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Finalizado o por seleccionar vacante <span class="badge badge-success right"><?php echo $registradosFinalizado; ?></span></p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user "><sub><i class="fa fa-check-circle" aria-hidden="true"></i></sub></i>
              <p>
                Beneficiarios
                <i class="fas fa-angle-left right"></i>
                
                <span class="badge badge-info right">2</span>
                <?php
                // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                  if ($empN > 0) {
                ?>
                <span class="badge badge badge-danger"><?php echo $empN;?></span>
                <?php
                  # code...
                  }
                ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    2023
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    2022
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    2021
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    2020 
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    2019 
                  </p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user "><sub><i class="fa fa-times-circle" aria-hidden="true"></i></sub></i>
              <p>
                No Aplica
              </p>
            </a>
          </li>
          <?php
          $vacantesActuales = count_empresas_vac_actuales();
          $actuales = $vacantesActuales['registros'];
          ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Vacantes
                <i class="fas fa-angle-left right"></i>
                
                <span class="badge badge-info right">2</span>
                <?php
                // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                  if ($actuales > 0) {
                ?>
                <span class="badge badge badge-danger"><?php echo $actuales;?></span>
                <?php
                  # code...
                  }
                ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vacantes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Registrar Vacante
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="vacantes_actuales.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Ver vacantes
                  </p>
                </a>
                  <ol>
                    <li class="nav-item">
                      <a href="vacantes.php" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Invitar
                        </p>
                      </a>
                    </li>
                  </ol>
              </li>
              <li class="nav-item">
                <a href="invitados.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Invitaciones
                  </p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Invitar Vacantes</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item ">Invitar Vacantes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content"  >
      <div class="container-fluid">
        <div class="row">
          <!-- Nav con imagen del logo de fese -->
          <div class="col-lg-12 container-fluid" style="background-color: #f5f5f5">
              <nav class="navbar navbar-default">
                  <a class="navbar-brand" href="index.php" ><img src="../../img/empresarial.png" alt="Dispute Bills" style="width:200px;"></a>
              </nav>
          </div>      
          <!-- Contenedor principal Main del Fromulario -->
          <main class="container">
            <section class="border shadow  m-auto" style="border-radius:22px; margin-bottom:100px !important;">
              <div class="row m-auto">
                <div class="col-md-12">
                  <ul class="wizard-steps mt-5">
                    <li class="completed"><a><h5 class="text-center ">Invitar a <span>Vacante</span></h5></a></li>
                    <li><p class="text-center mt-2" style="color: #fafafa;">Editar datos</p></li>
                  </ul>
                </div>
                <!-- Formulario de registro  -->
                <section class="container col-lg-12 border">
                  <div class="container col-lg-12 border">
                    <div class="row m-auto">
                      <!-- Aqui se visualizan los candidatos agregaods -->
                      <div class="container col-12 ">   
                        <h3 class="text-center mb-5" style="font-weight: 800; font-size: 35px">
                          Invitacion de vacantes
                          <hr>
                        </h3>
                        <?php
                          include('../model/database_emails.php');
                          $resultadoCandidatosInvitados = get_cantidad_total();
                          $cantidad = mysqli_num_rows($resultadoCandidatosInvitados);
                        ?>
                        <!-- Formulario para envio de las vacantes por correo  -->
                        <form action="email.php" method="post">
                            <div class="row mb-5">
                              <div class="col-4">
                                <!-- <input type="checkbox" onclick="marcarCheckbox(this);"/> -->
                                <!-- <label id="marcas">Marcar todos</label> -->
                              </div>
                              <div class="col-4">
                                <!-- <p id="resp"></p> -->
                              </div>
                              <div class="col-sm-4" style="margin:10px;">
                                <!-- <input type="submit" style="display: none;" name="enviarform" id="enviarform" class="btn btn-round btn-primary btn-block" value="Enviar Emails"> -->
                              </div>
                            </div>
                            <div class="table-responsive mb-5">
                              <table class="table  table-hover table-bordered m-auto">
                                  <thead class="thead-dark">
                                    <tr>
                                          <th> # </th>
                                          <th>Candidato</th>
                                          <th>Email</th>
                                          <th>Empresa</th>
                                          <th>Vacante</th>
                                          <th>Estatus de Notificación</th>
                                          <th>Ultimo envio</th>
                                          <th>acciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php $i = 1; while ($dataClientes = mysqli_fetch_array($resultadoCandidatosInvitados)) { ?>
                                      <tr>
                                        <td>
                                          <?php echo $i; ?>
                                          <!-- <input type="checkbox"  name="correo[]" class="CheckedAK" correo="<?php echo $dataClientes['correo']; ?>" value="<?php echo $dataClientes['correo']; ?>"/> -->
                                        </td>
                                        <td><?php echo $dataClientes['nombre']; ?></td>
                                        <td><?php echo $dataClientes['correo']; ?></td>
                                        <!-- <td><input type="number" id="idvac" name="idvac" value="<?php echo $dataClientes['id_vacante']; ?>" hidden></td> -->
                                        <!-- <td> <input type="text" id="nombreComercial" name="nombreComercial" value="<?php echo $dataClientes['dt_nombre_comercial']; ?>" disabled> </td>
                                        <td> <input type="text" id="nombreVacante" name="nombreVacante" value="<?php echo $dataClientes['dt_nombre'];?>" stye="width:100% !important;" disabled></td> -->
                                        <td> <?php echo $dataClientes['dt_nombre_comercial']; ?> </td>
                                        <td> <?php echo $dataClientes['dt_nombre'];?></td>
                                        <td>
                                          <?php
                                            echo ($dataClientes['notificacion']) ? '<i class="zmdi zmdi-check-all zmdi-hc-2x green"></i>' : '<i class="zmdi zmdi-check zmdi-hc-2x black"></i>';
                                          ?>
                                        </td>
                                        <td>
                                          <?php
                                            if ($dataClientes['notificacion'] == 1) {
                                              echo $dataClientes['dt_fecha']; 
                                            }else{
                                              echo "0000-00-00 00:00:00";
                                            }
                                          ?>
                                        </td>
                                        <td>
                                          <a href="../controller/eliminar_vacante_correo.php?vac=<?php echo $dataClientes['id']; ?>" class="colora">
                                            <button type="button" class="btn btn-warning" style="margin-top:10px;">
                                              <i class='glyphicon glyphicon-pencil'></i> Eliminar
                                            </button>
                                          </a>
                                        </td>
                                      </tr>
                                    <?php $i++; } ?>
                                  </tbody>
                              </table>
                            </div>
                        </form>
                      </div>
                      <!-- cierra la vista de candidatos -->
                      <div class="col-md-6 col-md-offset-3">
                        <div class="form-group"><br><br>
                          <input type="hidden" name="id" value="<?php echo $id; ?>" />    
                            <!-- <button type="submit" class="btn btn-block btn-primary btn-lg">Guardar</button><br><br> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </section>
          </main>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    
    <div class="float-right d-none d-sm-inline-block">
      Panel de Administrador <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../dist/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="../plugins/chart.js/Chart.js"></script>
<!-- Tablas chartJs -->
<script src="../data-dashboard.js"></script>

<script type="text/javascript" src="../../plugins/calendar/js/bootstrap-datepicker.min.js"></script>
<!-- <script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script> -->

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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<script src="../js/script.js"></script>
<!-- <script  src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
</body>
</html>
