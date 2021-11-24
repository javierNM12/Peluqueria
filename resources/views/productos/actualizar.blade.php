@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Actualizar inventario</h2>
                <p class="lead text-muted">
                    Productos utilizados a restar del inventario de la peluquería
                </p>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <table id="example" class="display my-5" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>P.V.P.</th>
                <th>Selecionar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->pvp }}</td>
                <td>
                    <?php
                    $existtemp = 0;
                    if (isset($inventario)) {
                        foreach ($inventario as $key => $invent) {
                            if ($invent->productos_id == $producto->id) {
                                $existtemp =  $invent->existencias;
                            }
                        }
                    } else {
                        $existtemp = 0;
                    }
                    ?>
                    <a href="javascript: void(0)" onclick="addproducto('{{ $producto->id }}', '{{ $producto->nombre }}', <?php echo $existtemp; ?>, '{{ $producto->minimo }}', '{{ $producto->pvp }}')" class="bi bi-plus-circle fs-3 text me-3" role="button"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form class="my-5" action="{{ route('storeactuproductos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="accion" id="accion" value="actu">
        <table id="tablaprincipal" class="table table-borderless">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Nombre</th>
                    <th>Existencias</th>
                    <th>Mínimo</th>
                    <th>P.V.P.</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });

    function addproducto(id, nombre, existencias, minimo, pvp) {
        /*        if ($('.proveedor').length >= 1) {
                    $("#alarmaproveedores").hide();
                }*/
        if (existencias >= 1) {
            if ($("tr[data-trid='" + id + "']").length <= 0) {
                var texto = '<tr data-trid="' + id + '">';
                texto += '<input type="hidden" id="producto[]" name="producto[]" value="' + id + '">';
                texto += '<input type="hidden" id="cantidad[]" name="cantidad[]" value="0">';
                texto += '<td><a href="javascript: void(0)" onclick="del(' + id + ')" class="bi bi-trash-fill fs-3 text me-3 text-danger" role="button"></a></td>';
                texto += '<td>' + nombre + '</td>';
                texto += '<td>' + existencias + '</td>';
                texto += '<td>' + minimo + '</td>';
                texto += '<td>' + pvp + '</td>';
                texto += '<td><a href="javascript: void(0)" onclick="addcantidad(' + id + ', ' + existencias + ')" class="bi bi-plus-lg fs-3 text me-3 text-success" role="button"></a><span data-spanid="' + id + '">0</span><a href="javascript: void(0)" onclick="delcantidad(' + id + ')" class="bi bi-dash-lg fs-3 text me-3 text-danger" role="button"></a></td>';
                texto += '</tr>';

                $(texto).insertAfter($("#tablaprincipal tbody"));
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No ha existencias de este producto',
                footer: 'Revisa si hay una entrega sin añadir'
            })
        }
    }

    function del(id) {
        $("tr[data-trid='" + id + "']").remove();
    }

    function delcantidad(id) {
        var cantidad = parseInt($("span[data-spanid='" + id + "']").text());
        if (cantidad >= 1) {
            $("span[data-spanid='" + id + "']").text(cantidad - 1);
        } else {
            $("tr[data-trid='" + id + "'] input:last").val(cantidad - 1);
        }
    }

    function addcantidad(id, existencias) {
        var cantidad = parseInt($("span[data-spanid='" + id + "']").text());
        if (cantidad < existencias) {
            $("span[data-spanid='" + id + "']").text(cantidad + 1);
            $("tr[data-trid='" + id + "'] input:last").val(cantidad + 1);
        }
    }
</script>
@endsection