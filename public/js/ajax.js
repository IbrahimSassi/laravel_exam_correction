$(document).ready(function () {

  var selectedFilm = false;

  getAllFilm();

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
          '<td>' + '<button class="btnEdit" data-film="' + film.id + '">Edit</button>' + '</td>' +
          '</tr>'

        rows = rows + filmDom
      });
      $('table').html('')
      $('table').append(rows)

    })

  }

  $.get('http://127.0.0.1:8000/api/genre', function (result) {

    result.map(function (genre) {
      var genreOption = '<option value="' + genre.id + '">' + genre.nom + '}</option>'
      $('select').append(genreOption)
    });

  })

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


  //setTimeout used beacause the Edit button will be renderer using jquery so after the initial render
  // so if we dont use it , it will register click listener on button with class btnEdit which is unexistant yet
  setTimeout(function () {
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
  }, 1000)


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
