@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Editar el servicio</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('servicios.update',$servicios->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="align-self-end mb-3 col-md-10 col-sm-12">
                <label for="nombre" class="form-label">Nombre del servicio</label>
                <input type="text" class="form-control" id="nombre" value="{{ $servicios->nombre }}" name="nombre" aria-describedby="nombre servicio">
                @error('nombre')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="align-self-end mb-3 col-md-2 col-sm-12">
                <label for="precio" class="form-label">Precio del servicio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="{{ $servicios->precio }}" aria-describedby="precio servicio">
                @error('precio')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="desc" class="form-label">Descripción del servicio</label>
                <textarea class="form-control" id="desc" rows="3" name="desc" aria-describedby="descripción del servicio">{{ $servicios->desc }}</textarea>
                @error('desc')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-danger" href="{{ route('servicios.index') }}">Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection