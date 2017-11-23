<?php

namespace App\Http\Controllers;

use App\Favori;
use App\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('addFavori');
    }


    public function addFavori(Film $film)
    {
        $film->users()->attach(Auth::user());
        return redirect()->route('film.index');
    }


    public function listFavori()
    {
        $films = Auth::user()->films;
        return view('favoris.inde', compact('films'));
    }

    public function destroyFavori(Film $film)
    {
        $film->users()->detach(Auth::user());
        return redirect()->route('favori.index');

    }
}
