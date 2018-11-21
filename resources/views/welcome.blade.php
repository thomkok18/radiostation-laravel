@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 style="margin-bottom: 0;">Programma's</h3>
            </div>
            <div id="programmaLijst" class="card-body">
                <input type="text" id="programmaInput" onkeyup="searchPrograms()" placeholder="Zoeken">
                <br><br>
                <table style="text-align: center;" class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Programma</th>
                        <th scope="col">Starttijd</th>
                        <th scope="col">Eindtijd</th>
                        <th scope="col">Datum</th>
                        @auth
                            <th scope="col">Wijzigen</th>
                            <th scope="col">Verwijderen</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody id="programmas">

                    </tbody>
                </table>
                <div id="geenProgramma">
                    Er zijn geen programma's gevonden.
                </div>
            </div>
        </div>
    </div>

    <div id="destroyProgrammaModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="programmaNaam" class="modal-title">Weet u het zeker?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    <form id="deleteProgram" action="/delete/programma" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Verwijderen</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function prullenbak(programma_id, programma_naam) {
            document.getElementById('deleteProgram').setAttribute('action', '/delete/programma/' + programma_id);
            document.getElementById('programmaNaam').innerText = 'Weet u zeker dat u ' + programma_naam + ' wilt verwijderen?';
        }

        $(function () {
            searchPrograms();
        });

        function searchPrograms() {
            var search = $('#programmaInput').val();

            $.ajax({
                url: '/searchPrograms',
                dataType: 'json',
                type: 'GET',
                data: {search: search},
                success: function (data) {
                    if (data.length > 0) {
                        $('#geenProgramma').hide();
                    } else {
                        $('#geenProgramma').show();
                    }


                    $('#programmas').html('');
                    $.each(data, function (index, value) {
                        var user_id = parseInt('<?= $user_id; ?>');
                        var buttons = '';

                        var values = "<tr><th><a href='programma/" + value.id + "'>" + value.naam + "</a></th>" +
                            "<td>" + value.starttijd + "</td>" +
                            "<td>" + value.eindtijd + "</td>" +
                            "<td>" + value.datum + "</td>";

                        if (user_id === value.user_id) {
                                @auth
                                    buttons = "<th><a class=\"edit\" href=\'/edit/programma/" + value.id + "\'>✎</a></th>" +
                                "<th>" +
                                "<input onclick=\"prullenbak(" + value.id + ",'" + value.naam + "')\" class=\"prullenbak\" type=\"image\" src=\"/img/prullenbak/prullenbakOpen.jpg\" aria-hidden=\"true\" data-toggle=\"modal\" data-target=\"#destroyProgrammaModal\">\n" +
                                "</th>";
                            @endauth
                        } else {
                            @auth
                                buttons = "<th></th><th></th>";
                            @endauth
                        }

                        var closeRow = "</tr>";

                        $('#programmas').append(values + buttons + closeRow);
                    });
                }
            });
        }
    </script>
@endsection
