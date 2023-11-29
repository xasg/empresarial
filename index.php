<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>empresarial</title> 
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrapindex.css" rel="stylesheet">
  <!-- <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">-->
  <!-- Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/creative.css" rel="stylesheet">
  <link href="css/styleindex.css" rel="stylesheet">
  <!-- <link href="css/styleindex.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>
    jQuery(document).ready(function( $ ) {
      $('.counter').counterUp({
        delay: 10,
        time: 1000
      });
    });
  </script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113369683-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-113369683-1');
  </script>

<script language="JavaScript"> 
        function conMayusculas(field) 
        { 
            field.value = field.value.toUpperCase() 
        }   
</script>

<script>
        function abrirWhatsApp() {
            // Reemplaza "xxxxxxxxxxxxx" con el número de teléfono de destino
            var numeroTelefono = "5551012306";
            
            // Crea el enlace para abrir WhatsApp con el número de teléfono
            var url = "https://api.whatsapp.com/send?phone=" + numeroTelefono;

            // Abre una nueva ventana o pestaña con el enlace de WhatsApp
            window.open(url);
        }
    </script>

<style>
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 45px;

            z-index: 9999;
            background-color: green;
            color: white;
            padding: 12px;
            border-radius: 40%;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0px 0px 4px #000;
        }
    </style>



</head>

<body>
  <header class="masthead text-center text-white d-flex">
    <div class="container-fluid my-auto">
      <div class="row">
        <div class="col-md-12">
          <h3 class="caption">Aprovecha los beneficios que tenemos para tu empresa</h3>
        </div>
        <div class="col-md-12">
          <h1><strong>Mejor capital humano y más productividad</strong></h1>
        </div>
        <div class="col-md-12">
          <p>Identificamos, gestionamos y desarrollamos el mejor talento universitario para las empresas.</p><br><br>
          <div class="col-md-4 col-md-offset-2">
            <a class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal"><br>Eres empresa ingresa aquí<br><br></a>
          </div>
          <div class="col-md-4">
            <a class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal2"><br>Eres beneficiario Ingresa aquí<br><br></a>
          </div>
        </div>
        
      </div>      
    </div>
    
    
  </header>
  
  <div class="whatsapp-button" onclick="abrirWhatsApp()">  <!--------BOTON DE WHATSAPP------------->
        <i class="fab fa-whatsapp"></i>
    </div>

    
  <!-- Modal  Competencias-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="text-center">SÚMATE A NUESTRAS EMPRESAS</h1>
        </div>
        <div class="modal-body">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Regístrar</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Inicia sesión</a>
         </li>
       </ul>
       <br><br>
       <div class="tab-content">
      <!-- Registro Empresa -->
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">            
          <div class="col-xs-12 col-sm-12 col-md-12" >
            <div class="col-xs-12 col-sm-12 col-md-12"> 
             <form action="controller/new_empresa.php" method="POST" id="myform"> 
              <div class="input-group input-group-lg">
                <span class="input-group-addon">
                 <span class="glyphicon glyphicon-tower"></span>
               </span>
               <input type="text" name="nombre" onChange="conMayusculas(this)" class="form-control" placeholder="Nombre Fiscal o razón social" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" title="Proporcione un nombre correcto" required="">
             </div>                              

             <br><br>
             <div class="input-group input-group-lg">
               <span class="input-group-addon">
                 <span class="glyphicon glyphicon-envelope"></span>
               </span>
               <input type="email" name="correo" onChange="conMayusculas(this)" class="form-control" placeholder="Correo electronico" required="">
             </div>
             <br><br>
             <div class="input-group input-group-lg">
               <span class="input-group-addon">
                 <span class="glyphicon glyphicon-lock"></span>
               </span>
               <input type="password" name="password" class="form-control" placeholder="Contraseña" pattern="[A-Za-z0-9!?-]{6,10}" required>
             </div>
             <br><br> 
             <div class="input-group input-group-lg">
               <span class="input-group-addon">
                 <span class="glyphicon glyphicon-lock"></span>
               </span>
               <input type="password" name="password2" class="form-control" placeholder="Repetir Contraseña" pattern="[A-Za-z0-9!?-]{6,10}" required>
             </div>
             <br><br>
             <p>La contraseña debe tener minimo 6 y maximo 10 caracteres</p>
             <br><br> 
             <button type="submit" class="btn btn-default btn-lg btn-block" style="background-color:#622c5e; color: #fff">Registrar</button>
          </form>   
           <br><br>
         </div>
       </div> 
     </div>
<!-- /Registro Empresa -->

<!-- login Empresa -->
     <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
       <p>
         <form action="controller/login_empresa.php" method="POST">
          <div class="input-group input-group-lg">
           <span class="input-group-addon">
             <span class="glyphicon glyphicon-envelope"></span>
           </span>
           <input type="email" name="correo" class="form-control" onChange="conMayusculas(this)" placeholder="Correo empresa" required>
         </div>
         <br><br>
         <div class="input-group input-group-lg">
           <span class="input-group-addon">
             <span class="glyphicon glyphicon-lock"></span>
           </span>
           <input type="password" name="password" class="form-control" placeholder="Contraseña" required>                                       
         </div>
         <br><br>
         <button type="submit" class="btn btn-default btn-lg btn-block" style="background-color:#622c5e; color: #fff">Ingresar</button>
       </form>
     </p>
   </div>
<!--  /login Empresa-->
   <div class="modal-footer"></div>
 </div>
</div>
</div>
</div>
</div>
<!-- Modal  Competencias-->
<div class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="text-center">SÚMATE </h1>
      </div>
      <div class="modal-body">
       <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Regístrar</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Inicia sesión</a>
       </li>
     </ul>
     <br><br>



     <div class="tab-content">
      <!-- Registro beneficiario -->
      <div class="tab-pane active" id="home2" role="tabpanel" aria-labelledby="home-tab">            
        <div class="col-xs-12 col-sm-12 col-md-12" >
          <div class="col-xs-12 col-sm-12 col-md-12"> 
           <form action="controller/new_beneficiario.php" method="POST"> 
            <div class="col-xs-4 col-sm-4 col-md-4"> 
              <div class="input-group input-group-lg">
                <span class="input-group-addon">
                 <span class="glyphicon glyphicon-user"></span>
               </span>
               <input type="text" name="nombre" onChange="conMayusculas(this)" class="form-control" placeholder="Nombre(s)" pattern="[A-Za-z ]{1,30}" title="Proporcione un nombre correcto" required="">
             </div>
           </div>

           <div class="col-xs-4 col-sm-4 col-md-4"> 
            <div class="input-group input-group-lg">
              <span class="input-group-addon">
               <span class="glyphicon glyphicon-step-forward"></span>
             </span>
             <input type="text" name="apaterno" onChange="conMayusculas(this)" class="form-control" placeholder="Apellido Paterno" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ]{1,30}" title="Proporcione un Apellido correcto" required="">
           </div>
         </div> 

         <div class="col-xs-4 col-sm-4 col-md-4"> 
          <div class="input-group input-group-lg">
            <span class="input-group-addon">
             <span class="glyphicon glyphicon-step-forward"></span>
           </span>
           <input type="text" name="amaterno" onChange="conMayusculas(this)" class="form-control" placeholder="Apellido Materno" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,30}" title="Proporcione un Apellido correcto" required="">
         </div>
       </div> 

       <div class="col-xs-12 col-sm-12 col-md-12"> <br>
        <div class="input-group input-group-lg">
         <span class="input-group-addon">
           <span class="glyphicon glyphicon-envelope"></span>
         </span>
         <input type="email" name="correo" onChange="conMayusculas(this)" class="form-control" placeholder="Correo electronico" required="">
       </div>
     </div>
     <div class="col-xs-12 col-sm-12 col-md-12"> <br>
      <div class="input-group input-group-lg">
       <span class="input-group-addon">
         <span class="glyphicon glyphicon-lock"></span>
       </span>
       <input type="password" name="password" class="form-control" placeholder="Contraseña" pattern="[A-Za-z0-9!?-]{6,10}" required>
     </div>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-12"> <br>
    <p>La contraseña debe tener minimo 6 y maximo 10 caracteres</p>
   <br><br> 

<!--
    <div class="input-group input-group-lg">
     <span class="input-group-addon">
       <span class="glyphicon glyphicon-lock"></span>
     </span>
     <input type="password" name="password2" class="form-control" placeholder="Repetir Contraseña" required>
   </div><br>
-->



 </div>
 <button type="submit" class="btn btn-default btn-lg btn-block" style="background-color:#622c5e; color: #fff">Registrar</button>
</form>   
<br><br>
</div>
</div> 
</div>
<!-- /Registro beneficiario -->



<!--login beneficiario  -->
<div class="tab-pane" id="profile2" role="tabpanel" aria-labelledby="profile-tab">
 <p>
   <form action="controller/login.php" method="POST">
    <div class="input-group input-group-lg">
     <span class="input-group-addon">
       <span class="glyphicon glyphicon-envelope"></span>
     </span>
     <input type="email" name="correo" class="form-control" onChange="conMayusculas(this)" placeholder="Correo beneficiario" required>
   </div>
   <br><br>
   <div class="input-group input-group-lg">
     <span class="input-group-addon">
       <span class="glyphicon glyphicon-lock"></span>
     </span>
     <input type="password" name="password" class="form-control" placeholder="Contraseña" required>                                       
   </div>
   <br><br>
   <button type="submit" class="btn btn-default btn-lg btn-block" style="background-color:#622c5e; color: #fff">Ingresar</button>
 </form>
</p>
</div>
<!--login beneficiario  -->


<div class="modal-footer"></div>
</div>
</div>
</div>
</div>
</div>
<section id="services">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="section-heading">SÚMATE A NUESTRAS HISTORIAS DE ÉXITO</h1>
        <hr class="my-4">            
      </div>
    </div>

    <div class="row"> 
      <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
        <div class="service-box mt-5 mx-auto"><a href="https://colaboradora.fese.mx/registro/" target="_blank">
         <img src="img/icons/paso1.png" class="">
         <p><strong>1.- ¡Registrate y publica tu vacante!</strong></p></a>
       </div>
     </div>

     <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
      <div class="service-box mt-5 mx-auto">
        <img src="img/icons/paso2.png" class="">
        <p><strong>2.- Recibe propuestas y selecciona tus candidatos.</strong></p>
      </div>
    </div>  


    <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
      <div class="service-box mt-5 mx-auto">
        <img src="img/icons/paso3.png" class="">
        <p><strong>3.- Realiza tu donativo y obtén un comprobante 100% deducible.</strong></p>
      </div>
    </div>


    <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
      <div class="service-box mt-5 mx-auto">
        <img src="img/icons/paso4.png" class="">
        <p><strong>4.- FESE gestiona y da acompañamiento a las prácticas.</strong></p>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-12 text-center">
      <p class="par"><br><br><br>Trabajamos con empresas y universidades brindándoles nuestro acompañamiento para su desarrollo profesional.</p><br><br>
    </div>
  </div>

  <div class="row"> 

    <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
      <div class="service-box mt-5 mx-auto">
       <img src="img/icons/1.png" class="">
       <h3 class="counter tipo">1,272</h3>
       <p><strong>Empresas</strong></p>
     </div>
   </div>


   <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
    <div class="service-box mt-5 mx-auto">
      <img src="img/icons/2.png" class="">
      <h3 class="counter tipo">3,639</h3>
      <p><strong>Beneficiarios</strong></p>
    </div>
  </div>  


  <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
    <div class="service-box mt-5 mx-auto">
      <img src="img/icons/3.png" class="">
      <h3 class="counter tipo">150</h3>
      <p><strong>Universidades</strong></p>
    </div>
  </div>


  <div class="col-xs-6 col-sm-6 col-lg-3 col-md-3 text-center">
    <div class="service-box mt-5 mx-auto">
      <img src="img/icons/4.png" class="">
      <h3 class="counter tipo">2,908</h3>
      <p><strong>Capacitaciones</strong></p>
    </div>
  </div>
</div>
</div>
</section>



<!-- 
<section class="bg-dark text-white">
  <div class="container text-center">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="section-heading">TESTIMONIALES</h1>
        <hr class="my-4"><br><br>
      </div>
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <div id="random_number1" class="carousel slide youtube-carousel"  data-ride="carousel" data-interval="false">
          <div class="carousel-inner">
            <div class="video-container item active">
              <div class="youtube-video" id='E1-o_EO9LE0'></div>
              <div class="carousel-caption">Beneficios FESE para las empresas</div>
            </div> -->
		  <!--
          <div class="video-container item">
            <div class="youtube-video" id='HBRpB6Xd8QU'></div>
            <div class="carousel-caption">Universidad Autónoma de Baja California</div>
          </div>
          <div class="video-container item ">
            <div class="youtube-video" id='jPKyja3JxmA'></div>
            <div class="carousel-caption">Instituto tecnológico de zitácuaro</div>
          </div>
        -->
      <!-- </div>
      <div class="controls">
        <a class="left carousel-control" href="#random_number1" data-slide="prev">
         <i class="fa fa-angle-left fa-3x" ></i>
       </a>
       <a class="right carousel-control" href="#random_number1" data-slide="next"> 
        <i class="fa fa-angle-right fa-3x"></i>
      </a>
    </div>
  </div>
</div>
</div>       
</div>
</section> -->





<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h1 class="section-heading">EMPRESAS QUE HAN CONFIADO EN NOSOTROS</h1>
        <hr class="my-4">
      </div>

      <!-- gallery item -->
      <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="item-img link">
          <a href="http://cemsa.com.mx/v2/ini/index.php" target="_blank">
            <img src="img/portfolio/cemsa.png" alt="image" class="img-responsive">                 
          </a>
        </div>
      </div>

      <!-- gallery item -->
      <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="item-img link">
          <a href="http://claugto.org/" target="_blank">
            <img src="img/portfolio/claugto.png" alt="image" class="img-responsive">
                  <!--<div class="item-img-overlay">
                    <div class="overlay-info v-middle text-center">
                      <h6 class="sm-title">Design . Motion</h6>
                      <h5>Crearive Design</h5>
                    </div>
                  </div>-->
                </a>
              </div>
            </div>


            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="http://www.desarrollo-sustentable.com.mx/" target="_blank">
                  <img src="img/portfolio/desarrollo_sustentable.png" alt="image" class="img-responsive">
                  <!--<div class="item-img-overlay">
                    <div class="overlay-info v-middle text-center">
                      <h6 class="sm-title">Design . Motion</h6>
                      <h5>Crearive Design</h5>
                    </div>
                  </div>-->
                </a>
              </div>
            </div>



            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="http://www.lear.com/" target="_blank">
                  <img src="img/portfolio/eika.png" alt="image" class="img-responsive">                 
                </a>
              </div>
            </div>

            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="https://www.mondragon-corporation.com/empresa/eika-mexico/" target="_blank">
                  <img src="img/portfolio/gaspasa.png" alt="image" class="img-responsive">
                  <!--<div class="item-img-overlay">
                    <div class="overlay-info v-middle text-center">
                      <h6 class="sm-title">Design . Motion</h6>
                      <h5>Crearive Design</h5>
                    </div>
                  </div>-->
                </a>
              </div>
            </div>


            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="http://helicom.mx/" target="_blank">
                  <img src="img/portfolio/helicom.png" alt="image" class="img-responsive">
                  <!--<div class="item-img-overlay">
                    <div class="overlay-info v-middle text-center">
                      <h6 class="sm-title">Design . Motion</h6>
                      <h5>Crearive Design</h5>
                    </div>
                  </div>-->
                </a>
              </div>
            </div>




            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="http://www.novaceramic.com.mx/" target="_blank">
                  <img src="img/portfolio/novaceramic.png" alt="image" class="img-responsive">                 
                </a>
              </div>
            </div>

            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="http://www.samsung.com/mx/home-appliances/" target="_blank">
                  <img src="img/portfolio/samsung.png" alt="image" class="img-responsive">
                  <!--<div class="item-img-overlay">
                    <div class="overlay-info v-middle text-center">
                      <h6 class="sm-title">Design . Motion</h6>
                      <h5>Crearive Design</h5>
                    </div>
                  </div>-->
                </a>
              </div>
            </div>


            <!-- gallery item -->
            <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="item-img link">
                <a href="http://www.lear.com/" target="_blank">
                  <img src="img/portfolio/lear.png" alt="image" class="img-responsive">
                  <!--<div class="item-img-overlay">
                    <div class="overlay-info v-middle text-center">
                      <h6 class="sm-title">Design . Motion</h6>
                      <h5>Crearive Design</h5>
                    </div>
                  </div>-->
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>









      <section class="bg-dark text-white">
        <div class="container">
          <div class="row">



            <div class="col-md-6">

              <div class="col-xs-6 col-sm-6 col-md-6">
                <img src="img/logo.png" alt="" class="img-responsive">
              </div>  

              <div class="col-xs-6 col-sm-6 col-md-6">
                <img src="img/esr01.png" alt="" class="img-responsive"><br><br>
              </div>            




              <h4><br><strong>LIC. ANDREI RAMIREZ</strong></h4>
              <P></P>
              
              <h5>
                <a href="mailto:empresarial@fese.org.mx" class="btn-contact" target="_blank">  
                  <span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp; empresarial@fese.org.mx
                </a>
              </h5>
              <!--<h5><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;&nbsp;(55) 4626 8266 ext. 8264</h5>-->
              
              <h5>
                <a href="https://www.google.com.mx/maps/place/Fundaci%C3%B3n+Educaci%C3%B3n+Superior+Empresa/@19.3734491,-99.1622087,17z/data=!3m1!4b1!4m6!3m5!1s0x85d1ffa52c4affa9:0xe7505e0e613e278a!8m2!3d19.3734441!4d-99.1596338!16s%2Fg%2F11b6j9fyp5" class="btn-contact" target="_blank">
                  <span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;Tenayuca 200, Santa Cruz Atoyac,Benito Juárez, 03310, <br>&nbsp;&nbsp;&nbsp;&nbsp; México D.F.
                </a>  
              </h5>



              <div class="col-sm-12 col-md-12 "> <br>               
                <div class="col-xs-3 col-sm-3 col-md-2">
                  <a class="facebook" href="https://www.facebook.com/FESE.MX/" target="_blank"><img src="img/fb.png" class="img-responsive"></a>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-2">
                  <a class="twitter" href="https://twitter.com/fese_mx/" target="_blank"><img src="img/twitter.png" class="img-responsive"></a>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-2">
                  <a class="pinterest" href="https://www.youtube.com/channel/UCozpLDFZa5sK3pvszgYerxA" target="_blank"><img src="img/youtube.png" class="img-responsive"></a>
                </div>
                <div class=" col-xs-3 col-sm-3 col-md-2">
                 <a class="linkedin" href="https://www.linkedin.com/company/fundacion-educacion-superior-empresa" target="_blank"><img src="img/linkedin.png" class="img-responsive"></a>
               </div>
             </div>

           </div>

           <div class="col-xs-12 col-sm-12 col-md-6"> 
            <h4><strong><br>SÚMATE A NUESTRAS EMPRESAS</strong></h4>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <form action="#" method="POST">
                <div class="form-group">
                  <h5><label class="control-label">Nombre *</label></h5>
                  <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre completo" required>
                </div>
                <div class="form-group">
                  <h5><label class="control-label">Correo *</label></h5>
                  <input type="text" class="form-control" name="correo" placeholder="Escribe tu correo" required>
                </div>
                <div class="form-group">
                  <h5><label  class="control-label">Teléfono</label></h5>
                  <input type="text" class="form-control" name="telefono" placeholder="Número de teléfono a 10 dígitos" >

                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-default btn-lg btn-block">Ingresar</button>
                </div>
              </form>
            </div>
          </div> 
        </div>       
      </div>
    </section>

      <footer>
          <h5 class="text-center bg-dark text-white" style=" height: 60px; padding-top:15px;">
            Todos los derechos reservados - FESE 2023
          </h5>
      </footer>
    <script src="js/pas.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/creative.min.js"></script>

    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.js"></script>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script  src="js/index.js"></script>

  </body>

  </html>
