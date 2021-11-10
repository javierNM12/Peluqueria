@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Añadir historico</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('historicos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">fecha del historico</label>
            <input type="text" class="form-control" id="fecha_hora" name="fecha_hora" aria-describedby="nombre historico">
            @error('fecha_hora')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">cantidad del historico</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" aria-describedby="cantidad historico">
            @error('cantidad')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="producto_id" class="form-label">producto_id del historico</label>
            <input type="text" class="form-control" id="producto_id" name="producto_id" aria-describedby="producto_id historico">
            @error('producto_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Añadir</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('historicos.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection