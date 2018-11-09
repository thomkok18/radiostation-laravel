@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/liedjesoverzicht.css') }}">
    <br>
    <div class="container">
        <a href="/" class="btn btn-secondary">← Ga terug</a><br><br>
        <div class="card">
            <div class="card-header">
                <h3 style="margin-bottom: 0;">{{$programma->naam}}</h3>
            </div>
            <div id="liedjesLijst" class="card-body">
                <input type="text" id="liedjeInput" onkeyup="searchSongs()" placeholder="Zoeken">
                <br><br>
                <table style="text-align: center;" class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Liedje</th>
                        <th scope="col">Artiest</th>
                        <th scope="col">Lengte</th>
                        @auth
                            <th scope="col">Wijzigen</th>
                            <th scope="col">Verwijderen</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody id="liedjes">

                    </tbody>
                </table>
                <div id="geenLiedje">
                    Er zijn geen liedjes gevonden.
                </div>
            </div>
        </div>
    </div>

    <div id="destroyLiedjeModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="liedjeNaam" class="modal-title">Weet u het zeker?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <form id="deleteSong" action="/delete/liedje" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Verwijderen</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('.prullenbak').click(function () {
                $('#deleteSong').attr('action', '/delete/liedje/' + $(this).attr('song-id'));
                $('#liedjeNaam').text('Weet u zeker dat u ' + $(this).attr('song-name') + ' wilt verwijderen?');
            });
        });

        $(function () {
            searchSongs();
        });

        function searchSongs() {
            var search = $('#liedjeInput').val();
            var program_id = '<?= request('id'); ?>';

            $.ajax({
                url: "/searchSongs/",
                dataType: 'json',
                type: 'GET',
                data: {search: search, program_id: program_id},
                success: function (data) {
                    if (data.length > 0) {
                        $('#geenLiedje').hide();
                    } else {
                        $('#geenLiedje').show();
                    }

                    $('#liedjes').html('');
                    $.each(data, function (index, value) {
                        $('#liedjes').append("<tr><th>" + value.liedjenaam + "</th>" +
                            "<td>" + value.artiestnaam + "</td>" +
                            "<td>" + value.lengte + "</td>" +
                            @auth
                                "<th><a class=\"edit\" href=\'/edit/liedje/" + value.id + "\'>✎</a></th>" +
                            "<th>" +
                            "<input class=\"prullenbak\" type=\"image\" src=\"/img/prullenbak/prullenbakOpen.jpg\" aria-hidden=\"true\" data-toggle=\"modal\" data-target=\"#destroyLiedjeModal\">\n" +
                            "</th>" +
                            @endauth
                                "</tr>");
                        document.getElementById("deleteSong").setAttribute('action', '/delete/liedje/' + value.id);
                    });
                }
            });
        }
    </script>
@endsection
