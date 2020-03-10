<?php

namespace App\Http\Controllers;

use App\Models\Actor;
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
    }

    public function store(Request $request)
    {

    }

    public function show(Actor $actor)
    {

    }

    public function edit(Actor $actor)
    {

    }

    public function update(Request $request, Actor $actor)
    {

    }

    public function destroy(Actor $actor)
    {

    }
}
