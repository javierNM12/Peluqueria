@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Editar cita</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('citas.update',$citas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción de la cita</label>
            <input type="text" class="form-control" value="{{ $citas->descripcion }}" id="descripcion" name="descripcion" aria-describedby="descripcion citas">
            @error('descripcion')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y hora de la cita</label>
            <input type="text" class="form-control" value="{{ $citas->fecha_hora }}" id="fecha_hora" name="fecha_hora" aria-describedby="fecha y hora de la cita">
            @error('fecha_hora')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="servicios_id" class="form-label">Serivicos id de la cita</label>
            <input type="text" class="form-control" value="{{ $citas->servicios_id }}" id="servicios_id" name="servicios_id" aria-describedby="servicios_id de la cita">
            @error('servicios_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="clientes_id" class="form-label">clientes_id de la cita</label>
            <input type="text" class="form-control" value="{{ $citas->clientes_id }}" id="clientes_id" name="clientes_id" aria-describedby="clientes_id de la cita">
            @error('clientes_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('citas.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection