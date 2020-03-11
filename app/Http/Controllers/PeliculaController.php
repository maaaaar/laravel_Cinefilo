<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Tema;
use App\Classes\Utilitats;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PeliculaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search'))
        {
            $search = $request->input('search');
            $peliculas = Pelicula::where('titulo', 'like', '%'.$search.'%')
                            ->orderby('titulo')
                            ->paginate(5);
        }
        else
        {
            $search = '';
            $peliculas = Pelicula::orderby('titulo')->paginate(5);
        }

        $data['peliculas'] = $peliculas;
        $data['search'] = $search;
        return view('pelicula.index', $data);
    }

    public function create()
    {
        // $temas = Tema::all();
        // $data['temas'] = $temas;

        // return view('pelicula.create', $data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Pelicula $pelicula)
    {
        //
    }

    public function edit(Pelicula $pelicula)
    {
        //
    }

    public function update(Request $request, Pelicula $pelicula)
    {
        //
    }

    public function destroy(Pelicula $pelicula)
    {
        //
    }
}