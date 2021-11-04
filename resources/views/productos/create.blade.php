<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add producto Form - Laravel 8 CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add producto</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('productos.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="number" name="proveedor" class="form-control" placeholder="proveedor">
            <input type="number" name="precio" class="form-control" placeholder="precio">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto nombre:</strong>
                        <input type="text" name="nombre" class="form-control" placeholder="producto nombre">
                        @error('nombre')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto existencias:</strong>
                        <input type="existencias" name="existencias" class="form-control" placeholder="producto existencias">
                        @error('existencias')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>producto minimo:</strong>
                        <input type="text" name="minimo" class="form-control" placeholder="producto minimo">
                        @error('minimo')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>producto pvp:</strong>
                        <input type="text" name="pvp" class="form-control" placeholder="producto pvp">
                        @error('pvp')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
</body>

</html>