@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Historial del cliente</h2>
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
                <label for="cliente" class="form-label">Seleccione el cliente</label>
                <select class="form-select" aria-label="Tipo de producto" name="cliente" id="cliente">
                    <option selected>Seleccionar</option>
                    @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}, {{ $cliente->apellidos }}</option>
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
                        <th>Fecha inicio</th>
                        <th>Fecha finalizado</th>
                        <th>Estado</th>
                        <th>Descripción</th>
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
        if ($("#cliente").val() != "Seleccionar") {
            // cargamos por ajax el historial
            $.ajaxSetup({ // cabeceras con el token csrf
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ajax.historicoclientes') }}",
                type: 'POST',
                data: {
                    id: $("#cliente").val(),
                },
                success: function(data) {
                    $("#display tbody *").remove();
                    $.each(data, function(index, history) {
                        var texto = '<tr>';
                        texto += '<td>' + history['fecha_hora_i'] + '</td>';
                        texto += '<td>' + history['fecha_hora_f'] + '</td>';
                        if (history['finalizado'] == 0) {
                            texto += '<td class="text-warning">En proceso</td>';
                        } else if (history['finalizado'] == 1) {
                            texto += '<td class="text-success">Finalizado</td>';
                        } else {
                            texto += '<td class="text-danger">Cancelado</td>';
                        }
                        texto += '<td>' + history['descripcion'] + '</td>';
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
            var texto = '<tr>';
            texto += '<td colspan="4" class="text-danger text-center">Sin resultados</td>';
            texto += '</tr>';
            $("#display tbody").append(texto);
        }
    });
</script>
@endsection