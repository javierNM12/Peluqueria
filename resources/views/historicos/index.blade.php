@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
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
            <th class="col-2">fecha hora</th>
            <th class="col-2">cantidad</th>
            <th class="col-2">producto id</th>
            <th class="col-2">precio</th>
            <th class="col-2">Usuario id</th>
        </tr>
        @foreach ($historicos as $historico)
        <tr>
            <td>{{ $historico->id }}</td>
            <td>{{ $historico->fecha_hora }}</td>
            <td>{{ $historico->cantidad }}</td>
            <td>{{ $historico->productos_id }}</td>
            <td>{{ $historico->precio }}</td>
            <td>{{ $historico->users_id }}</td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
{!! $historicos->links() !!}
@endsection