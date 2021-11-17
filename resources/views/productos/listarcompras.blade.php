@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Histórico de compras</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    @foreach ($productos as $producto)
    <div class="col-12">
        <p class="h4 text-info">Producto: {{ $producto->nombre }}</p>
        <table class="display mb-5" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>fecha_hora</th>
                    <th>cantidad</th>
                    <th>ID Usuario</th>
                </tr>
            </thead>
            <tbody>
                @if ($historicos)
                @foreach($historicos[$producto->id] as $historico)
                <tr>
                    <td>{{ $historico->id }}</td>
                    <td>{{ $historico->fecha_hora }}</td>
                    @if ($historico->cantidad >= 1)
                    <td class="text-success">{{ $historico->cantidad }}</td>
                    @else
                    <td class="text-danger">{{ $historico->cantidad }}</td>
                    @endif
                    <td>{{ $historico->users_id }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>Sin entradas</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @endforeach
</div>
@endsection