@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Nom :{{$film->nom}}</h1>
        <h2>Auteur : {{$film->auteur}}</h2>
        <h3>Genre :{{$film->genre->nom}}</h3>
        @foreach($film->tags as $tag)
            <span class="badge">{{$tag->label}}</span>
        @endforeach
        <br>
        <a href="{{route('film.edit',$film)}}" class="btn btn-info">Edit</a>

        <form method="post" action="{{route('film.destroy',$film)}}">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </div>
@endsection