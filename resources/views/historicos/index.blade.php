@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de movimientos</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('historicos.create') }}"> Crear historico</a>
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
            <th class="col-2">fecha hora</th>
            <th class="col-2">cantidad</th>
            <th class="col-2">producto id</th>
            <th class="col-2">Acciones</th>
        </tr>
        @foreach ($historicos as $historico)
        <tr>
            <td>{{ $historico->id }}</td>
            <td>{{ $historico->fecha_hora }}</td>
            <td>{{ $historico->cantidad }}</td>
            <td>{{ $historico->producto_id }}</td>
            <td>
                <form action="{{ route('historicos.destroy',$historico->id) }}" method="Post" class="d-flex justify-content-between">
                    <a class="btn btn-primary ms-2" href="{{ route('historicos.edit',$historico->id) }}">Editar</a>
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
{!! $historicos->links() !!}
@endsection