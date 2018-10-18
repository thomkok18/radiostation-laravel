@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <a href="/" class="btn btn-secondary">← Ga terug</a><br><br>
        <div class="card">
            <div class="card-header">
                <h3 style="margin-bottom: 0;">Programma</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/update/programma/'.$programma->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="programma">Naam van programma</label>
                        <input id="programma" type="text" name="naam" class="form-control" value="{{$programma->naam}}" placeholder="Naam">
                    </div>
                    <div class="form-group">
                        <label for="starttijd">Starttijd</label>
                        <input id="starttijd" type="time" step="1" name="starttijd" class="form-control" value="{{$programma->starttijd}}">
                    </div>
                    <div class="form-group">
                        <label for="eindtijd">Eindtijd</label>
                        <input id="eindtijd" type="time" step="1" name="eindtijd" class="form-control" value="{{$programma->eindtijd}}">
                    </div>
                    <div class="form-group">
                        <label for="datum">Datum</label>
                        <input id="datum" type="date" name="datum" class="form-control" value="{{$programma->datum}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>
@endsection
