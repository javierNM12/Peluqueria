@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Editar historico</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('historicos.update',$historicos->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">fecha_hora del historico</label>
            <input type="text" class="form-control" id="fecha_hora" name="fecha_hora" value="{{ $historicos->fecha_hora }}" aria-describedby="fecha_hora historico">
            @error('fecha_hora')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">cantidad del historico</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" value="{{ $historicos->cantidad }}" aria-describedby="cantidad historico">
            @error('cantidad')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="producto_id" class="form-label">Cantidad mínima del historico (Alarma)</label>
            <input type="text" class="form-control" id="producto_id" name="producto_id" value="{{ $historicos->producto_id }}" aria-describedby="producto_id historico">
            @error('producto_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('historicos.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection