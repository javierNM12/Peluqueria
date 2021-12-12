@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Carta de productos</h2>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('productos.create') }}"> Añadir producto</a>
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
                <th>Nombre</th>
                <th>Mínimo</th>
                <th>P.V.P.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->minimo }}</td>
                <td>{{ $producto->pvp }}</td>
                <td>
                    <form action="{{ route('productos.destroy',$producto->id) }}" method="Post" class="d-flex flex-xl-row flex-column justify-content-around" id="eliminar">
                        <a class="btn btn-primary mt-2" href="{{ route('productos.edit',$producto->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <a href="javascript: void(0)" onclick="eliminar('{{ $producto->id }}')" class="btn btn-danger mt-2" role="button">Eliminar</a>
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
                title: "¿Seguro que desea eliminar el producto?",
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
                        url: "{{ route('ajax.productoscantidadproductoid') }}",
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data[0]['cantidad'] >= 1) {
                                Swal.fire({
                                    title: "Error, hay existencias de ese producto en el inventario",
                                    text: "Elimine primero todos los productos del inventario",
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
{!! $productos->links() !!}
@endsection