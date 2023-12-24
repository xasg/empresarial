<?php
  // Desactivar toda notificación de error
  session_start();
  error_reporting(0);
   require_once('../model/database_admin.php');
   mysqli_set_charset( $mysqli, 'utf8');
   if(isset($_SESSION['tp_user']) == 3){  
   $id=$_SESSION["id"];   
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
  <title>AdminLTE 3 | Dashboard 3</title>

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
  </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Inicio</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <!-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a> -->
        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> -->
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <!-- <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          </a>
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          </a>
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          </a>
          <!-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a> -->
        <!-- </div> -->
      </li>
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
          <a href="../controller/logout.php" class="dropdown-item">
          <i class="fa fa-sign-out" aria-hidden="true"></i>Salir 
          </a>
          
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-black elevation-4" style="min-height:100vh; position:fixed;" >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <img src="../../img/empresarial.png" alt="FESE" class="brand-image elevation-5" style="opacity: .8">
      <span class="brand-text font-weight-light">.</span>
    </a>

    <!-- Sidebar -->
    <!-- <div class="sidebar" style="background:#57007B;"> -->
    <!-- <div class="sidebar" style="background:#791a78;"> -->
    <!-- <div class="sidebar" style="background:#410541;"> -->
    <div class="sidebar" style="background:#410541; " >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../img/logo.png" class="elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-white">Panel de Administrador</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="min-height:160vh">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
          <!-- Empresas -->
          <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fa fa-building "></i>
              <p>
                Empresas
                
                <span class="right badge badge-danger"><?php echo $empN;?></span>
              </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="#" class="nav-link">
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
               // Empresas con vacantes
               $empresasConVacantes = count_empresas_vac_actuales();
               $empresaVacante = $empresasConVacantes['registros'];
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Vacantes
                <i class="fas fa-angle-left right"></i>
                
                <span class="badge badge-info right">2</span>
                <?php
                // Solo va a mostrar este danger count cuando hay empresas nuevas o sin validar
                  if ($empresaVacante > 0) {
                ?>
                <span class="badge badge badge-danger"><?php echo $empresaVacante;?></span>
                <?php
                  # code...
                  }
                ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vacantes.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Registrar Vacante
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="vacantes_actuales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Ver vacantes
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="invitados.php" class="nav-link">
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
            <h1 class="m-0">Dashboard v3</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">Dashboard v3</li>
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
        
          <?php
            if ($empN > 0) {
          ?>
          <div class="col-lg-3 col-6" >
            <!-- small box -->
            <div class="small-box " style="border-radius: 22px; box-shadow:0 1px 10px #7a167a; border: 2px solid #7a167a !important; color:#7a167a;">
              <h2 class="text-center" style="font-size:25px;"> <b>Empresas por validar</b></h2>
              <div class="inner">
                <h3 class="text-center"><?= $empN;?></h3>
                <!-- <h3 class="text-center"><?= $empN;?> <small><span class="right badge badge-danger" style="font-size:15px;">New</span></small></h3> -->

                <p>Empresas que ya se validaron <b><?= $empV;?></b> </p>
                <p>Empresas que se dieron de baja <b><?= $empB;?></b></p>
              </div>
              <div class="icon">
                <i class="fa fa-building" aria-hidden="true"><sub><small><i class="fa fa-check-circle" aria-hidden="true"></i></small></sub></i>
                <!-- <i class="ion ion-bag"></i> -->
              </div>
              <a href="empresas_nuevas_pendientes.php" class="small-box-footer shadow" style="background:#7a167a; border-radius: 20px; height:50px; font-size:25px ">Validar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php            
            }
          ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="border-radius: 22px; box-shadow:0 1px 10px #7a167a; border: 2px solid #7a167a !important; color:#7a167a;">
              <div class="inner">
                <h2 class="text-center" style="font-size:25px;"> <b> Apoyos Vacantes <?= date("Y"); ?></b></h2>
                <h3 > $ <?= number_format(round($apoyoVacAct), 2, '.', ',')  ; ?> </h3>
                <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->

                <p>Apoyos año anterior: $<b><?= number_format(round($apoyoVacAnt), 2, '.', ',') ; ?> </b></p>
                <p>Total desde 2019: $<b><?= number_format(round($apoyoVac), 2, '.', ',') ; ?> </b></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="vacantes_actuales.php" class="small-box-footer shadow" style="background:#7a167a; border-radius: 20px; height:50px; font-size:25px ">Ver vacantes <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box " style="border-radius: 22px; box-shadow:0 1px 10px #7a167a; border: 2px solid #7a167a !important; color:#7a167a;">
              <div class="inner">
                <h2 class="text-center" style="font-size:25px;"> <b> Beneficiarios <?= date("Y"); ?></b></h2>
                <h3 class="text-center"><?php echo $beneficiarioA;?></h3>

                <p>Candidatos registrados <?= date("Y"); ?> : <b><?php echo $beneficiarioTotalA;?></b></p>
                <p>Beneficiarios validados <?= date("Y") - 1; ?>  : <b><?php echo $beneficiarioT;?></b></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
                <i class="fa fa-address-book-o" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer shadow" style="background:#7a167a; border-radius: 20px; height:50px; font-size:25px ">Ver beneficiarios<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6" >
            <!-- small box -->
            <div class="small-box " style="border-radius: 22px; box-shadow:0 1px 10px #7a167a; border: 2px solid #7a167a !important; color:#7a167a;">
              <div class="inner">
              <h2 class="text-center" style="font-size:25px;"> <b> Invitaciones <?= date("Y"); ?></b></h2>
                <h3 class="text-center"><?php echo $invitacion;?></h3>  
                
                <p>Candidatos para invitar  : <b><?php echo $invitacionP;?></b></p>
                <p>Candidatos Invitados que se registraron  : <b><?php echo $invitacionR; ?></b></p>  

                <p></p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-pie-graph"></i> -->
                <i class="fa fa-address-book" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer shadow" style="background:#7a167a; border-radius: 20px; height:50px; font-size:25px ">Invitaciones <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Numeralia empresas candidatos -->
          <div class="col-lg-6">
            <div class="card border shadow tablas-estilos" >
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Reporte Anual de Candidatos/Beneficiarios</h3>
                  <!-- <a class="text-white" href="javascript:void(0);">Descargar Reporte</a> -->
                  <a href="#" class="btn btn-sm btn-tool" title="Descargar Reporte">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                  <span> <span class="text-bold text-lg"><?= $conteoCan;?></span> Candidatos/Beneficiarios registrados en la base de datos</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                  <?php
                        // Se calcula el porcentaje conforme al año anterior
                        $calculoCandidatos = ($conteoActCan/$conteoAntCan) * 100;
                        $porcentajeCandidatos = round($calculoCandidatos,PHP_ROUND_HALF_DOWN) - 100;
                      if ($porcentajeCandidatos > 0) {
                    ?>
                    <span class="text-success">
                      <i class="fas fa-arrow-up"> <?php echo "%".$porcentajeCandidatos;?></i>
                      <span class="text-muted" >Mayor al año anterior</span>
                    </span>
                    <?php
                      }else{
                    ?>
                    <span class="text-danger">
                      <i class="fas fa-arrow-down " > <?php echo "%".$porcentajeCandidatos; ?></i>
                    </span>
                    <span class="text-muted" >Menor al año anterior</span>
                    <?php
                      }
                    ?>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                  <i class="fas fa-square " style="background: #622c5e; color: #622c5e;"></i><i style="text-shadow:1px 0 4px #000 !important;">  Este año <span class="text-bold text-lg"><?= $conteoActCan;?></i></span>
                  </span>

                  <span>
                  <i class="fas fa-square text-gray"></i> <i style="text-shadow:1px 0 4px #000 !important;"> Año anterior <span class="text-bold text-lg"><?= $conteoAntCan;?> </i></span>
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <div class="card shadow tablas-estilos-datos">
              <div class="card-header border-1">
                <h3 class="card-title">Vacantes Registradas este mes</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool" title="Descargar Reporte">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                    <th>Empresa</th>
                    <th>Nombre de la vacante</th>
                    <th>Apoyo</th>
                    <th>#Vac</th>
                    <th>Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $validaVacantes = valida_vacante();
                  if (mysqli_num_rows($validaVacantes) > 0) {
                    foreach ($validaVacantes as $validaVacante) {
                  ?>
                      <tr>
                        <td>
                          <img src="../dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                          <?php echo $validaVacante['dt_nombre_comercial']; ?>
                        </td>
                        <td style="width:190px;"><?php echo $validaVacante['dt_nombre']; ?></td>
                        <!-- Agrega aquí los demás campos de validaVacante que necesites mostrar -->
                        <td>
                          <p>
                            <?php echo "$" . number_format($validaVacante['dt_apoyo'], 2, '.', ','); ?>
                          </p>
                        </td>
                        <td>
                          <?php
                          echo "#" . $validaVacante['dt_numero'];
                          ?>
                        </td>
                        <td>
                          <a href="#" class="text-muted">
                            <i class="fas fa-search"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="5"><h3>Sin registros nuevos</h3></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
          
          <!-- /.col-md-6 --> 
          <!-- REPORTES DE EMPRESAS  -->
          <div class="col-lg-6">
            <div class="card border shadow tablas-estilos" >
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Reporte anual de Empresas</h3>
                  <!-- <a href="javascript:void(0);">View Report</a> -->
                  <a href="#" class="btn btn-sm btn-tool" title="Descargar Reporte">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    
                    <span> <span class="text-bold text-lg"><?= $conteo;?></span> Empresas registradas en la base de datos</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">

                    <?php
                        // Se calcula el porcentaje conforme al año anterior
                        $calculo = ($conteoAct/$conteoAnt) * 100;
                        $porcentaje = round($calculo,PHP_ROUND_HALF_DOWN) - 100;
                      if ($porcentaje > 0) {
                    ?>
                    <span class="text-success">
                      <i class="fas fa-arrow-up"> <?php echo "%".$porcentaje;?></i>
                      <span class="text-muted"  >Mayor al año anterior</span>
                    </span>
                    <?php
                      }else{
                    ?>
                    <span class="text-danger">
                      <i class="fas fa-arrow-down" > <?php echo "%".$porcentaje; ?></i>
                    </span>
                    <span class="text-muted">Menor al año anterior</span>
                    <?php
                      }
                    ?>
                    
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>
                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square" style="background: #622c5e; color: #622c5e;"></i> <i style="text-shadow:1px 0 4px #000 !important;"> Este año <span class="text-bold text-lg"><?= $conteoAct;?> </i></span>
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> <i style="text-shadow:1px 0 4px #000 !important;"> Año anterior <span class="text-bold text-lg"><?= $conteoAnt;?></i></span>
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->
            
              <?php 
                     

                          // Vacantes                    
                          $vacantesTotalesActivas = count_convocatorias_totales(); 
                          $vacanteActiva = $vacantesTotalesActivas['totales'];  
                          $vacantesTotalesActualesActivas = count_convocatorias_actuales(); 
                          $vacanteActualActiva = $vacantesTotalesActualesActivas['totales'];  
                          $BeneficiariosActualesTotales = count_beneficiados_totales();
                          $BeneficiariosActuales = count_beneficiados_actuales();
                          $BeneficiariosAnterior = count_beneficiados_anterior();
                          $beneficiadoTotal = $BeneficiariosActualesTotales['totales'];
                          $beneficiadoActual = $BeneficiariosActuales['totales'];
                          $beneficiadoAnterior = $BeneficiariosAnterior['totales'];
              ?>      
            <div class="card shadow tablas-estilos-datos" >
              <div class="card-header border-1">
                <h3 class="card-title">Descripción general Global</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-sm btn-tool" title="Descargar Reporte">
                    <i class="fas fa-download"></i>
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-success text-xl">
                    <i class="ion ion-ios-people-outline"></i> <small style="font-size:18px;"> Empresas con convocatorias</small>                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <!-- <i class="ion ion-android-arrow-up text-success"></i> 12% -->
                    </span>
                    <span class="text-muted">Empresas Con convocatorias 2023 : <b><?php echo $empresaVacante; ?></b> </span>
                    <span class="text-muted">Vacantes activas <?php echo date('Y');?> : <b><?php echo $vacanteActualActiva; ?></b> </span>
                    <span class="text-muted">Vacantes abiertas Totales : <b><?php echo $vacanteActiva; ?></b></span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                  <p class="text-warning text-xl">
                    <i class="ion ion-ios-people-outline"></i> <small style="font-size:18px;"> Candidatos beneficiados</small>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <!-- <i class="ion ion-android-arrow-up text-warning"></i> 0.8% -->
                    </span>
                    <span class="text-muted">Beneficiarios <?php echo date("Y");?> <b><?php echo $beneficiadoActual;?></b></span>
                    <span class="text-muted">Beneficiarios <?php echo date("Y")-1;?> <b><?php echo $beneficiadoAnterior;?></b></span>
                    <span class="text-muted">Beneficiarios totales<b><?php echo $beneficiadoTotal;?></b></span>
                    <!-- <span class="text-muted">Beneficiarios</span> -->
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="d-flex justify-content-between align-items-center mb-0">
                  <p class="text-danger text-xl">
                  <i class="ion ion-ios-refresh-empty"></i>
                     <small style="font-size:18px;"> Empresas que siguen este año</small>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="font-weight-bold">
                      <!-- <i class="ion ion-android-arrow-down text-danger"></i> 1% -->
                    </span>
                    <span class="text-muted">
                      <b>
                        <?php echo $empV; ?>
                      </b> Empresas siguen con nosotros
                    </span>
                  </p>
                </div>
                <!-- /.d-flex -->
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
                          <!-- Donut chart -->
          <div class="card col-lg-6 shadow tablas-estilos"  >
            <div class="card-header">
              <div class="d-flex justify-content-between">
                 <h3 class="card-title">Vista General de apoyos registrados</h3>                
                  <!-- <a href="javascript:void(0);">View Report</a> -->
                  <a href="#" class="btn btn-sm btn-tool" title="Descargar Reporte">
                    <i class="fas fa-download"></i>
                  </a>
              </div>
                
            </div>
           <div class="row">
           <div class="card-body col-sm-12 col-lg-7 m-auto  ">
              <select id="dataSelector" class="col-md-6" style="border-radius:22px; border:1px solid #622c5e; cursor:pointer; ">
                <option value="all">General</option>
                <option value="apoyoVacAnt">Apoyo Vac Anterior</option>
                <option value="apoyoVacAct">Apoyo Vac Actual</option>
                <!-- Agrega opciones adicionales según tus necesidades -->
              </select>
                <canvas id="barChartApoyo" style=" height: 250px; max-height: 350px; max-width: 100%; width:500px; margin:auto;"></canvas>
            </div>
            <div class="card-body col-lg-4 ">
              <p class="ml-auto d-flex flex-column text-right">
                    <?php
                          // Se calcula el porcentaje conforme al año anterior
                          $calculoApoyos = ($apoyoVacAct/$apoyoVacAnt) * 100;
                          $porcentajeApoyos = round($calculoApoyos,PHP_ROUND_HALF_DOWN) - 100;
                        if ($porcentajeApoyos > 0) {
                      ?>
                      <span class="text-success">
                        <i class="fas fa-arrow-up"> <?php echo "%".$porcentajeApoyos;?></i>
                        <span class="text-muted" >Mayor al año anterior</span>
                      </span>
                      <?php
                        }else{
                      ?>
                      <span class="text-danger">
                        <i class="fas fa-arrow-down"> <?php echo "%".$porcentajeApoyos; ?></i>
                      </span>
                      <span class="text-muted" >Menor al año anterior</span>
                      <?php
                        }
                      ?>
              </p>
              <div class="row col-lg-12 d-flex flex-row m-auto">
                  <span class="col-md-12 m-auto text-center">
                  <i class="fas fa-square " style="background: #622c5e; color: #622c5e;"></i><i style="text-shadow:1px 0 4px #000 !important;">  Este año <span class="text-bold text-lg">$<?= number_format(round($apoyoVacAct), 2, '.', ',') ;?></i></span>
                  </span>

                  <span  class="col-md-12 m-auto text-center">
                  <i class="fas fa-square text-gray"></i> <i style="text-shadow:1px 0 4px #000 !important;"> Año anterior <span class="text-bold text-lg">$<?= number_format(round($apoyoVacAnt), 2, '.', ',');?> </i></span>
                  </span>
                </div>
            </div>
            
           </div>
              <!-- /.card-body -->
          </div>
            <script>
              var ctx = document.getElementById('barChartApoyo').getContext('2d');
              
              // Inicializamos los datos con valores iniciales
              var data = {
                labels: ["Anterior", "Actual"],
                datasets: [{
                  data: [<?=$apoyoVacAnt?>, <?=$apoyoVacAct?>],
                  backgroundColor: [
                    '#ccc',  // Color del primer segmento
                    '#622c5e', // Color del segundo segmento
                    ],
                    
                  }]
              };

              // Opciones del gráfico
              var options = {
                responsive: false,
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true,
                      callback: function(value, index, values) {
                        return '$' + value.toLocaleString();
                      }
                    }
                  }]
                },
                title: {
                  display: true,
                  text: 'Título del Gráfico',

                }
              };

              // Creamos el gráfico de barras
              var barChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
              });

              // Agregamos un evento al cambio del selector
              $('#dataSelector').on('change', function() {
                // Actualizamos los datos del gráfico
                var selectedValue = $(this).val();
                var newData = {
                  labels: ["Anterior", "Actual"],
                  datasets: [{
                    data: [<?=$apoyoVacAnt?>, <?=$apoyoVacAct?>],
                    backgroundColor: [
                      '#ccc',  // Color del primer segmento
                      '#622c5e', // Color del segundo segmento
                    ],
                  }]
                };
                
                if (selectedValue === 'apoyoVacAnt') {
                  newData.datasets[0].data = [<?=$apoyoVacAnt?>, 0];
                } else if (selectedValue === 'apoyoVacAct') {
                  newData.datasets[0].data = [0, <?=$apoyoVacAct?>];
                } else if (selectedValue === 'all') {
                  // Mostrar ambos conjuntos de datos
                  newData.datasets[0].data = [<?=$apoyoVacAnt?>, <?=$apoyoVacAct?>];
                }

                // Actualizamos el gráfico
                barChart.data = newData;
                barChart.update();
                });

            </script>
              <!-- ./Donut chart -->
            <!-- /.card-body-->
            </div>

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
      <b>Version</b> 1.1.0
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
<script src="data-dashboard.js"></script>
</body>
</html>
