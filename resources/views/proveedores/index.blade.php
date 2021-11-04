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
                    <a class="btn btn-success" href="{{ route('proveedores.create') }}"> Create Company</a>
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
                <th>Company telefono</th>
                <th>Company Nombre</th>
                <th>Company Web</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->web }}</td>
                <td>
                    <form action="{{ route('proveedores.destroy',$proveedor->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('proveedores.edit',$proveedor->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $proveedores->links() !!}
</body>

</html>