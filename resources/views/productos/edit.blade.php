@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Editar producto</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('productos.update',$productos->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $productos->nombre }}" aria-describedby="nombre producto">
            @error('nombre')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="existencias" class="form-label">Existencias del producto</label>
            <input type="text" class="form-control" id="existencias" name="existencias" value="{{ $productos->existencias }}" aria-describedby="existencias producto">
            @error('existencias')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="minimo" class="form-label">Cantidad mínima del producto (Alarma)</label>
            <input type="text" class="form-control" id="minimo" name="minimo" value="{{ $productos->minimo }}" aria-describedby="minimo producto">
            @error('minimo')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pvp" class="form-label">P.V.P.</label>
            <input type="text" class="form-control" id="pvp" name="pvp" value="{{ $productos->pvp }}" aria-describedby="pvp producto">
            @error('pvp')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('productos.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection