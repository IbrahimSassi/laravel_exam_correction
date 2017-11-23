@extends('layouts.app')

@section('content')

<div class="container">
    @if(count($errors->all()))
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{route('film.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label for="nom">Nom : </label>
            <input type="text" class="form-control" id="nom" name="nom" >
        </div>

        <div class="form-group">
            <label for="auteur"></label>
            <input type="text" class="form-control" id="auteur" name="auteur" >
        </div>

        <div class="form-group">
            <label for="date_sortie">Date Sortie</label>
            <input type="date" class="form-control" id="date_sortie" name="date_sortie" >
        </div>

        <div class="form-group">
            <label for="disponible" class=" control-label">disponible :</label>
            <div class="">
                <input type="radio" class="" id="disponible" name="disponible" value="1"> Oui
                <input type="radio" class="" id="disponible" name="disponible" value="0"> Non
            </div>
        </div>

        <div class="form-group">
            <label for="tags" class=" control-label">tags :</label>
            <div class="">
                @foreach($tags as $tag)
                    <input type="checkbox" class="" name="tags[]" value="{{$tag->id}}"> {{$tag->label}}
                @endforeach

            </div>
        </div>



        <div class="form-group">
            <label for="genre_id" class="control-label">genre : </label>
            <div class="">
                <select name="genre_id" id="genre_id" class="form-control">
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block">Ajouter</button>

    </form>
</div>
@endsection