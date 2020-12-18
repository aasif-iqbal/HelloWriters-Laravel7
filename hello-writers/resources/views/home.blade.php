@extends('layouts.app')
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                {{-- <div class="card-header text-center text-info text-monospace">{{ __('Welcome') }}</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h2 class="text-secondary"></h2>
                        <img src="" class="img-fluid" alt="">
                        <p style="font-family: 'Dancing Script', cursive; font-size: 300%;">
                            Hi, {{auth()->user()->name}} <br>
                            Share Your Story with us.
                        </p>
                        <label for="" style="font-size: 300%">Check Our Latest Story</label>
                        <br>
                    <a href="{{route('stories.index')}}" style="font-size: 200%" class="btn btn-outline-success btn-lg">Story</a>                          
                    <br/>
                    <span class="float-right">
                    {{ __('You are logged !n') }}
                </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
