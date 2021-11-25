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
            <textarea class="form-control" id="descripcion" rows="3" name="descripcion" aria-describedby="descripcion citas">{{ $citas->descripcion }}</textarea>
            @error('descripcion')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_hora_i" class="form-label">Fecha y hora inicio de la cita</label>
            <input type="text" class="form-control" value="{{ $citas->fecha_hora_i }}" id="fecha_hora_i" name="fecha_hora_i" aria-describedby="fecha y hora inicio de la cita">
            @error('fecha_hora_i')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_hora_f" class="form-label">Fecha y hora finalizado de la cita</label>
            <input type="text" class="form-control" value="{{ $citas->fecha_hora_f }}" id="fecha_hora_f" name="fecha_hora_f" aria-describedby="fecha y hora finalizado de la cita">
            @error('fecha_hora_f')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="servicios_id" class="form-label">Servicios de la cita</label>
            @foreach($servicios as $servicio)
            <select class="form-select mb-2" aria-label="Seleccione un servicio" name="servicios_id[]" id="servicios_id[]">
                @foreach($serviciosall as $serv)
                @if($serv->id == $servicio->id)
                <option selected value="{{ $serv->id }}">{{ $serv->nombre }}</option>
                @else
                <option value="{{ $serv->id }}">{{ $serv->nombre }}</option>
                @endif
                @endforeach
            </select>
            @endforeach

            @error('servicios_id')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="clientes_id" class="form-label">Clientes de la cita</label>
            @foreach($clientes as $cliente)
            <select class="form-select mb-2" aria-label="Seleccione un clientes" name="clientes_id" id="clientes_id">
                @foreach($clientesall as $client)
                @if($client->id == $cliente->id)
                <option selected value="{{ $client->id }}">{{ $client->nombre }}</option>
                @else
                <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                @endif
                @endforeach
            </select>
            @endforeach
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