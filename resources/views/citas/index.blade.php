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
            <th>ID</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Action</th>
        </tr>
        @foreach ($citas as $cita)
        <tr>
            <td>{{ $cita->id }}</td>
            <td>{{ $cita->fecha_hora_i }}</td>
            <td>{{ $cita->fecha_hora_f }}</td>
            <td>{{ $cita->descripcion }}</td>
            @if($cita->finalizado == 1)
            <td class="text-success">Finalizado</td>
            @elseif($cita->finalizado == 0)
            <td class="text-warning">En proceso</td>
            @elseif($cita->finalizado == 2)
            <td class="text-danger">Cancelada</td>
            @endif
            <td>
                <form action="{{ route('citas.destroy',$cita->id) }}" method="Post" class="d-flex flex-xl-row flex-column justify-content-around">
                    <a class="btn btn-primary mt-2" href="{{ route('citas.edit',$cita->id) }}">Editar</a>
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
{!! $citas->links() !!}
@endsection