$(document).ready(function () {

  //used to know if its add or update
  var selectedFilm = false;

  getAllFilm();


  //take out the list business to a separate function to call it after modification to refresh
  function getAllFilm() {
    $.get('http://127.0.0.1:8000/api/film', function (result) {
      var rows = '';
      result.map(function (film) {
        var filmDom = '<tr>' +
          '<td>' + film.id + '</td>' +
          '<td>' + film.nom + '</td>' +
          '<td>' + film.auteur + '</td>' +
          '<td>' + film.date_sortie + '</td>' +
          '<td>' + film.genre.nom + '</td>' +
          '<td>' + '<button class="btn btn-info btnEdit" data-film="' + film.id + '">Edit</button>' + '</td>' +
          '<td>' + '<button class="btn btn-danger btnDelete" data-film="' + film.id + '">Delete</button>' + '</td>' +
          '</tr>'

        rows = rows + filmDom
      });
      $('table').html('')
      $('table').append(rows)

    })

  }


  //GET all genres
  $.get('http://127.0.0.1:8000/api/genre', function (result) {

    result.map(function (genre) {
      var genreOption = '<option value="' + genre.id + '">' + genre.nom + '}</option>'
      $('select').append(genreOption)
    });

  })


  //on click add button , we take input values and verify if its an add or update using our selectedFilm variable
  $('#btnAdd').on('click', function (event) {
    $('#btnAdd').attr('disabled', 'true');
    $('#btnAdd').text('saving');

    event.preventDefault();
    var film = {};
    film.nom = $('#nom').val()
    film.auteur = $('#auteur').val()
    film.date_sortie = $('#date_sortie').val()
    film.genre_id = $('#genre_id').val()
    if ($('#disponible')[0].checked)
      film.disponible = '1'
    else
      film.disponible = '0'

    //Ajout
    if (!selectedFilm) {

      $.ajax({
        url: 'http://127.0.0.1:8000/api/film',
        type: 'post',
        dataType: 'json',
        data: film,
        success: function (result) {
          console.log(result);
          var filmDom = '<tr>' +
            '<td>' + result.id + '</td>' +
            '<td>' + result.nom + '</td>' +
            '<td>' + result.auteur + '</td>' +
            '<td>' + result.date_sortie + '</td>' +
            '<td>' + result.genre_id + '</td>' +
            '</tr>'
          $('table').append(filmDom)

          $('#btnAdd').removeAttr('disabled');
          $('#btnAdd').text('Creer');


        },
      });


    }
    //Update
    else {
      $.ajax({
        url: 'http://127.0.0.1:8000/api/film/' + selectedFilm.id,
        type: 'put',
        dataType: 'json',
        data: film,
        success: function (result) {
          console.log(result)
          getAllFilm();

        },
        error: function (error) {
          console.log(error)
          getAllFilm();

          $('#btnAdd').removeAttr('disabled');
          $('#btnAdd').text('Creer');

        },
      });

    }


  })


  //setTimeout used beacause the Edit button and delete button will be renderer using jquery so after the initial render
  // so if we dont use setTimeout , it will register the click listener on button with class btnEdit which is unexistant yet
  setTimeout(function () {

    //Select film
    $('.btnEdit').on('click', function (event) {
      var filmID = event.target.dataset.film;
      $.get('http://127.0.0.1:8000/api/film/' + filmID, function (film) {
        selectedFilm = film;
        $('#btnAdd').text('Modifer');

        $('#nom').val(film.nom)
        $('#auteur').val(film.auteur)
        $('#date_sortie').val(film.date_sortie)
        $('#disponible').val(film.disponible)
        $('#genre_id').val(film.genre_id)

      })
    })


    //delete film
    $('.btnDelete').on('click', function (event) {
      var filmID = event.target.dataset.film;

      var res = confirm('Voulez vous vraimer supprimer ce film');

      if (res) {
        $.ajax({
          url: 'http://127.0.0.1:8000/api/film/' + filmID,
          type: 'delete',
          dataType: 'json',
          success: function (result) {
            getAllFilm();

          },
          error: function (error) {
            console.log(error)
            getAllFilm();
          },
        });
      }
    })


  }, 1000)


  //clear inputs
  $('#btnCancel').on('click', function (e) {
    e.preventDefault();
    selectedFilm = false;
    $('#btnAdd').text('Créer');
    $('#nom').val(undefined)
    $('#auteur').val(undefined)
    $('#date_sortie').val(undefined)
    $('#disponible').val(undefined)
    $('#genre_id').val(undefined)

  })


})
