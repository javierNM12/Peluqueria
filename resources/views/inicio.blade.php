@extends('plantillas.base')
@section('main')



@if (Auth::guest())
<div>
    <h1 class="display-5 fw-bold">Inicio</h1>
    <p class="col-md-8 fs-4">Bienvenido al inicio del sitio, para poder acceder a las funcionaldades del sitio debe iniciar sesión</p>
</div>
@else
<div>
    <h1 class="display-5 fw-bold">Panel de Control</h1>
    @if(session()->get('success'))
    <div class='alert alert-success'>
        {{ session()->get('success') }}
    </div>
    @endif
    <form class='row' name='mandarcita' id='mandarcita' enctype='multipart/form-data'>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        Cliente
                    </th>
                    <th scope="col">
                        Servicio
                    </th>
                    <th scope="col">
                        Fecha
                    </th>
                    <th scope="col">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    Dashboard
                </button>
                <div class="collapse" id="dashboard-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">Overview</a></li>
                        <li><a href="#" class="link-dark rounded">Weekly</a></li>
                        <li><a href="#" class="link-dark rounded">Monthly</a></li>
                        <li><a href="#" class="link-dark rounded">Annually</a></li>
                    </ul>
                </div>
                </li>
                <tr id="' . $citas[$i]['id_transaccion'] . '">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="d-inline p-2"><a href="javascript: void(0)" onclick="" class="bi-x-circle del text-danger" role="button"></a>
                        </div>
                        <div class="d-inline p-2"><a href="javascript: void(0)" onclick="" class=" bi bi-check-lg text-warning" role="button"></a></div>
                    </td>
                </tr>


            </tbody>
        </table>
    </form>
    

    <a class="row" href="{{ Route('productos.index') }}">Añadir producto</a>
    <a class="row" href="{{ Route('proveedores.index') }}">Añadir proveedor</a>
    <a class="row" href="{{ Route('clientes.index') }}">Añadir clientes</a>
    <a class="row" href="{{ Route('citas.index') }}">Añadir citas</a>
    <a class="row" href="{{ Route('servicios.index') }}">Añadir servicio</a>
</div>
@endif
@endsection