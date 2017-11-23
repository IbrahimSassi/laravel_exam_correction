<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use App\Http\Requests\AddFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Tag;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::with('genre')->orderBy('date_sortie', 'DESC')->limit(10)->get();
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        $tags = Tag::all();
        return view('films.create', compact('genres','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->get('tags'));
        $film = Film::create($request->except('tags'));

        foreach ($request->get('tags') as $tagId)
        {
            $tag = Tag::find($tagId);
            $film->tags()->attach($tag);
        }

        return redirect()->route('film.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Film $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Film $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('films.edit', compact('genres', 'film'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Film $film
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $film->fill($request->all());
        $film->save();

        return redirect()->route('film.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Film $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('film.index');
    }


    public function api()
    {
        return view('ajax.index');
    }
}
