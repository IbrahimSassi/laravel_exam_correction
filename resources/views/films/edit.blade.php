@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('film.update',$film)}}" method="POST">

            <input type="hidden" name="_method" value="PUT">
            {{csrf_field()}}
            <div class="form-group">
                <label for="nom">Nom : </label>
                <input type="text" class="form-control" value="{{$film->nom}}" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="auteur"></label>
                <input type="text" class="form-control"  value="{{$film->auteur}}" id="auteur" name="auteur" required>
            </div>

            <div class="form-group">
                <label for="date_sortie">Date Sortie</label>
                <input type="date" class="form-control"  value="{{$film->date_sortie}}" id="date_sortie" name="date_sortie" required>
            </div>

            <div class="form-group">
                <label for="disponible" class=" control-label">disponible :</label>
                <div class="">
                    <input type="radio" class="" {{$film->disponible=="1"? "checked":""}} id="disponible" name="disponible" value="1"> Oui
                    <input type="radio" class="" {{$film->disponible=="0"? "checked":""}} id="disponible" name="disponible" value="0"> Non
                </div>
            </div>



            <div class="form-group">
                <label for="genre_id" class="control-label">genre : </label>
                <div class="">
                    <select name="genre_id" id="genre_id" class="form-control">
                        @foreach($genres as $genre)
                            <option {{$film->genre_id==$genre->id? "selected":""}} value="{{ $genre->id }}">{{ $genre->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block">Ajouter</button>

        </form>
    </div>
@endsection