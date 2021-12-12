@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Histórico de ventas por producto</h2>
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
                <button id="pdf" class="bi bi-file-earmark-pdf-fill btn btn-warning w-auto"> PDF</button>
            </div>
        </div>
        <div class="mt-5">
            <table id="display" class="display mb-5 table" style="width:100%">
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
            $("#display tbody *").remove();
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
                    check = true
                    $("#display tbody *").remove();
                    if (data.length >= 1) {
                        $.each(data, function(index, history) {
                            if (history['cantidad'] <= -1) { // mostramos solamente los productos vendidos a los clientes
                                check = false;
                                var texto = '<tr>';
                                texto += '<td>' + history['id'] + '</td>';
                                texto += '<td>' + history['fecha_hora'] + '</td>';
                                texto += '<td class="text-success">' + history['cantidad'] * -1 + '</td>';
                                texto += '</tr>';
                                $("#display tbody").append(texto);
                            }
                        });
                        if (check) {
                            var texto = '<tr>';
                            texto += '<td colspan="3" class="text-danger text-center">No hay entradas</td>';
                            texto += '</tr>';
                            $("#display tbody").append(texto);
                        }
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
            var texto = '<tr>';
            texto += '<td colspan="4" class="text-danger text-center">Seleccione un producto</td>';
            texto += '</tr>';
            $("#display tbody").append(texto);
        }
    });

    // descargar pdf
    $("#pdf").click(function(e) {
        e.preventDefault();
        if ($("#producto").val() != "Seleccionar") {
            $.ajaxSetup({ // cabeceras con el token csrf
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ajax.pdf') }}",
                type: 'GET',
                data: {
                    html: $("#display").parent().html(),
                    titulo: "Histórico de ventas: " + $("#producto option").filter(":selected").text(),
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "historico_ventas_" + $("#producto option").filter(":selected").text() + ".pdf";
                    link.click();
                },
                error: function(data) {
                    alert("ERROR: " + data);
                }
            });
        } else {
            Swal.fire({
                title: 'Campos vacíos',
                text: "Debe elegir un producto",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'De acuerdo'
            });
        }
    });
</script>
@endsection