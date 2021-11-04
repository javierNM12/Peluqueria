<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel 8 CRUD Tutorial From Scratch</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 8 CRUD Example Tutorial</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('servicios.create') }}"> Create servicio</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>precio</th>
                <th>nombre</th>
                <th>desc</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id }}</td>
                <td>{{ $servicio->precio }}</td>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->desc }}</td>
                <td>
                    <form action="{{ route('servicios.destroy',$servicio->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('servicios.edit',$servicio->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $servicios->links() !!}
</body>

</html>