@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de proveedores</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="offset-10 btn btn-success" href="{{ route('proveedores.create') }}">Añadir</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Teléfono</th>
                <th>Nombre</th>
                <th>Web</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->web }}</td>
                <td>
                    <form action="{{ route('proveedores.destroy',$proveedor->id) }}" method="Post" class="d-flex flex-xl-row flex-column justify-content-around">
                        <a class="btn btn-primary mt-2" href="{{ route('proveedores.edit',$proveedor->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
{!! $proveedores->links() !!}
@endsection