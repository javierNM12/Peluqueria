@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Editar proveedor</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('proveedores.update',$proveedores->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono del proveedor</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $proveedores->telefono }}" aria-describedby="telefono proveedor">
            @error('telefono')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del proveedor</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proveedores->nombre }}" aria-describedby="nombre proveedor">
            @error('nombre')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="web" class="form-label">Web del proveedor</label>
            <input type="text" class="form-control" id="web" name="web" value="{{ $proveedores->web }}" aria-describedby="web proveedor">
            @error('web')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('proveedores.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection