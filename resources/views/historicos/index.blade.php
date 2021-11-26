@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Lista de movimientos</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th class="col-2">ID</th>
            <th class="col-2">Fecha</th>
            <th class="col-2">Cantidad</th>
            <th class="col-2">Producto</th>
            <th class="col-2">Precio</th>
            <th class="col-2">Usuario</th>
        </tr>
        @foreach ($historicos as $historico)
        <tr>
            <td>{{ $historico->id }}</td>
            <td>{{ $historico->fecha_hora }}</td>
            @if ($historico->cantidad >=1)
            <td class="text-success">{{ $historico->cantidad }}</td>
            @else
            <td class="text-danger">{{ $historico->cantidad }}</td>
            @endif
            <td>
                @foreach ($productos[$historico->id] as $producto)
                {{ $producto->nombre }}
                @endforeach
            </td>
            <td>{{ $historico->precio }} €</td>
            <td>
                @foreach ($users[$historico->id] as $user)
                {{ $user->name }} {{ $user->apellidos }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
{!! $historicos->links() !!}
@endsection