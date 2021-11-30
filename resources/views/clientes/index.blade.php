@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de clientes</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('clientes.create') }}">Crear cliente</a>
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
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{ $cliente->apellidos }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>
                <form action="{{ route('clientes.destroy',$cliente->id) }}" method="Post"  class="d-flex flex-xl-row flex-column justify-content-around">
                    <a class="btn btn-primary mt-2" href="{{ route('clientes.edit',$cliente->id) }}">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
{!! $clientes->links() !!}
@endsection