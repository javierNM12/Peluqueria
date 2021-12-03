@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Listar citas</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('citas.create') }}"> Añadir cita</a>
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
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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
                <td class="align-middle">
                    <form action="{{ route('citas.destroy',$cita->id) }}" method="Post" class="d-flex flex-xl-row flex-column justify-content-around" id="eliminar">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-3 text-center">
                                <a href="javascript: void(0)" onclick="eliminar('{{ $cita->id }}')" class="bi bi-trash del text-danger" role="button"></a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="{{ route('canelcita',$cita->id) }}" class="bi-x-circle del text-warning" role="button"></a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="{{ route('fincita',$cita->id) }}" class="bi-check-lg text-success" role="button"></a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="{{ route('citas.edit',$cita->id) }}" class="bi bi-pencil-square text-primary" role="button"></a>
                            </div>
                        </div>
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
<script>
    function eliminar(e) {
        Swal.fire({
                title: "¿Seguro que desea eliminar la cita?",
                text: "Este proceso es permanente",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $("#eliminar").submit();
                } else if (result.isDenied) {
                    Swal.fire('Se ha cancelado el proceso', '', 'info')
                }
            });
    }
</script>
{!! $citas->links() !!}
@endsection