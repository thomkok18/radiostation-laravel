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
                <input type="text" id="programmaInput" onkeyup="zoekProgramma()" placeholder="Zoek Programma">
                <br><br>
                @if (count($programmas))
                    <table style="text-align: center;" class="table table-light">
                        <thead>
                        <tr>
                            <th scope="col">Programma</th>
                            <th scope="col">Starttijd</th>
                            <th scope="col">Eindtijd</th>
                            <th scope="col">Wijzigen</th>
                            <th scope="col">Verwijderen</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($programmas as $programma)
                            <tr class="programma">
                                <th><a href="/programma/{{$programma->id}}">{{$programma->naam}}</a></th>
                                <th>{{$programma->starttijd}}</th>
                                <th>{{$programma->eindtijd}}</th>
                                <th><a class="edit" href="/edit/programma/{{$programma->id}}">✎</a></th>
                                <th>
                                    <form action="/delete/programma/{{$programma->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="prullenbak" type="image" src="/img/prullenbak/prullenbakOpen.jpg">
                                    </form>
                                </th>
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
    <script>
        function zoekProgramma() {
            // Declare variables
            var input, filter, home1, group, a, i;
            input = document.getElementById('programmaInput');
            filter = input.value.toUpperCase();
            home1 = document.getElementById("programmaLijst");
            group = home1.getElementsByClassName('programma');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < group.length; i++) {
                a = group[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    group[i].style.display = "";
                } else {
                    group[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
