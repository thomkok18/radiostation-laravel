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
                <input type="text" id="liedjeInput" onkeyup="zoekLiedjes()" placeholder="Zoeken">
                <br><br>
                @if ($programma->getLiedjesById(request('id')) > 0)
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
                        <tbody>
                        @foreach($liedjes as $liedje)
                            @if($liedje->programma_id == $programma->id)
                                <tr class="liedjes">
                                    <th>{{$liedje->liedjenaam}}</th>
                                    <th>{{$liedje->artiestnaam}}</th>
                                    <th>{{$liedje->lengte}}</th>
                                    @auth
                                        @if(auth()->user()->id == $liedje->user_id)
                                            <th><a class="edit" href="/edit/liedje/{{$liedje->id}}">✎</a></th>
                                            <th>
                                                <input class="prullenbak" type="image" src="/img/prullenbak/prullenbakOpen.jpg" song-id="{{ $liedje->id }}" song-name="{{ $liedje->liedjenaam }}"
                                                       aria-hidden="true" data-toggle="modal" data-target="#destroyLiedjeModal">
                                            </th>
                                        @else
                                            <th></th>
                                            <th></th>
                                        @endif
                                    @endauth
                                </tr>
                            @endif

                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div>
                        Er zijn geen liedjes gevonden.
                    </div>
                @endif
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

        function zoekLiedjes() {
            // Declare variables
            var input, filter, home1, group, th0, th1, th2, i;
            input = document.getElementById('liedjeInput');
            filter = input.value.toUpperCase();
            home1 = document.getElementById("liedjesLijst");
            group = home1.getElementsByClassName('liedjes');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < group.length; i++) {
            th0 = group[i].getElementsByTagName("th")[0].innerHTML;
            th1 = group[i].getElementsByTagName("th")[1].innerHTML;
            th2 = group[i].getElementsByTagName("th")[2].innerHTML;
            if (th0.toUpperCase().indexOf(filter) > -1 || th1.toUpperCase().indexOf(filter) > -1 || th2.toUpperCase().indexOf(filter) > -1) {
                group[i].style.display = "";
                } else {
                    group[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
