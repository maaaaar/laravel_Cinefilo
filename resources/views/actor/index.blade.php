@extends('templates.main');

@section('titulo')
    ACTORES
@endsection

@section('principal')

{{-- añadimos boton para crear un actor --}}
<div class="card mt-2">
    <div class=" card-body">
    <a href="{{ action('ActorController@create')}}" class="btn btn-primary">NUEVO ACTOR</a>
    </div>
</div>

<div class="card mt-2">
    <div class="card-header">
        Lista actores
    </div>
    <div class="card-body">

        <form action=" {{ action('ActorController@index') }} " method="GET" class="form-horizontal">
            <div class="form-group row">
                <label for="" class="col-1">Nombre </label>
                <div class="col-10">
                <input type="text" class="form-control" name="search" id="search" value='{{$search}}'>
                </div>
                <button type="submit" class="btn btn-secondary btn-sm col-1">BUSCAR</button>
            </div>
        </form>


        <table class="table">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actores as $actor)
                    <tr>
                        <td> {{ $actor->dni }} </td>
                        <td> {{ $actor->nombre }} </td>
                        <td> {{ $actor->edad }} </td>
                        {{-- a partir del metodo del modelo podemos acceder a sexo desde actor  --}}
                        {{-- desde actor vamos a sexo y despues vamos a descripcion que son los datos que queremos mostrar --}}
                        <td> {{ $actor->sexo->descripcion }} </td>
                        <td>
                            <form action=" {{action('ActorController@edit', [$actor->dni]) }}" method="GET">
                                <button type="submit" class="btn btn-secondary btn-sm">EDITAR</button>
                            </form>
                        </td>
                        <td>
                            <form action=" {{action('ActorController@destroy', [$actor->dni]) }}" method="POST">
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
        {{ $actores->appends(['search'=>$search])->links() }}
    </div>
</div>
@endsection
