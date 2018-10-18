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
                <input type="text" id="liedjeInput" onkeyup="zoekLiedjes()" placeholder="Zoek Liedje">
                <br><br>
                <table style="text-align: center;" class="table table-light">
                    <thead>
                    <tr>
                        <th scope="col">Liedjenaam</th>
                        <th scope="col">Artiestnaam</th>
                        <th scope="col">Lengte</th>
                        <th scope="col">Wijzigen</th>
                        <th scope="col">Verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($liedjes))
                            @foreach($liedjes as $liedje)
                                @if($liedje->programma_id == $programma->id)
                                    <tr class="programma">
                                        <th>{{$liedje->liedjenaam}}</th>
                                        <th>{{$liedje->artiestnaam}}</th>
                                        <th>{{$liedje->lengte}}</th>
                                        <th><a class="edit" href="/beheerder/gebruiker/edit/{{$programma->id}}">✎</a></th>
                                        <th>
                                            <form action="/programma/destroy/{{$programma->id}}" method="POST">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <input class="prullenbak" type="image" src="/img/prullenbak/prullenbakOpen.jpg">
                                            </form>
                                        </th>
                                    </tr>
                                @endif
                            @endforeach
                    @else
                        <div>
                            Er zijn geen programma's gevonden.
                        </div>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function zoekLiedjes() {
            // Declare variables
            var input, filter, home1, group, a, i;
            input = document.getElementById('liedjeInput');
            filter = input.value.toUpperCase();
            home1 = document.getElementById("liedjesLijst");
            group = home1.getElementsByClassName('liedjes');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < group.length; i++) {
                a = group[i].getElementsByTagName("p")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    group[i].style.display = "";
                } else {
                    group[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
