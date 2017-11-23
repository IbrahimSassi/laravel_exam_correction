@extends('layouts.app')

@section('content')

    <div class="container">
        <form method="POST" class="">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Nom :</label>
                <div class="col-sm-9">
                    <input name="nom" id="nom" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Auteur :</label>
                <div class="col-sm-9">
                    <input name="auteur" id="auteur" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="date_sortie" class="col-sm-3 control-label">date De sortie :</label>
                <div class="col-sm-9">
                    <input name="date_sortie" id="date_sortie" type="date" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="disponible" class="col-sm-3 control-label">disponible :</label>
                <div class="col-sm-9">
                    <input type="radio" checked class="" id="disponible" name="disponible" value="1"> Oui
                    <input type="radio" class="" id="disponible" name="disponible" value="0"> Non
                </div>
            </div>

            <div class="form-group">
                <label for="genre_id" class="col-sm-3 control-label">Genre : </label>
                <div class="col-sm-9">
                    <select class="form-control" name="genre_id" id="genre_id">

                    </select>
                </div>
            </div>
            <div class="form-group">
                <button id="btnAdd" class="btn btn-success btn-block" type="button">Créer</button>
                <button id="btnCancel" class="btn btn-danger btn-block" type="button">Annuler</button>
            </div>
        </form>

        <hr>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>nom</th>
                <th>Auteur</th>
                <th>Date de sortie</th>
                <th>Genre</th>
            </tr>
        </table>

    </div>


@endsection

@section('scripts')
    <script src="{{ asset('js/ajax.js') }}"></script>

@endsection
