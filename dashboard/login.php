<!doctype html>
<html lang="en">

<head>
  <title>FESE Empresarial</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(120deg, #4f2550 10%, #57007B 30%, #8b45b4,#fafafa);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(120deg, #4f2550 10%, #57007B 30%, #8b45b4,#fafafa);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
  </style>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <section class="h-100 gradient-form" style="background-color: #eee; min-height: 100vh;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
    
                    <div class="text-center">
                      <img src="https://raw.githubusercontent.com/Katashikunomo/fempresarial/main/imgs/empresarial.png"
                        style="width: 185px;" alt="logo">
                      <br>
                    </div>
    
                    <form action="controller/login_admin.php" method="POST">
                      <p>
                        <b>Ingresa con tu correo y password</b>
                      </p>
    
                      <div class="form-outline mb-4">
                        <input type="email" id="correo" name="correo" class="form-control"
                          placeholder="Ingresa tu correo" required/>
                        <label class="form-label" for="form2Example11">Correo</label>
                      </div>
    
                      <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu password" required/>
                        <label class="form-label" for="form2Example22">Password</label>
                      </div>
                      <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" style="border-radius: 22px; border: 1px solid #4f2550; box-shadow:-1px 2px 5px #57007B;" type="submit">Iniciar sesión</button>
                        <a class="text-muted" href="#!">Recuperar password?</a>
                      </div>
    
                      <!-- <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Don't have an account?</p>
                        <button type="button" class="btn btn-outline-danger">Create new</button>
                      </div> -->
    
                    </form>
    
                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">Mejor capital humano y más productividad</h4>
                    <p class="small mb-0">Aprovecha los beneficios que tenemos para tu empresa, Identificamos, gestionamos y desarrollamos el mejor talento universitario para las empresas.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
</body>

</html>