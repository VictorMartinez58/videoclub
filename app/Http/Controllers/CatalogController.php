<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CatalogController extends Controller
{

    public function getIndex()
    {
        return view('catalog.index',
            array(
                'arrayPeliculas' => Movie::all()
            )
        );
    }

    public function getShow($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.show', array(
            'pelicula' => $pelicula
        ));
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function getEdit($id)
    {
        $pelicula = Movie::findOrFail($id);
        return view('catalog.edit', array(
            'pelicula' => $pelicula
        ));
    }



    public function postCreate(Request $request){
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->rented = 0;
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return redirect(action("CatalogController@getIndex", 'catalog'));
    }

    public function putEdit(Request $request) {
        $id = $request->input('id');
        $movie = Movie::findOrFail($id);
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->rented = 0;
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        return redirect(action("CatalogController@getShow", $id));
    }


    public function changeRented(Request $request) {
        $id = $request->input('id');
        $movie = Movie::findOrFail($id);

        if($movie->rented){
            $movie->rented = 0;
        } else {
            $movie->rented = 1;
        }

        $movie->save();
        return redirect(action("CatalogController@getShow", $id));
    }
}
