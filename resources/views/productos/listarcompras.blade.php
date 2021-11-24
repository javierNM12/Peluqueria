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
        <div class="row d-flex justify-content-center">
            <div class="me-0 w-auto align-self-end">
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
            <div class="mt-3 ms-0 w-auto align-self-end">
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
                        if ($(data).length >= 1) {
                        $.each(data, function(index, history) {
                            if (history['cantidad'] <= 1) { // mostramos solamente los productos vendidos a los clientes
                                var texto = '<tr>';
                                texto += '<td>' + history['id'] + '</td>';
                                texto += '<td>' + history['fecha_hora'] + '</td>';
                                texto += '<td class="text-success">' + history['cantidad'] * -1 + '</td>';
                                texto += '</tr>';
                                $("#display tbody").append(texto);
                            }
                        });
                    } else {
                        var texto = '<tr>';
                        texto += '<td colspan="3" class="text-danger text-center">No hay entradas</td>';
                        texto += '</tr>';
                        $("#display tbody").append(texto);
                    }
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