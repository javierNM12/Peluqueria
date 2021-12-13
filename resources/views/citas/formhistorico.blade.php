@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Histórico de citas</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row">
        @csrf
        <div class="row d-flex justify-content-end">
            <button id="buscar" class="btn btn-primary w-auto me-2">Buscar</button>
            <button id="pdf" class="bi bi-file-earmark-pdf-fill btn btn-warning w-auto"> PDF</button>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="fecha_i" class="form-label">Fecha inicio</label>
                <input type="date" class="form-control" id="fecha_i" name="fecha_i" aria-describedby="Fecha inicio">
                @error('fecha_i')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="fecha_f" class="form-label">Fecha fin</label>
                <input type="date" class="form-control" id="fecha_f" name="fecha_f" aria-describedby="Fecha final">
                @error('fecha_f')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <table id="mostrar" class="table table-bordered">
            <thead>
                <tr>
                    <th class="w-auto">ID</th>
                    <th class="w-auto">Fecha inicio</th>
                    <th class="w-auto">Fecha fin</th>
                    <th class="w-auto">Estado</th>
                    <th class="w-auto">Servicio</th>
                    <th class="w-auto">Dinero gastado</th>
                    <th class="w-auto">Cliente</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
<script>
    $("#buscar").click(function(e) {
        if ($("#fecha_i").val() != "" && $("#fecha_f").val() != "") {
            $.ajaxSetup({ // cabeceras con el token csrf
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ajax.historicocitas') }}",
                type: 'POST',
                data: {
                    fechai: $("#fecha_i").val(),
                    fechaf: $("#fecha_f").val()
                },
                success: function(data) {
                    $("#mostrar tbody *").remove();
                    if (data['citas'][0] != null) {
                        for (let index = 0; index < data['citas'].length; index++) {
                            var texto = '<tr>';
                            texto += '<td>' + data['citas'][index]['id'] + '</td>';
                            texto += '<td>' + data['citas'][index]['fecha_hora_i'] + '</td>';
                            texto += '<td>' + data['citas'][index]['fecha_hora_f'] + '</td>';
                            if (data['citas'][index]['finalizado'] == 0) {
                                texto += '<td class="text-warning">En progreso</td>';
                            } else if (data['citas'][index]['finalizado'] == 1) {
                                texto += '<td class="text-success">Finalizado</td>';
                            } else {
                                texto += '<td class="text-danger">Cancelado</td>';
                            }
                            var servicios = "";
                            var total = 0;
                            for (let index2 = 0; index2 < data['servicios'][data['citas'][index]['id']].length; index2++) {
                                servicios += data['servicios'][data['citas'][index]['id']][index2]['nombre'] + ', ';
                                total += data['servicios'][data['citas'][index]['id']][index2]['precio'];
                            }
                            servicios = servicios.slice(0, -2);
                            texto += '<td>' + servicios + '</td>';
                            texto += '<td>' + total + ' €</td>';
                            texto += '<td>' + data['clientes'][data['citas'][index]['id']][0]['nombre'] + ' ' + data['clientes'][data['citas'][index]['id']][0]['apellidos'] + '</td>';
                            texto += '</tr>';
                            $("#mostrar tbody").append(texto);
                        }
                    } else {
                        var texto = '<tr class="table-danger">';
                        texto += '<td colspan="7" class="mx-auto">No hay registros para este tramo de fechas</td>';
                        texto += '</tr>';
                        $("#mostrar tbody").append(texto);
                    }
                },
                error: function(data) {
                    alert("ERROR: " + data);
                }
            });
        } else {
            Swal.fire({
                title: 'Campos vacíos',
                text: "Debe elegir una fecha de inicio y otra de fin",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'De acuerdo'
            });
        }
    });

    // descargar pdf
    $("#pdf").click(function(e) {
        if ($("#fecha_i").val() != "" && $("#fecha_f").val() != "") {
            $.ajaxSetup({ // cabeceras con el token csrf
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('ajax.pdf') }}",
                type: 'GET',
                data: {
                    html: $("#mostrar").parent().html(),
                    titulo: "Histórico de citas " + $("#fecha_i").val() +" - " + $("#fecha_f").val(),
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "historico_citas_" + $("#fecha_i").val() + " -- " + $("#fecha_f").val() + ".pdf";
                    link.click();
                },
                error: function(data) {
                    alert("ERROR: " + data);
                }
            });
        } else {
            Swal.fire({
                title: 'Campos vacíos',
                text: "Debe elegir una fecha de inicio y otra de fin",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'De acuerdo'
            });
        }
    });
</script>
@endsection