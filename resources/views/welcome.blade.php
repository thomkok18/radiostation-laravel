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
                <input type="text" id="programmaInput" onkeyup="zoekProgramma()" placeholder="Zoeken">
                <br><br>
                @if (count($programmas))
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
                        <tbody>

                        @foreach($programmas as $programma)
                            <tr class="programma">
                                <th><a href="/programma/{{$programma->id}}">{{$programma->naam}}</a></th>
                                <th>{{$programma->starttijd}}</th>
                                <th>{{$programma->eindtijd}}</th>
                                <th>{{$programma->datum}}</th>
                                @auth
                                    @if(auth()->user()->id == $programma->user_id)
                                        <th><a class="edit" href="/edit/programma/{{$programma->id}}">✎</a></th>
                                        <th>
                                            <input class="prullenbak" type="image" src="/img/prullenbak/prullenbakOpen.jpg" program-id="{{ $programma->id }}" program-name="{{ $programma->naam }}"
                                                   aria-hidden="true" data-toggle="modal" data-target="#destroyProgrammaModal">
                                        </th>
                                    @else
                                        <th></th>
                                        <th></th>
                                    @endif
                                @endauth
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div>
                        Er zijn geen programma's gevonden.
                    </div>
                @endif
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
        $(function () {
            $('.prullenbak').click(function () {
                $('#deleteProgram').attr('action', '/delete/programma/' + $(this).attr('program-id'));
                $('#programmaNaam').text('Weet u zeker dat u ' + $(this).attr('program-name') + ' wilt verwijderen?');
            });
        });

        function zoekProgramma() {
            // Declare variables
            var input, filter, home1, group, th0, th1, th2, th3, i;
            input = document.getElementById('programmaInput');
            filter = input.value.toUpperCase();
            home1 = document.getElementById("programmaLijst");
            group = home1.getElementsByClassName('programma');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < group.length; i++) {
                th0 = group[i].getElementsByTagName("a")[0].innerHTML;
                th1 = group[i].getElementsByTagName("th")[1].innerHTML;
                th2 = group[i].getElementsByTagName("th")[2].innerHTML;
                th3 = group[i].getElementsByTagName("th")[3].innerHTML;
                if (th0.toUpperCase().indexOf(filter) > -1 || th1.toUpperCase().indexOf(filter) > -1 || th2.toUpperCase().indexOf(filter) > -1 || th3.toUpperCase().indexOf(filter) > -1) {
                    group[i].style.display = "";
                } else {
                    group[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
