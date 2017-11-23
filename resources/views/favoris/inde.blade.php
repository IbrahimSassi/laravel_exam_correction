@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($films as $film)
            <li>{{$film->nom}} - <a href="{{route('favori.destroy',$film)}}" class="btn-danger">Delete</a></li>
        @endforeach

    </div>
@endsection