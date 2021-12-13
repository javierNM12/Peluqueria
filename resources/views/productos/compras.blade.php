@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Realizar venta presencial</h2>
                <p class="lead text-muted">
                    Vender un producto a un cliente presencial
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
                <th>Existencias</th>
                <th>P.V.P.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
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
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>
                    {{ $existtemp }}
                </td>
                <td>{{ $producto->pvp }} €</td>
                <td>
                    <a href="javascript: void(0)" onclick="addproducto('{{ $producto->id }}', '{{ $producto->nombre }}',  <?php echo $existtemp; ?>  , '{{ $producto->minimo }}', '{{ $producto->pvp }}')" class="bi bi-plus-circle fs-3 text me-3" role="button"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form class="my-5" action="{{ route('storeactuproductos') }}" method="POST" enctype="multipart/form-data" id="formdataactualizar">
        @csrf
        <input type="hidden" name="accion" id="accion" value="compra">
        <table id="tablaprincipal" class="table table-borderless">
            <thead>
                <tr>
                    <th>Eliminar</th>
                    <th>Nombre</th>
                    <th>Existencias</th>
                    <th>P.V.P.</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success" id="cli">Actualizar</button>
    </form>
</div>
<script>
    // comprobar si se quiere enviar el formulario vacío
    $("#cli").click(function(e) {
        e.preventDefault();
        if ($("#tablaprincipal tbody span").length <= 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se ha seleccionado un producto',
            })
        } else {
            var llave = true;
            $("#tablaprincipal tbody span").each(function(a) {
                if ($(this).text() <= 0) {
                    llave = false;
                }
            });
            if (llave) {
                $("#formdataactualizar").submit();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ningún producto debe estar a cero',
                })
            }
        }
    });

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
                texto += '<td>' + pvp + ' €</td>';
                texto += '<td class="w-auto d-flex justify-content-center align-items-center"><a href="javascript: void(0)" onclick="addcantidad(' + id + ', ' + existencias + ')" class="bi bi-plus-lg fs-3 text me-3 text-success" role="button"></a><span data-spanid="' + id + '">0</span><a href="javascript: void(0)" onclick="delcantidad(' + id + ')" class="bi bi-dash-lg fs-3 text ms-3 text-danger" role="button"></a></td>';
                texto += '</tr>';

                $("#tablaprincipal tbody").append(texto);
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
        if ($("span[data-spanid='" + id + "']").text() >= 1) {
            var cantidad = parseInt($("span[data-spanid='" + id + "']").text());
            $("span[data-spanid='" + id + "']").text(cantidad - 1);
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