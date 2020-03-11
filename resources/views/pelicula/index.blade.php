@extends('templates.main')

@section('titulo')
    PELICULAS
@endsection

@section('principal')

{{-- añadimos boton para crear un actor --}}
<div class="card mt-2">
    <div class=" card-body">
    <a href="{{ action('PeliculaController@create')}}" class="btn btn-secondary">NUEVA PELICULA</a>
    </div>
</div>

<div class="card mt-2">
    <div class="card-header bg-dark text-white">
        Lista de peliculas
    </div>
    <div class="card-body">

        <form action=" {{ action('PeliculaController@index') }} " method="GET" class="form-horizontal">
            <div class="form-group row">
                <label for="" class="col-1">Titulo</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="search" id="search" value='{{$search}}'>
                </div>
                <button type="submit" class="btn btn-secondary btn-sm col-1">BUSCAR</button>
            </div>
        </form>


        <table class="table">
            <thead>
                <tr>
                    <th>TITULO</th>
                    <th>DIRECTOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peliculas as $pelicula)
                    <tr>
                        <td> {{ $pelicula->titulo }} </td>
                        <td> {{ $pelicula->director}} </td>
                        <td>
                            <form action=" {{action('PeliculaController@edit', [$pelicula->id_pelicula]) }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm">EDITAR</button>
                            </form>
                        </td>
                        <td>
                            <form action=" {{action('PeliculaController@destroy', [$pelicula->id_pelicula]) }}" method="POST">
                               @method('delete')
                               @csrf
                                <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- para poder paginar es necessario esto--}}
        {{-- appends sirve para si cambias de pagina no se borre el valor que quieres buscar --}}
        {{ $peliculas->appends(['search'=>$search])->links() }}
    </div>
</div>
@endsection
