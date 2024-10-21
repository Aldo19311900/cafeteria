<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', 'Landingpage')</title>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
        <div class="container-fluid">
          <div class="row w-100">
            <div class="col-3">
              <a class="navbar-brand" href="#!">
                <img src="images/logouth.png" alt="Logo" style="height: 40px;">
              </a>
            </div>
            <div class="col-1"></div>
            <div class="col-8">
              <div class="row justify-content-end">
                <div class="col">
                  <a class="nav-link" href="#intro">Inicio</a>
                </div>
                <div class="col">
                  <a class="nav-link" href="#nosotros">Nosotros</a>
                </div>
                <div class="col">
                  <a class="nav-link" href="#como-funciona">Cómo funciona</a>
                </div>
                <div class="col">
                  <a class="nav-link" href="#apps">Apps</a>
                </div>
                <div class="col">
                  <a class="nav-link" href="#contacto">Contáctanos</a>
                </div>
                <div class="col">
                  <a class="nav-link" href="landing" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Login</a>
              </div>
              <div class="col">
                <a class="nav-link" href="landing" onclick="event.preventDefault(); document.getElementById('register-form').submit();">Register</a>
            </div>
            <form id="register-form" action="{{ route('register') }}" method="POST" style="display: none;">
            @csrf
        </form>
                <div class="col">
                  <a class="nav-link" href="landing" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Login</a>
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

              </div>
            </div>
          </div>
        </div>
      </nav>

      <!-- Section: Intro -->
      <section id="intro">
        <div class="mask" style="background-color: rgba(250, 182, 162, 0.15);"></div>
        <div class="image-container">
          <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Imagen pantalla completa" src="images/inicio2.jpg">
          <div class="overlay-text">
            <h1 class="titulo">¡Cafeteria UTH, una app que sirve a nuestra universidad!</h1>
            <p class="descripcion">Una app móvil y sistema web hechos por estudiantes, donde puedes echar un vistaso a los servicios y plattillos de tu Cafeteria!.</p>
            <div id="ninth" class="buttonBox">
              <button>Mas Informacion</button>
            </div>
          </div>



        </div>
      </section>

      <!-- Section: Nosotros -->
      <div id="nosotros" class="container my-5">
        <div class="row">
          <div class="col-6 ">
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Imagen pantalla completa " src="images/segunda.jpg">
          </div>
          <div class="col-6 mt-5">
            <h1 class="nosotros-titulo mt-5">Nosotros somos</h1>
            <p class="nosotros-texto mt-5">Un grupo de estudiantes comprometidos en ofrecer una solución digital para llevar la variedad de platillos a nuestra universitaria, creando un espacio donde puedas revisar, seleccionar y ordenar productos de forma fácil y rápida.</p>
          </div>
        </div>
      </div>

      <!-- Section: Cómo Funciona -->
      <div id="como-funciona" class="container-fluid py-4 contenido-fondo">
        <div class="container">
          <div class="row text-center">
            <div class="nosotros-titulo">¿Cómo funciona?</div>
            <div class="col-4">
              <div class="row p-5">
                <img class="img-fluid custom-img" alt="Imagen pantalla completa" src="images/primera.jpg">
              </div>
              <h2 class="contenido-titulo">Ordenar</h2>
              <p class="contenido-texto">Los alumnos y personal de la UTH podrán ordenar cualquier producto disponible en la aplicación.</p>
            </div>
            <div class="col-4">
              <div class="row p-5">
                <img class="img-fluid custom-img" alt="Imagen pantalla completa" src="images/ubicasion.jpg">
              </div>
              <h2 class="contenido-titulo">Ubicación</h2>
              <p class="contenido-texto">La ubicación es en el centro de nuestro campus, bien conocido como la cafeteria UTH, para el momento de recoger tu pedido o verificar el menu personalmente si asi se decea.</p>
            </div>
            <div class="col-4">
              <div class="row p-5">
                <img class="img-fluid custom-img" alt="Imagen pantalla completa" src="images/pedido.png">
              </div>
              <h2 class="contenido-titulo">Crear un Pedido</h2>
              <p class="contenido-texto">Al momento de hacer un pedido, se revisa el menu de los platillos, bocadillo o bebidaas disponibels, pedes agrerar los articulos deceados a tu pedido para posteriormente confirmar esta orden.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Section: Apps -->
      <div id="apps" class="image-container ">
        <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Imagen pantalla completa" src="images/pedido3.jpg">
        <div class="overlay-text">
          <h1 class="titulo">App móvil y sistema web</h1>
          <p class="descripcion">Cafeteria UTH está disponible tanto como app móvil como en su versión web. Puedes gestionar tu cuenta y movimientos desde ambos, manteniendo la flexibilidad y facilidad de uso en todo momento.</p>
        </div>
      </div>

      <!-- Section: Contacto -->
      <div id="contacto" class="d-flex" style="height: 100vh; background-image: url('images/hol9.jpg'); background-size: cover; background-position: center;">




        <div class="flex-fill d-flex flex-column justify-content-center align-items-start p-4" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 10px;">
          <h2 class="text-orange">¿Necesitas más información?</h2>
          <p>Puedes dejar tus dudas y te ayudaremos con cualquier información que necesites.</p>
        </div>
        <div class="flex-fill d-flex justify-content-center align-items-center">
          <form style="width: 36rem; border: 2px solid #FF7F00; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(255, 127, 0, 0.5);">
            <div class="form-outline mb-4">
              <label class="form-label" for="form4Example1">Nombre</label>
              <input type="text" id="form4Example1" class="form-control" />
            </div>
            <div class="form-outline mb-4">
              <label class="form-label" for="form4Example2">Correo electrónico</label>
              <input type="email" id="form4Example2" class="form-control" />
            </div>
            <div class="form-outline mb-4">
              <label class="form-label" for="form4Example3">Mensaje</label>
              <textarea class="form-control" id="form4Example3" rows="4"></textarea>
            </div>
            <div class="form-check d-flex justify-content-center mb-4">
              <input class="form-check-input me-2" type="checkbox" value="" id="form4Example4" checked />
              <label class="form-check-label" for="form4Example4">Envíame una copia de este mensaje</label>
            </div>
            <button type="button" class="btn" style="background-color: #FF7F00; color: white;">Enviar</button>
          </form>
        </div>
      </div>

      <div class="container-fluid diseñonav">
        <div class="row">
          <div class="col-3 m-5">
            <a class="navbar-brand" href="#!">
              <img src="images/logo2.jpg" alt="Logo" style="height: 60px;">
            </a>
          </div>
          <div class="col-4"></div>
          <div class="col-2 m-3" style="color:#FFFF">
            <p>Universidad Tecnologica De Hermosillo</p>
            <p>Ingeniería Desarrollo De Software</p>
          </div>
          <div class="text-center" style="color:#FFFF">
            © 2023 Copyright: Cafeteria UTH
          </div>
        </div>
      </div>
</body>
</html>
