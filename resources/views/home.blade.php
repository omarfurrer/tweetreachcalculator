@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div id="home" class="pt-5 text-center">
    <h1>Tweet Reach Calculator</h1>
    <p class="lead">Use the field below to paste the URL of a tweet .<br> Then click on the button to get the reach of the tweet.</p>
    <div class="row justify-content-md-center">
        <div class="col col-lg-6">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="https://twitter.com/mcuban/status/1038157769633931265" required>
                </div>

                <button type="submit" class="btn btn-primary">Get Reach</button>
            </form>
        </div>
    </div>
</div>


@endsection