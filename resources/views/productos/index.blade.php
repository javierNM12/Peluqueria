@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de productos</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('productos.create') }}"> Crear producto</a>
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
            <th>Mínimo</th>
            <th>P.V.P.</th>
            <th class="col-2">Acciones</th>
        </tr>
        @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->minimo }}</td>
            <td>{{ $producto->pvp }}</td>
            <td>
                <form action="{{ route('productos.destroy',$producto->id) }}" method="Post" class="d-flex justify-content-between">
                    <a class="btn btn-primary ms-2 me-2" href="{{ route('productos.edit',$producto->id) }}">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger me-2">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
{!! $productos->links() !!}
@endsection