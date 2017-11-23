@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Liste des films</h1>
        <ul>
            @forelse($films as $film)
                <li><a href="{{route('film.show',$film)}}">{{$film->nom}}</a></li>
                <li>{{$film->auteur}}</li>
                <li>{{$film->genre->nom}}</li>

                @if(Auth::user())
                    @if(Auth::user()->films->contains($film))
                        <a href="{{route('favori.destroy',$film)}}" class="btn btn-danger">Unfavorit</a>

                    @else
                        <a href="{{route('favori.store',$film)}}" class="btn btn-success">Favori</a>

                    @endif
                @endif
                <hr>
            @empty
                <p>no films</p>
            @endforelse
        </ul>
    </div>
@endsection