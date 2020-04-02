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
        $temas = Tema::all();
        $data['titulo'] = 'Crear pelicula';

        return view('pelicula.create', $data);
    }

    public function store(Request $request)
    {
        $pelicula = new Pelicula();
        $pelicula->titulo = $request->input('titulo');
        $pelicula->director = $request->input('director');

        try
        {
            $pelicula->save();
            if ($request->input('temas')!=null)
            {
                $temas = $request->input('temas');
                foreach ($temas as $id)
                {
                    $pelicula->temas()->attach($id);
                }
            }
            $pelicula->save();
        }
        catch (QueryException $e)
        {
            $error = Utilitats::errorMessage($e);
            //el nombre/codigo del error lo guardamos en la session flash
            //la session flash solo dura una vez, cuando lo utilize se borra solo
            $request->session()->flash('error', $error);
            return redirect()->action('PeliculaController@create')->withInput(); //withImput para que nos muestre los datos que habian antes, va con el old de create.blade
            //de esta manera si hay error vuelve al form de crear y nos muestra los valores que habian antes del error
        }

        //nos rediciona a donde queramos, en este caso en el metodo index
        return redirect()->action('PeliculaController@index');
    }

    public function show(Pelicula $pelicula)
    {
        //
    }

    public function edit(Pelicula $pelicula)
    {
        //le pasamos la lista de temas
        $data['temas'] = Tema::all();
        $data['pelicula'] = $pelicula;
        $data['titulo'] = "Editar peliculas";

        return view('pelicula.edit', $data);
    }

    public function update(Request $request, Pelicula $pelicula)
    {
        $pelicula->titulo = $request->input('titulo');
        $pelicula->director = $request->input('director');

        try
        {
            $pelicula->save();
            $pelicula->temas()->detach();
            if ($request->input('tema')!=null)
            {
                foreach ($request->input('tema') as $id)
                {
                    $tema = Tema::find($id);
                    $pelicula->temas()->attach($tema->id_tema);
                }
            }
            $pelicula->save();
        }
        catch (QueryException $e)
        {
            $error = Utilitats::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('PeliculaController@edit')->withImput();
        }

        //nos rediciona a donde queramos, en este caso en el metodo index
        return redirect()->action('PeliculaController@index');
    }

    public function destroy(Request $request,Pelicula $pelicula)
    {
        try
        {
            $pelicula->temas()->detach();
            $pelicula->delete();
        } catch (QueryException $e)
        {
            $error = Utilitats::errorMessage($e);
            $request->session()->flash('error', $error);
        }

        return redirect()->action('PeliculaController@index');
    }
}