@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Añadir Cita</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('citas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="servicios" id="servicios" value="1">
        <div class="row mb-3">
            <label for="descripcion" class="form-label ps-0">Descripción de la cita</label>
            <textarea class="form-control" id="descripcion" rows="3" name="descripcion" aria-describedby="descripcion citas"></textarea>
            @error('descripcion')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <!--<div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha y hora de la cita</label>
                <input type="text" class="form-control" id="fecha_hora" name="fecha_hora" aria-describedby="fecha y hora de la cita">
                @error('fecha_hora')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>-->
            <div class="col-6 mb-3 ps-0 align-self-center">
                <label for="dia" class="form-label">Seleccione un día</label>
                <input type="date" class="form-control" id="dia" name="dia" aria-describedby="Día">
                @error('dia')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 pe-0">
                <select id="hora[]" name="hora[]" class="form-select horas" multiple aria-label="multiple select example">
                    <option selected>No se ha seleccionado un día</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="clientes_id" class="form-label">Cliente</label>
            <select class="form-select" aria-label="Seleccione un cliente" name="clientes_id" id="clientes_id">
                <option selected>Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id}}">{{ $cliente->apellidos }}, {{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('clientes_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row">
            <div class="d-flex justify-content-end">
                <i class="bi bi-plus-circle fs-3 text me-3"></i>
                <i class="bi bi-dash-circle fs-3 text"></i>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 pe-0 ps-0 servicio">
                <label for="servicios_id" class="form-label">Servicio</label>
                <select class="form-select" aria-label="Seleccione un servicio" name="servicios_id[]" id="servicios_id[]">
                    <option selected>Seleccione un servicio</option>
                    @foreach ($servicios as $servicio)
                    <option value="{{ $servicio->id}}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
                @error('servicios_id')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div id="alarmaservicio" class="alert alert-danger mt-1 mb-1" style="display:none">Mínimo se debe seleccionar un servicio</div>

        <div class="row d-flex justify-content-between">
            <div class="col-6 ps-0">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end pe-0">
                <a class="btn btn-danger" href="{{ route('citas.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
<script>
    // comprobar horas disponibles cuando se selecciona el día
    $("#dia").change(function(e) {
        var array = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];
        var horas = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'];
        //ajax recupero horas ya utilizadas
        var fecha = $("#dia").val();
        $.ajaxSetup({ // cabeceras con el token csrf
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('ajaxcita.horas') }}",
            type: 'POST',
            data: {
                fecha: fecha,
            },
            success: function(data) {
                if ($(data).length >= 1) {
                    // elimino la fila predeterminada
                    $(".horas").children().remove();
                    $.each(array, function(index2, disponibles) {
                        $.each(data, function(index1, ocupadas) {
                            var datetime = ocupadas['fecha_hora_i'].split(' ');
                            var time = datetime[1].split(':');
                            var hmi = time[0] + ":" + time[1];

                            datetime = ocupadas['fecha_hora_f'].split(' ');
                            time = datetime[1].split(':');
                            var hmf = time[0] + ":" + time[1];

                            var inicio = jQuery.inArray(hmi, horas);
                            var final = (jQuery.inArray(hmf, horas) - inicio) + 1;
                            if (inicio >= 0 && final >= 0) {
                                horas.splice(inicio, final);
                            }

                        });

                    });
                    for (let index = 0; index < array.length; index++) {
                        if (jQuery.inArray(array[index], horas) >= 0) {
                            var texto = '<option value="' + array[index] + '">' + array[index] + '</option>';
                        } else {
                            var texto = '<option disabled class="text-danger" value="' + array[index] + '">' + array[index] + '</option>';
                        }
                        $(".horas").append(texto);
                    }
                } else {
                    $(".horas").children().remove();
                    $.each(array, function(index2, disponibles) {
                        var texto = '<option value="' + disponibles + '">' + disponibles + '</option>';
                        $(".horas").append(texto)
                    });
                }
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    });

    //cambiar el raton cuando esté por encima de los botones de puntuación
    $(".bi-plus-circle").hover(function() {
        $(this).css("cursor", "pointer");
    });
    $(".bi-dash-circle").hover(function() {
        $(this).css("cursor", "pointer");
    });

    // evento click añadir servicio
    $(".bi-plus-circle").click(function() {
        if ($('.servicio').length >= 1) {
            $("#alarmaservicio").hide();
        }
        $("#servicios").val(parseInt($("#servicios").val()) + 1);

        var texto = '<div class="row mb-3 servicio">';
        texto += '<select class="form-select" aria-label="Seleccione un servicio" name="servicios_id[]" id="servicios_id[]">';
        texto += '<option selected>Seleccione un servicio</option>';
        texto += '@foreach ($servicios as $servicio)';
        texto += '<option value="{{ $servicio->id}}">{{ $servicio->nombre }}</option>';
        texto += '@endforeach';
        texto += '</select>';
        texto += '@error("servicios_id")';
        texto += '<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>';
        texto += '@enderror';
        texto += '</div>';

        $(texto).insertAfter($(".servicio").last());
    });

    // evento quitar servicio
    $(".bi-dash-circle").click(function() {
        if ($('.servicio').length > 1) {
            $(".servicio").last().remove();
            $("#servicios").val(parseInt($("#servicios").val()) - 1);
        } else {
            $("#alarmaservicio").show();
        }
    });
</script>
@endsection