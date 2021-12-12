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
        <thead>
            <tr>
                <th>ID</th>
                <th>Precio</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id }}</td>
                <td>{{ $servicio->precio }} €</td>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->desc }}</td>
                <td>
                    <form action="{{ route('servicios.destroy',$servicio->id) }}" method="Post" class="d-flex flex-xl-row flex-column justify-content-around" id="eliminar">
                        <a class="btn btn-primary mt-2" href="{{ route('servicios.edit',$servicio->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <a href="javascript: void(0)" onclick="eliminar('{{ $servicio->id }}')" class="btn btn-danger mt-2" role="button">Eliminar</a>
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
    function eliminar(id) {
        Swal.fire({
                title: "¿Seguro que desea eliminar este servicio?",
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
                    $.ajaxSetup({ // cabeceras con el token csrf
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('ajax.citascantidadserviciosid') }}",
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data[0]['cantidad'] >= 1) {
                                Swal.fire({
                                    title: "Error, hay citas con ese servicio",
                                    text: "Elimine primero todas los citas del inventario con ese servicio",
                                    icon: "warning",
                                    confirmButtonText: 'Aceptar',
                                    buttons: true,
                                    dangerMode: true,
                                })
                            } else {
                                $("#eliminar").submit();
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Se ha cancelado el proceso', '', 'info')
                }
            });
    }
</script>
{!! $servicios->links() !!}
@endsection