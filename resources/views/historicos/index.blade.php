@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Lista de movimientos</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row d-flex justify-content-end pb-3">
        <div class="mt-3 ms-0 w-auto align-self-end">
            <button id="pdf" class="bi bi-file-earmark-pdf-fill btn btn-warning w-auto"> PDF</button>
        </div>
    </div>
    <div>
        <table id="display" class="table table-bordered">
            <thead>
                <tr>
                    <th class="col-2">ID</th>
                    <th class="col-2">Fecha</th>
                    <th class="col-2">Cantidad</th>
                    <th class="col-2">Producto</th>
                    <th class="col-2">Precio</th>
                    <th class="col-2">Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historicos as $historico)
                <tr>
                    <td>{{ $historico->id }}</td>
                    <td>{{ $historico->fecha_hora }}</td>
                    @if ($historico->cantidad >=1)
                    <td class="text-success">{{ $historico->cantidad }}</td>
                    @else
                    <td class="text-danger">{{ $historico->cantidad }}</td>
                    @endif
                    <td>
                        @foreach ($productos[$historico->id] as $producto)
                        {{ $producto->nombre }}
                        @endforeach
                    </td>
                    <td>{{ $historico->precio }} €</td>
                    <td>
                        @foreach ($users[$historico->id] as $user)
                        {{ $user->name }} {{ $user->apellidos }}
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
<script>
    // descargar pdf
    $("#pdf").click(function(e) {
        e.preventDefault();
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
                titulo: "Histórico de movimientos",
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "historico_movimientos";
                link.click();
            },
            error: function(data) {
                alert("ERROR: " + data);
            }
        });
    });
</script>
{!! $historicos->links() !!}
@endsection