@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de citas</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('citas.create') }}"> Crear cita</a>
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
            <th class="col-3">Fecha</th>
            <th class="col-3">Descripción</th>
            <th class="col-2">Estado</th>
            <th class="col-2">Action</th>
        </tr>
        @foreach ($citas as $cita)
        <tr>
            <td>{{ $cita->id }}</td>
            <td>{{ $cita->fecha_hora }}</td>
            <td>{{ $cita->descripcion }}</td>
            @if($cita->finalizado == 1)
            <td class="text-success">Finalizado</td>
            @elseif($cita->finalizado == 0)
            <td class="text-warning">En proceso</td>
            @endif
            <td>
                <form action="{{ route('citas.destroy',$cita->id) }}" method="Post"  class="d-flex justify-content-between">
                    <a class="btn btn-primary" href="{{ route('citas.edit',$cita->id) }}">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
{!! $citas->links() !!}
@endsection