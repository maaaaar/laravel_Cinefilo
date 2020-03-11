<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Sexo;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    //cogemos los datos de la BD
    public function index(Request $request)
    {

        if ($request->has('search'))
        {
            $search = $request->input('search');
            $actores = Actor::where('nombre', 'like', '%'.$search.'%')
                            ->orderby('nombre')
                            ->paginate(5);
        }
        else
        {
            $search = '';
            $actores = Actor::orderby('nombre')->paginate(5);
        }

        $data['actores'] = $actores;
        $data['search'] = $search;
        return view('actor.index', $data);
    }

    public function create()
    {
        //mostrar
        $sexos = Sexo::all();
        $data['sexos'] = $sexos;

        return view('actor.create', $data); //withImput para que el old funcione
    }

    public function store(Request $request)
    {
        $actor = new Actor();
        $actor->dni = $request->input('dni');
        $actor->nombre = $request->input('nombre');
        $actor->edad = $request->input('edad');
        $actor->id_sexo = $request->input('sexo');

        $actor->save();
        //nos rediciona a donde queramos, en este caso en el metodo index
        return redirect()->action('ActorController@index');
    }

    public function show(Actor $actor)
    {

    }

    //para cargar los datos en el formulario de editar
    public function edit(Actor $actor)
    {
        //le pasamos la lista de sexos
        $sexos = Sexo::all();

        $data['sexos'] = $sexos;
        $data['actor'] = $actor;

        return view('actor.edit', $data);
    }

    //para guardar los canvios
    public function update(Request $request, Actor $actor)
    {
        $actor->nombre = $request->input('nombre');
        $actor->edad = $request->input('edad');
        $actor->id_sexo = $request->input('sexo');

        $actor->save();
        //nos rediciona a donde queramos, en este caso en el metodo index
        return redirect()->action('ActorController@index');

    }

    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->action('ActorController@index');
    }
}