@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <div class="text-center">{{$error}}</div>
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">
        <div class="text-center">{{session('success')}}</div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <div class="container">{{session('error')}}</div>
    </div>
@endif
