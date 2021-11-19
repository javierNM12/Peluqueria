@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Histórico de ventas</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex justify-content-center align-items-end">
            <div class="mx-auto me-0 col-2">
                <label for="producto" class="form-label">Seleccione el producto</label>
                <select class="form-select" aria-label="Seleccione el producto" name="producto" id="producto">
                    <option selected value="Seleccionar">Seleccionar</option>
                    @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                @error('minimo')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mx-auto ms-0 col-6 w-auto">
                <button type="button" id="cargar" class="btn btn-success">Cargar</button>
            </div>
        </div>
        <div class="mt-5">
            <table id="display" class="display mb-5" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha hora</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </form>
</div>
<script>
    $("#cargar").click(function(e) {
        if ($("#producto").val() != "Seleccionar") {
            // cargamos por ajax el historial
            $.ajaxSetup({ // cabeceras con el token csrf
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ajax.historicoventas') }}",
                type: 'POST',
                data: {
                    id: $("#producto").val(),
                },
                success: function(data) {
                    $("#display tbody *").remove();

                    $.each(data, function(index, history) {
                        var texto = '<tr>';
                        texto += '<td>' + history['id'] + '</td>';
                        texto += '<td>' + history['fecha_hora'] + '</td>';
                        if (history['cantidad'] >= 1) { // mostramos la cantidad vendida, cambiando el signo ya que si hemos sacado 5 productos (-5) del inventario significa que son 5 ventas (+5)
                            texto += '<td class="text-danger">' + history['cantidad'] * -1 + '</td>';
                        } else {
                            texto += '<td class="text-success">' + history['cantidad'] * -1 + '</td>';
                        }
                        texto += '</tr>';
                        $("#display tbody").append(texto);
                    });
                },
                error: function(data) {
                    alert("ERROR: " + data);
                }
            });
        } else {
            $("#display tbody *").remove();
        }
    });
</script>
@endsection