@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Añadir producto</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre producto">
            @error('nombre')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="proveedor" class="form-label">Proveedor del producto</label>
            <input type="text" class="form-control" id="proveedor" name="proveedor" aria-describedby="proveedor producto">
            @error('proveedor')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio del producto</label>
            <input type="text" class="form-control" id="precio" name="precio" aria-describedby="precio producto">
            @error('precio')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="existencias" class="form-label">Existencias del producto</label>
            <input type="text" class="form-control" id="existencias" name="existencias" aria-describedby="existencias producto">
            @error('existencias')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="minimo" class="form-label">Cantidad mínima del producto (Alarma)</label>
            <input type="text" class="form-control" id="minimo" name="minimo" aria-describedby="minimo producto">
            @error('minimo')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pvp" class="form-label">P.V.P.</label>
            <input type="text" class="form-control" id="pvp" name="pvp" aria-describedby="pvp producto">
            @error('pvp')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Añadir</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('productos.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection