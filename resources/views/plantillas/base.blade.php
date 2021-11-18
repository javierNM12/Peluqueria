<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="JavierNM">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Peluquería</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/navbar-static/">-->

    <!--BootStrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" integrity="sha384-7ynz3n3tAGNUYFZD3cWe5PDcE36xj85vyFkawcF6tIwxvIecqKvfwLiaFdizhPpN" crossorigin="anonymous">

    <!-- JQUERY CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SWEETALERT2 CDN  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Jquery DataTables CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</head>

<body>

    @if (Auth::guest())
    <!-- Invitado -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <button type="button" class="btn btn-info">Invitado</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Inicio</a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0">
                @csrf
                <a class="btn btn-outline-success mr-sm-2 my-2 my-sm-0" href="{{ Route ('login') }}">Iniciar Sesión</a>
                <a class="btn btn-outline-primary mr-sm-2 my-2 my-sm-0" href="{{ Route ('register') }}">Crear Cuenta</a>
            </form>
        </div>
    </nav>

    @elseif(Auth::user()->rol =="2")
    <!-- Trabajador -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <button type="button" class="btn btn-info">Cliente</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Comprar entrada</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Ver mis entradas</a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ Route ('logout') }}">
                @csrf
                <a class='mnutop text-warning' title='alarmas' id='alarmas' data-bs-toggle='modal' data-bs-target='#exampleModal' role='button'>
                    <i class="bi bi-exclamation-octagon text-warning"></i> Alarmas
                </a>
                <button class="btn btn-outline-danger mr-sm-2 my-2 my-sm-0" action="submit">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    @elseif(Auth::user()->rol == "1")
    <!-- Empresario -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item me-5">
                        <button type="button" class="btn btn-info">Empresario</button>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-secondary" href="{{ Route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item me-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Inventario
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('productos.index') }}">Listar productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('productos.create') }}">Añadir producto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('formaddproductos') }}">Añadir productos a un proveedor ***</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('proveedores.index') }}">Lista de proveedores</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('proveedores.create') }}">Añadir proveedor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('actuinventario') }}">Actualizar inventario</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('historicos.index') }}">Lista de movimientos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('listarcompras') }}">Mostrar ventas (permitir elegir el producto) * </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('compras') }}">Realizar compra presencial</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item me-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Clientes
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('clientes.index') }}">Listar clientes *</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('clientes.create') }}">Añadir cliente</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('formhistorial') }}">Historial de citas por cliente</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item me-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Citas
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('citas.index') }}">Listar citas *</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('citas.create') }}">Añadir citas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('formhistoricocitas') }}">Historico de citas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item me-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Servicios
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('servicios.index') }}">Carta de servicios *</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ Route('servicios.create') }}">Añadir servicio</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ Route ('logout') }}">
                @csrf
                <a class='px-1 mnutop text-warning' title='alarmas' id='alarmas' data-bs-toggle='modal' data-bs-target='#exampleModal' role='button'>
                    <i class="bi bi-exclamation-octagon text-warning"></i> Alarmas
                </a>
                <button class="btn btn-outline-danger mr-sm-2 my-2 my-sm-0" action="submit">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    @elseif(Auth::user()->rol == "0")
    <!-- Administrador -->

    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <button type="button" class="btn btn-info">Empresario</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Comprobar entradas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Comprobar películas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('inicio') }}">Añadir película</a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ Route ('logout') }}">
                @csrf
                <a class='px-1 mnutop text-warning' title='alarmas' id='alarmas' data-bs-toggle='modal' data-bs-target='#exampleModal' role='button'>
                    <i class="bi bi-exclamation-octagon text-warning"></i> Alarmas
                </a>
                <button class="btn btn-outline-danger mr-sm-2 my-2 my-sm-0" action="submit">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    @endif

    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <i class="bi bi-scissors"></i>
                    <span class="fs-4"> Peluquería Yadira</span>
                </a>
            </header>
            <div class="p-5 mb-4 bg-light border rounded-3">
                <div class="container-fluid py-5">
                    @yield('main')
                </div>
            </div>
            <footer class="pt-3 mt-4 text-muted border-top">
                © Javier NM 2021
            </footer>
        </div>
    </main>
    @if (!Auth::guest())
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alarmas activas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input id="id_alarma" type="hidden" name="id_alarma" value=""></input>
                    <input type="hidden" name="tipo" id="tipo" value="none"></input>
                    <input type="hidden" name="listaalarmas" id="listaalarmas"></input>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Inventario
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(Session::get('alarmas') != null)
                            @foreach (Session::get('alarmas'); as $key => $alarma)
                            <tr>
                                <td>Sin existencias del producto <strong>{{ $alarma->nombre }}</strong></td>
                                <td>Existencias: {{ $alarma->existencias }}</td>
                                <td>Mínimo: {{ $alarma->minimo }}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</body>

</html>