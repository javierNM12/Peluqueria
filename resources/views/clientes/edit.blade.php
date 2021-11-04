<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit producto Form - Laravel 8 CRUD Tutorial</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit clientes</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('clientes.index') }}" enctype="multipart/form-data"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('clientes.update',$clientes->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto nombre:</strong>
                        <input type="text" name="nombre" value="{{ $clientes->nombre }}" class="form-control" placeholder="producto nombre">
                        @error('nombre')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto apellidos:</strong>
                        <input type="text" name="apellidos" value="{{ $clientes->apellidos }}" class="form-control" placeholder="producto apellidos">
                        @error('apellidos')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto telefono:</strong>
                        <input type="email" name="telefono" class="form-control" placeholder="producto telefono" value="{{ $clientes->telefono }}">
                        @error('telefono')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto descripcion:</strong>
                        <input type="text" name="descripcion" value="{{ $clientes->descripcion }}" class="form-control" placeholder="producto descripcion">
                        @error('descripcion')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>