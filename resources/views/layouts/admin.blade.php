<!DOCTYPE html>
<!--
Esta plantilla se utiliza para todos los procesos que admin requiera.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RealParking</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ secure_asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('dist/css/adminlte.min.css') }}">
    <!-- jQuery -->
    <script src="{{ secure_url('plugins/jquery/jquery.min.js') }}"></script>
    <!--Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--DataTable-->
    <link rel="stylesheet" href="{{ secure_url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ secure_url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ secure_url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #620f80;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ secure_url('/') }}" class="nav-link"><i class="bi bi-house-fill"></i> Inicio</a>
                    </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Fullscreen Button -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button"
                        aria-label="Toggle Fullscreen">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <!-- Control Sidebar Button -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"
                        aria-label="Toggle Sidebar">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>

                <!-- Logout Button -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        aria-label="Logout">
                        <i class="fas bi bi-power" style="font-size: 1.2rem;"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1e1e1e;">
            <!-- Brand Logo -->
            <a href="{{ secure_url('/') }}" class="brand-link">
                <img src="{{ secure_asset('dist/img/logoReal.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Parking</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ secure_asset('imagenes/user_icon_def.png') }}" class="img-circle elevation-2"
                            alt="User Image" style="width: 50px; height: 50px;">
                    </div>
                    <div class="info">
                        <p class="mb-0" style="font-size: 1.2em; color: #adb5bd;">{{ Auth::user()->name }}</p>
                        <p class="mb-0" style="font-size: 0.8em; color: #adb5bd;">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="#" class="nav-link active" style="background-color: #620f80;">
                                <i class="nav-icon fas"><i class="bi bi-person-fill"></i></i>
                                <p>
                                    Clientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ secure_url('/admin/clientes') }}" class="nav-link active"> 
                                        <i class="far bi-list-ul nav-icon"></i>
                                        <p>Listado de Clientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @can('usuarios.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active" style="background-color: #4b0d61;">
                                <i class="nav-icon fas"><i class="bi bi-person-gear"></i></i>
                                <p>
                                    Operadores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ secure_url('/admin/operadores') }}" class="nav-link active">
                                        <i class="far bi-list-ul nav-icon"></i>
                                        <p>Listado de Operadores</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        <li class="nav-item">
                            <a href="#" class="nav-link active" style="background-color: #3f0b51;">
                                <i class="nav-icon fas"><i class="bi bi-car-front-fill"></i></i>
                                <p>
                                    Parqueo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ secure_url('/admin/parqueos') }}" class="nav-link active">
                                        <i class="far bi bi-calendar-week-fill nav-icon"></i>
                                        <p>Mapeo de vehiculos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link active" style="background-color: #3f0b51;">
                                <i class="nav-icon fas"><i class="bi bi-credit-card-2-back-fill"></i></i>
                                <p>
                                    Pagos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ secure_url('/admin/pagos') }}" class="nav-link active">
                                        <i class="far bi-list-ul nav-icon"></i>
                                        <p>Lista de Pagos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @can('usuarios.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active" style="background-color: #360a44;">
                                <i class="nav-icon fas"><i class="bi bi-currency-dollar"></i></i>
                                <p>
                                    Tarifas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ secure_url('/admin/tarifas') }}" class="nav-link active">
                                        <i class="far bi-list-ul nav-icon"></i>
                                        <p>Lista de Tarifas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        <!-- Línea de separación -->
                        <li class="nav-item">
                            <hr style="margin: 10px 0; border: 1px solid #6c757d;">
                        </li>

                        @can('usuarios.index')
                        <li class="nav-item">
                            <a href="#" class="nav-link active" style="background-color: #4b9d08;">
                                <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i>
                                <p>Usuarios<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ secure_url('/admin/usuarios') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Cerrar seción -->
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('logout') }}" style="background-color: brown"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas"><i class="bi bi-door-closed"></i></i>
                                    <p>
                                        Cerrar Sesión
                                    </p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf</form>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>

            @if (($message = Session::get('mensaje')) && ($icono = Session::get('icono')) && ($titulo = Session::get('titulo')))
                <script>
                    Swal.fire({
                        title: "{{ $titulo }}", // Título dinámico según el resultado
                        text: "{{ $message }}",
                        icon: "{{ $icono }}"
                    });
                </script>
            @endif

            <div class="container">
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Información del Sistema</h5>
                <p>Bienvenido al sistema de gestión de parqueo. Aquí podrás:</p>
                <ul>
                    <li>Registrar y administrar tarifas de parqueo.</li>
                    <li>Monitorear eventos de ingreso y salida de vehículos.</li>
                    <li>Generar reportes de pagos y uso del parqueo.</li>
                    <li>Modificar y consultar datos de usuarios y operadores.</li>
                    <li>Acceder a funcionalidades avanzadas mediante el menú lateral.</li>
                </ul>
                <p>Para más información, contacta al administrador del sistema.</p>
            </div>
        </aside>

        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Copyright &copy; MainsTeam
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- Bootstrap 4 -->
    <script src="{{ secure_url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTable -->
    <script src="{{ secure_url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ secure_url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ secure_url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ secure_url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ secure_url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ secure_url('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
