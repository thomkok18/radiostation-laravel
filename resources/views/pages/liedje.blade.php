@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 style="margin-bottom: 0;">Liedje</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/store/liedje')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="programma_id">Programma</label>
                        <select id="programma_id" class="form-control" name="programma_id">
                            @foreach($programmas as $programma)
                                <option value="{{$programma->id}}">{{$programma->naam}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="artiest">Naam van artiest</label>
                        <input id="artiest" type="text" name="artiestnaam" class="form-control" placeholder="Naam">
                    </div>
                    <div class="form-group">
                        <label for="liedje">Naam van liedje</label>
                        <input id="liedje" type="text" name="liedjenaam" class="form-control" placeholder="Naam">
                    </div>
                    <div class="form-group">
                        <label for="lengte">Lengte</label>
                        <input id="lengte" type="time" step="1" name="lengte" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>
    </div>
@endsection
