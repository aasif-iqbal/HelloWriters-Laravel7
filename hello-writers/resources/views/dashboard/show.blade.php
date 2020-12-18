@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
            <div class="text-center mt-4">
                {{-- <a href="{{route('stories.index') }}" class="float-right mr-3">Back</a> --}}
                <h1 style="font-size: 300%">{{ $story->title }}</h1>
              <p class="text-muted">
                Written By : {{$story->getAuthorName()}} </p>
            <label class="font-weight-light" for="">Last Updated:</label><span class="font-weight-light">{{$story->getUpdatedAt()}}</span>
                   
            <img src="{{$story->getThumbnailAttribute()}}" class="img-fluid"  alt="image" width="90%" height="auto">
                
                </div>
                
                <div class="card-body">
                   <div class="" style="font-size: 20px;"> {!!$story->body!!} 
                </div>
                <hr>                 
                <div>
                  @comments(['model' => $story])
                </div>
                <hr>
                  @include('dashboard.author_bio')
                </div>
            
            </div>
        </div> 
    </div>
</div>
@endsection
