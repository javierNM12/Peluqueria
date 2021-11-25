@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Añadir cliente</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="mb-3 col-6">
                <label for="nombre" class="form-label">Nombre del cliente</label>
                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre cliente">
                @error('nombre')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 col-6">
                <label for="apellidos" class="form-label">Apellidos del cliente</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" aria-describedby="apellidos cliente">
                @error('apellidos')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono del cliente</label>
            <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="telefono cliente">
            @error('telefono')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción del cliente</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" aria-describedby="descripcion cliente">
            @error('descripcion')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('clientes.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection