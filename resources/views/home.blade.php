@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div id="home" class="pt-5 text-center">
    <h1>Tweet Reach Calculator</h1>
    <p class="lead">Use the field below to paste the URL of a tweet .<br> Then click on the button to get the reach of the tweet.</p>
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <form action="{{ url('/') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" name="url" class="form-control form-control-lg{{ ($errors->has('url') || (isset($reach) && !$reach)) ? ' is-invalid' : '' }}" placeholder="https://twitter.com/mcuban/status/1038157769633931265" value="{{ old('url',isset($url)? $url : '') }}" required>
                    
                    @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                    @endif

                    @isset($reach)
                    @if(!$reach)
                    <div class="invalid-feedback">
                        Something went wrong.Please make sure you used a correct Tweet URL and try again.
                    </div>
                    @endif
                    @endisset
                </div>

                <button type="submit" class="btn btn-primary">Get Reach</button>
            </form>



        </div>
    </div>
    @isset($reach)
    @if($reach != false)
    <div class="row justify-content-md-center mt-5">
        <div class="col col-lg-4">
            <div class="card border-info">
                <div class="card-header">REACH</div>
                <div class="card-body text-info">
                    <h1 class="card-title">{{ $reach }}</h1>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endisset
</div>


@endsection