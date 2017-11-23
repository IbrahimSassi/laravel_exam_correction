@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($genres as $genre)
            <h2>{{$genre->nom}}</h2>
            <h5>Liste des films</h5>
            <ul>
                @forelse($genre->films as $film)
                    <li class="badge">{{$film->nom}}</li>
                @empty
                    <p>No Film</p>
                @endforelse

            </ul>
        @endforeach
    </div>
@endsection