@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <a href="/" class="btn btn-secondary">← Ga terug</a><br><br>
        <div class="card">
            <div class="card-header">
                <h3 style="margin-bottom: 0;">Liedje</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/update/liedje/'.$liedje->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="programma">Programma</label>
                        <select id="programma" class="form-control" name="programma">
                            @foreach($programmas as $programma)
                                @if(auth()->user()->id == $programma->user_id)
                                    <option {{$programma->id == $liedje->programma_id ? 'selected' : '' }} value="{{$programma->id}}">{{$programma->naam}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="artiest">Naam van artiest</label>
                        <input id="artiest" type="text" name="artiestnaam" class="form-control" placeholder="Naam" value="{{$liedje->artiestnaam}}">
                    </div>
                    <div class="form-group">
                        <label for="liedje">Naam van liedje</label>
                        <input id="liedje" type="text" name="liedjenaam" class="form-control" placeholder="Naam" value="{{$liedje->liedjenaam}}">
                    </div>
                    <div class="form-group">
                        <label for="lengte">Lengte</label>
                        <input id="lengte" type="time" step="1" name="lengte" class="form-control" value="{{$liedje->lengte}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>
@endsection
