@extends('templates.main')

@section('titulo')
    EDITAR PELICULA
@endsection

@section('principal')

    {{-- include del form de errores para que se pueda mostrar la alerta --}}
    @include('partial.errores')

    <div class="card mt-2 border-dark">
        <div class="card-header bg-dark text-light">
            PELICULA
        </div>
        <div class="card-body">
            <form action="{{action('PeliculaController@update',[$pelicula->id_pelicula])}}" method="POST">
                @method('put')
                @csrf

                {{-- TITULO --}}
                <div class="form-group row">
                  <label for="titulo" class="col-sm-2 col-form-label">TITULO</label>
                  <div>
                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo de la pelicula" aria-describedby="helpId" value="{{ $pelicula->titulo}}">
                    {{-- old para que te muestre lo mismo que habia antes --}}
                  </div>
                </div>

                {{-- DIRECTOR --}}
                <div class="form-group row">
                  <label for="director" class="col-sm-2 col-form-label">DIRECTOR</label>
                  <div>
                    <input type="text" name="director" id="director" class="form-control" placeholder="Nombre del director" aria-describedby="helpId" value="{{ $pelicula->director }}">
                  </div>
                </div>

                {{-- TEMAS --}}
                <div class="form-group row">
                  <label for="cbxSexo" class="col-sm-2 col-form-label">TEMA</label>
                  <div class="col-sm-10">
                    <select name="tema[]" id="tema" class="custom-select" multiple>
                      @foreach ($temas as $tema)
                        @if ($tema->id_tema == $pelicula->id_tema)
                          <option value="{{ $tema->id_tema }}" selected>{{ $tema->descripcion}}</option>
                        @else
                          <option value="{{ $tema->id_tema }}">{{ $tema->descripcion}}</option>
                        @endif

                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10 offset-2">
                    <button type="submit" class="btn btn-primary">ACEPTAR</button>
                  <a name="" id="" class="btn btn-secondary" href="{{ url('/pelicula')}}" role="button">CANCELAR</a>
                  </div>
                </div>
            </form>
        </div>
    </div>
@endsection
