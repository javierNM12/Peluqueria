@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Añadir producto</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-9">
                <label for="nombre" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre producto">
                @error('nombre')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-3">
                <label for="pvp" class="form-label">P.V.P.</label>
                <input type="number" step="0.01" class="form-control" id="pvp" name="pvp" aria-describedby="pvp producto">
                @error('pvp')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex align-items-end row">
            <div class="mb-3 col-5">
                <label for="minimo" class="form-label">Cantidad mínima del producto (Alarma)</label>
                <input type="number" class="form-control" id="minimo" name="minimo" aria-describedby="minimo producto">
                @error('minimo')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-7">
                <label for="tipo" class="form-label">Tipo de producto</label>
                <select class="form-select" aria-label="Tipo de producto" name="tipo" id="tipo">
                    <option selected>Seleccionar</option>
                    <option value="0">Consumo propio</option>
                    <option value="1">Venta al público</option>
                </select>
                @error('minimo')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Añadir</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('productos.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<script>
    //cambiar el raton cuando esté por encima de los botones de puntuación
    $(".bi-plus-circle").hover(function() {
        $(this).css("cursor", "pointer");
    });
    $(".bi-dash-circle").hover(function() {
        $(this).css("cursor", "pointer");
    });

    // evento click añadir proveedor
    $(".bi-plus-circle").click(function() {
        if ($('.proveedor').length >= 1) {
            $("#alarmaproveedores").hide();
        }
        $("#proveedores").val(parseInt($("#proveedores").val()) + 1);

        var texto = '<div class="row proveedor">';
        texto += '<div class="col-10 mb-3 d-flex align-items-end">';
        texto += '<select class="form-select" aria-label="Seleccione un proveedor" name="proveedor[]" id="proveedor[]">';
        texto += '<option selected>Seleccione un proveedor</option>';
        texto += '@foreach ($proveedores as $proveedor)';
        texto += '<option value="{{ $proveedor->id}}">{{ $proveedor->nombre }}</option>';
        texto += '@endforeach';
        texto += '</select>';
        texto += '@error("proveedor")';
        texto += '<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>';
        texto += '@enderror';
        texto += '</div>';
        texto += '<div class="mb-3 col-2">';
        texto += '<label for="precio" class="form-label">Precio del producto</label>';
        texto += '<input type="number" step="0.01" class="form-control" id="precio[]" name="precio[]" aria-describedby="precio producto">';
        texto += '@error("precio ")';
        texto += '<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>';
        texto += '@enderror';
        texto += '</div>';
        texto += '</div>';

        $(texto).insertAfter($(".proveedor").last());
    });

    // evento quitar añadir proveedor
    $(".bi-dash-circle").click(function() {
        if ($('.proveedor').length > 1) {
            $(".proveedor").last().remove();
            $("#proveedores").val(parseInt($("#proveedores").val()) - 1);
        } else {
            $("#alarmaproveedores").show();
        }
    });
</script>
@endsection