@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Editar proveedor</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form id="formprincipal" action="{{ route('storeaddproductos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="datos" id="datos">
        <!-- creo una array hidden value="datos[]"
        cuando pulse sobre guardar lo que hago es
        recorrer los checkbox marcados y 
        comprobar si se ha introducido un precio (!= "")
        si se ha introducido precio datos[id_producto]  = precio que se ponga.
        checkbox tiene class="checks" para recorrerlos y su id es el id del producto

        Después reviso la array con todos los ids de los productos
        y si es undefined es que no hay precio, es decir, no se hace nada
        si hay un precio lo guardamos en la base de datos

        convierto en json y luego en php decode json

             
    -->

        <div class="row">
            <div class="mb-3">
                <label for="telefono" class="form-label">Seleccione el proveedor</label>
                <select class="form-select" aria-label="Seleccione un proveedor" name="proveedor" id="proveedor">
                    <option value="-1" selected>Seleccione un proveedor</option>
                    @foreach($data['proveedores'] as $proveedor)
                    <option value="{{ $proveedor->id}}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
                @error('telefono')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <table id="tablaprincipal" class="table table-borderless">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Añadir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre}}</td>
                        <td><input class="clear" type="number" id="precio_{{ $producto->id }}"></td>
                        <td><input class="clear" type="checkbox" id="{{ $producto->id }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button id="sub" type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<script>
    var data = @json($data);
    var productos = @json($productos);

    $("#proveedor").change(function(e) {
        $(".clear").each(function(e) {
            $(this).prop("checked", false);
            $(this).val("");
        });
        for (let index = 0; index < productos.length; index++) {
            for (let index2 = 0; index2 < data['productos'][$("#proveedor").val()].length; index2++) { //comprueba por cada producto si ese producto lo tiene el proveedor
                // AQUI NO ENTRA, ARREGLAR
                if (productos[index]['id'] == data['productos'][$("#proveedor").val()][0]['pivot']['productos_id']) {
                    $("#" + productos[index]['id']).prop("checked", true);
                    $("#precio_" + productos[index]['id']).val(data['productos'][$("#proveedor").val()][0]['pivot']['precio']);
                }
            }
        }
    });
    $("#sub").click(function(e) {
        e.preventDefault();
        var dat = Array();
        $(".clear").each(function(e) {
            if ($(this).prop('checked')) {
                dat[this.id] = $("#precio_" + this.id).val();
            }
        });
        $("#datos").val(JSON.stringify(dat));
        // $array = json_decode($datos);
        $("#formprincipal").submit();
    });
</script>
@endsection