@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-5">
                <h2>Configurar pin</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('guardarajustes') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 col-md-12 col-sm-12">
            <label for="pin" class="form-label">Nuevo PIN (4 dígitos)</label>
            <input type="text" class="form-control" id="pin" name="pin" aria-describedby="pin cliente" maxlength="4">
            @error('pin')
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