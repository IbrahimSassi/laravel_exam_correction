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


        <form action="{{route('film.update',$film)}}" method="POST">

            <input type="hidden" name="_method" value="PUT">
            {{csrf_field()}}
            <div class="form-group">
                <label for="nom">Nom : </label>
                <input type="text" class="form-control" value="{{$film->nom}}" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="auteur"></label>
                <input type="text" class="form-control" value="{{$film->auteur}}" id="auteur" name="auteur" required>
            </div>

            <div class="form-group">
                <label for="date_sortie">Date Sortie</label>
                <input type="date" class="form-control" value="{{$film->date_sortie}}" id="date_sortie"
                       name="date_sortie" required>
            </div>

            <div class="form-group">
                <label for="disponible" class=" control-label">disponible :</label>
                <div class="">
                    <input type="radio" class="" {{$film->disponible=="1"? "checked":""}} id="disponible"
                           name="disponible" value="1"> Oui
                    <input type="radio" class="" {{$film->disponible=="0"? "checked":""}} id="disponible"
                           name="disponible" value="0"> Non
                </div>
            </div>


            <div class="form-group">
                <label for="tags" class=" control-label">tags :</label>
                <div class="">
                    @foreach($tags as $tag)
                        <input {{$film->tags->contains($tag) ? "checked":""}} type="checkbox" class="" name="tags[]"
                               value="{{$tag->id}}"> {{$tag->label}}
                    @endforeach

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

            <button type="submit" class="btn btn-success btn-block">Modifer</button>

        </form>
    </div>
@endsection