<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Real Parking - Registro</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

    <script>
        // Array con las rutas de las imágenes de fondo
        const backgrounds = [
          "{{ asset('imagenes/log_img_1.gif') }}",
          "{{ asset('imagenes/log_img_4.jpeg') }}",
          "{{ asset('imagenes/log_img_1.gif') }}",
          "{{ asset('imagenes/log_img_4.jpeg') }}",
        ];
      
        let currentBackgroundIndex = 0;
      
        // Función para cambiar el fondo
        function changeBackground() {
          document.body.style.backgroundImage = `url('${backgrounds[currentBackgroundIndex]}')`;
          currentBackgroundIndex = (currentBackgroundIndex + 1) % backgrounds.length; // Incrementar el índice y reiniciar cuando llegue al final
        }
      
        // Cambiar la imagen de fondo cada 10 segundos
        setInterval(changeBackground, 10000); // 10000 milisegundos = 10 segundos
      
        // Llamar inmediatamente la función para mostrar la primera imagen
        changeBackground();
    </script>
    
<section class="h-100 gradient-form" style="background-image: url('../imagenes/Metropolis_Madrid.png')">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <!-- Left Section with the Registration Form -->
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="{{ asset('imagenes/logoReal.png') }}" style="width: 185px;" alt="logo">
                  <hr>
                  <h4 class="text-center text-dark mt-4 mb-5 pb-1 font-weight-bold">Regístrate en el Sistema de Parqueo</h4>
                </div>

                <form action="{{ route('register') }}" method="POST">
                  @csrf
                  <p>Por favor, rellene los datos para crear una cuenta</p>

                  <!-- Name -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="name">Nombre del Usuario</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus placeholder="Nombre">
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <!-- Email -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">Correo</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Correo electrónico">
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <!-- Password -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Contraseña">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>

                  <!-- Confirm Password -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="password_confirmation">Repetir Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Repetir Contraseña">
                  </div>

                  <!-- Register Button -->
                  <div class="row mb-0">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Registrar') }}
                      </button>
                    </div>
                  </div>

                  <!-- Login Link -->
                  <hr>
                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">¿Ya tienes una cuenta?</p>
                    <hr>
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Iniciar sesión</a>
                  </div>

                </form>
              </div>
            </div>

            <!-- Right Section with Image and Text -->
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <div class="text-center">
                  <img src="{{ asset('imagenes/Layo.jpg') }}" style="width: 300px;" alt="logo">
                  <hr>
                </div>
                <h4 class="mb-4">Somos más que una empresa</h4>
                <p class="small mb-0">
                  En Real Plaza contamos con una cultura única llamada Japi 💜, alineada a nuestro propósito de felicidad y que representa nuestra esencia poniendo al centro de cada acción a nuestros(as) colaboradores(as).
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
