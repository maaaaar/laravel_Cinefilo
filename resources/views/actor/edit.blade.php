@extends('templates.main')

@section('titulo')
    EDITAR ACTOR
@endsection

@section('principal')
    <div class="card mt-2 border-dark">
        <div class="card-header bg-dark text-light">
            ACTOR
        </div>
        <div class="card-body">
            <form action="{{action('ActorController@update', [$actor->dni])}}" method="POST">
                @method('put')
                @csrf

                {{-- DNI --}}
                <div class="form-group row">
                  <label for="dni" class="col-sm-2 col-form-label">DNI</label>
                  <div>
                    <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI del actor" aria-describedby="helpId" value="{{ $actor->dni}}" disabled>
                  </div>
                </div>

                {{-- NOMBRE --}}
                <div class="form-group row">
                  <label for="nombre" class="col-sm-2 col-form-label">NOMBRE</label>
                  <div>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del actor" aria-describedby="helpId" value="{{ $actor->nombre}}">
                  </div>
                </div>

                {{-- EDAD --}}
                <div class="form-group row">
                  <label for="edad" class="col-sm-2 col-form-label">EDAD</label>
                  <div>
                    <input type="text" name="edad" id="edad" class="form-control" placeholder="Edad del actor" aria-describedby="helpId" value="{{$actor->edad}}">
                  </div>
                </div>

                {{-- SEXO --}}
                <div class="form-group row">
                  <label for="cbxSexo" class="col-sm-2 col-form-label">SEXO</label>
                  <div class="col-sm-10">
                    <select name="sexo" id="cdxSexo" class="custom-select">
                      @foreach ($sexos as $sexo)
                        @if ($sexo->id_sexo == $actor->id_sexo)
                          <option value="{{ $sexo->id_sexo}}" selected>{{ $sexo->descripcion}}</option>
                        @else
                          <option value="{{ $sexo->id_sexo}}">{{ $sexo->descripcion}}</option>
                        @endif

                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10 offset-2">
                    <button type="submit" class="btn btn-primary">ACEPTAR</button>
                  <a name="" id="" class="btn btn-secondary" href="{{ url('/actor')}}" role="button">CANCELAR</a>
                  </div>
                </div>
            </form>
        </div>
    </div>
@endsection
