@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Carta de servicios</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('servicios.create') }}"> Añadir servicio</a>
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
            <th>Precio</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Action</th>
        </tr>
        @foreach ($servicios as $servicio)
        <tr>
            <td>{{ $servicio->id }}</td>
            <td>{{ $servicio->precio }}</td>
            <td>{{ $servicio->nombre }}</td>
            <td>{{ $servicio->desc }}</td>
            <td>
                <form action="{{ route('servicios.destroy',$servicio->id) }}" method="Post" class="d-flex flex-xl-row flex-column justify-content-around">
                    <a class="btn btn-primary mt-2" href="{{ route('servicios.edit',$servicio->id) }}">Editar</a>
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
{!! $servicios->links() !!}
@endsection