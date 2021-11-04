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
                    <a class="btn btn-success" href="{{ route('clientes.create') }}"> Create Cliente</a>
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
                <th>S.No</th>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Address</th>
                <th>Company Address</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->apellidos }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->descripcion }}</td>
                <td>
                    <form action="{{ route('clientes.destroy',$cliente->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('clientes.edit',$cliente->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $clientes->links() !!}
</body>

</html>