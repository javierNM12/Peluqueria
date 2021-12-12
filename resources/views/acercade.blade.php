@extends('.plantillas.base')
@section('main')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Acerca del autor</h2>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <img class="mb-3 img-fluid w-50 m-auto" src="{{ asset('Perfil.png') }}" alt="">
        <p>
            Mi nombre es Javier Núñez Morales, soy alumno de 2º Desarrollo de Aplicaciones Web del <a href="https://www.iestrassierra.com/" class="text-decoration-none">I.E.S. Trassierra</a> y he desarrollado este proyecto en 2021.
        </p>
        <p>
            Podéis encontrar tanto este proyecto como otros que he realizado en mi <a href="https://github.com/javierNM12" class="text-decoration-none">Github</a>
        </p>
    </div>
    <div class="d-flex justify-content-end py-3">
        <a class="btn btn-secondary" href="{{ route('inicio') }}">Volver</a>
    </div>
</div>
@endsection