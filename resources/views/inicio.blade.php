@extends('plantillas.base')
@section('main')


@if (Auth::guest())
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 class="display-5 fw-bold py-5">Inicio</h1>
            </div>
            <p class="col-md-8 fs-4">Bienvenido al inicio del sitio, para poder acceder a las funcionaldades del sitio debe iniciar sesión</p>
        </div>
    </div>
</div>
@else
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 class="display-5 fw-bold py-5">Panel de Control</h1>
            </div>
            <div class="pull-right mb-2 d-flex justify-content-end">
                <a class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalcita' role='button'>Añadir cita</a>
            </div>
        </div>
    </div>
    @if(session()->get('success'))
    <div class='alert alert-success'>
        {{ session()->get('success') }}
    </div>
    @endif
    <!--<form class='row' name='mandarcita' id='mandarcita' enctype='multipart/form-data'>-->
    <form class="row" method="post" action="/adminnavbar/gestionnavbar/" name="modificanavbar" id="modificanavbar" enctype="multipart/form-data">
        <input id="id_navbar" type="hidden" name="id_navbar" value="">
        <input id="tipo" type="hidden" name="tipo" value="">
        <table class="table data table-bordered table-hover" data-section="1" id="tablecita">
            <thead>
                <tr>
                    <th scope="col">Descripción</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                <tr class="table-primary" data-id="{{ $cita->id }}">
                    <td class="col-9 align-middle">
                        {{ $cita->descripcion }}
                    </td>
                    <td class="col-2 align-middle text-center">
                        @php
                        $arr = explode(':', Carbon::createFromFormat('Y-m-d H:i:s', $cita->fecha_hora_i)->format('H:i:s'));
                        echo $arr[0] . ":" . $arr[1];
                        @endphp
                    </td>
                    <td class="col-1">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a href="javascript: void(0)" onclick="eliminar('{{ $cita->id }}')" class="bi-trash del text-danger" role="button"></a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="javascript: void(0)" onclick="cancelar('{{ $cita->id }}')" class="bi-x-circle del text-warning" role="button"></a>
                            </div>
                            <div class="col-4 text-center">
                                <a href="javascript: void(0)" onclick="finalizar('{{ $cita->id }}')" class="bi-check-lg text-success" role="button"></a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="table-secondary" data-id="sub_{{ $cita->id }}" style="display:none">
                    <td colspan="3">
                        @foreach ($clientes as $cliente)
                        @if ($cliente->id == $cita->clientes_id)
                        <div class="row">
                            <div class="col-4">{{ $cliente->nombre }}</div>
                            <div class="col-4">{{ $cliente->apellidos }}</div>
                            <div class="col-4">{{ $cliente->telefono }}</div>
                        </div>
                        <div class="row text-center">
                            <div class="col-12">{{ $cliente->descripcion }}</div>
                        </div>
                        @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
    <!--
        <a class="row" href="{{ Route('productos.index') }}">Añadir producto</a>
        <a class="row" href="{{ Route('historicos.index') }}">Añadir historico</a>
        <a class="row" href="{{ Route('proveedores.index') }}">Añadir proveedor</a>
        <a class="row" href="{{ Route('clientes.index') }}">Añadir clientes</a>
        <a class="row" href="{{ Route('citas.index') }}">Añadir citas</a>
        <a class="row" href="{{ Route('servicios.index') }}">Añadir servicio</a>-->
</div>

{{-- MODAL AÑADIR CITA --}}
<div class="modal fade" id="modalcita" tabindex="-1" aria-labelledby="modalcitaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalcitaLabel">Añadir cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-start">
                <form action="{{ route('citas.store') }}" method="POST" enctype="multipart/form-data" id="formmodalcita">
                    @csrf
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción de la cita</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" aria-describedby="descripcion citas">
                        @error('descripcion')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y hora de la cita</label>
                        <input type="text" class="form-control" id="fecha_hora" name="fecha_hora" aria-describedby="fecha y hora de la cita">
                        @error('fecha_hora')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="servicios_id" class="form-label">Servicio ID</label>
                        <input type="text" class="form-control" id="servicios_id" name="servicios_id" aria-describedby="servicios_id de la cita">
                        @error('servicios_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="clientes_id" class="form-label">Clientes ID</label>
                        <input type="text" class="form-control" id="clientes_id" name="clientes_id" aria-describedby="clientes_id de la cita">
                        @error('clientes_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row d-flex justify-content-between">
                        <div class="col-6">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <a class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- FIN MODAL AÑADIR CITA --}}


<script>
    // PETICION AJAX PARA MARCAR CANCELAR CITA
    function cancelar(e) {
        event.stopPropagation(); // evita que el se muestre la fila con los datos del cliente (por culpa del onClick event)
        var id = e;
        $.ajaxSetup({ // cabeceras con el token csrf
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('ajaxcita.cancelar') }}",
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                $('[data-id="' + id + '"]').next(".table-secondary").remove();
                $('[data-id="' + id + '"]').remove();
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    };

    // PETICION AJAX PARA MARCAR COMO FINALIZADA LA CITA
    function finalizar(e) {
        event.stopPropagation(); // evita que el se muestre la fila con los datos del cliente (por culpa del onClick event)
        var id = e;
        $.ajaxSetup({ // cabeceras con el token csrf
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('ajaxcita.finalizar') }}",
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                $('[data-id="' + id + '"]').next(".table-secondary").remove();
                $('[data-id="' + id + '"]').remove();
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    };

    // CONFIRMACION ELIMINAR CITA
    function eliminar(base) {
        event.stopPropagation();
        Swal.fire({
                title: "¿Seguro que desea eliminar la cita?",
                text: "Este proceso es permanente",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    var id = base;
                    $.ajaxSetup({ // cabeceras con el token csrf
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('ajaxcita.eliminar') }}",
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            $('[data-id="' + id + '"]').next(".table-secondary").remove();
                            $('[data-id="' + id + '"]').remove();
                        },
                        error: function(data) {
                            alert("ERROR: " + data);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Se ha cancelado el proceso', '', 'info')
                }
            });
    }

    // abrir y cerrar tabla 
    $('.table-primary').click(function(e) {
        $(this).next(".table-secondary").toggle();
    });

    // GESTION CITA FORMULARIO MODAL
    $('#formmodalcita').submit(function(event) {
        event.preventDefault();
        // con ajax guardo la cita
        var formData = new FormData(document.getElementById("formmodalcita"));
        formData.append("dato", "valor");

        $.ajaxSetup({ // cabeceras con el token csrf
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('ajaxcita.crear') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var a = data;
                // petición ajax para actualizar la tabla de citas del día
                $.ajaxSetup({ // cabeceras con el token csrf
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('ajaxcita.listar') }}",
                    type: 'POST',
                    success: function(data) { // elimino y recreo el listado de citas
                        $("#tablecita tbody *").remove();
                        $(data).each(function(indice, cita) {
                            $("#tablecita tbody").append('<tr class="table-primary" data-id="' + cita.id + '"><td class="col-9 align-middle">' + cita.descripcion + '</td><td class="col-2 align-middle text-center">' + cita.fecha_hora + '</td><td class="col-1"><div class="row"><div class="col-6 text-center"><a href="javascript: void(0)" onclick="eliminar(' + cita.id + ')" class="bi-x-circle del text-danger" role="button"></a></div><div class="col-6 text-center"><a href="javascript: void(0)" onclick="finalizar(' + cita.id + ')" class="bi-check-lg text-success" role="button"></a></div></div></td></tr><tr class="table-secondary" data-id="sub_' + cita.id + '" style="display:none"><td colspan="3"><div class="row"><div class="col-4">NOMBRE</div><div class="col-4">APELLIDOS</div><div class="col-4">TELEFONO</div></div><div class="row text-center"><div class="col-12">DESCRIPCION</div></div></td></tr>');
                        });
                        // volvemos a lanzar el EventListener para que capture los nuevos elementos
                        $('.table-primary').click(function(e) {
                            $(this).next(".table-secondary").toggle();
                        });
                    },
                    error: function(data) {
                        alert("ERROR: " + data);
                    }
                });
                // cierro el modal
                //$('#formmodalcita').modal('close');
                $('#modalcita').modal('hide');
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    });
</script>
@endif
@endsection