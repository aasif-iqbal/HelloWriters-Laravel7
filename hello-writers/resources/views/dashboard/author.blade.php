<link rel="stylesheet" href="{{asset('/css/style.css')}}">
          
@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row col-md-12">
    <div class="col-md-3">
      @foreach ($users as $user) 
      <div class="card my-2">       
        <div class="card-body">
          <img src="{{getProfileImage($user->profile_image)}}" class="img-fluid profile-pic rounded-circle"  alt="image" height="100%" width="100%">
        <h5 class="card-title text-center pt-3">{{getAuthorName($user->name)}}</h5>
        @endforeach
        @foreach ($profile as $users_profile) 
        <p class="card-text text-center">{{$users_profile->biography}}</p>  
        @endforeach
        </div>
      </div>
      
    </div>
  
    <div class="col-md-9">
      @foreach ($stories as $story) 
      <div class="card my-2">
        <div class="row no-gutters">
          <div class="col-md-4">
            <a href="{{route('dashboard.show', [$story])}}" class="stretched-link text-dark">
            <img src="{{getThumbnailAttribute($story->image)}}" class="img-fluid" height="" ></a>           
          </div>
        
          <div class="col-md-8">                     
            <div class="card-body">
              <a href="{{route('dashboard.show', [$story])}}" class="stretched-link text-dark">
            <h5 class="card-title">{{$story->title}}</h5>
          </a>
            <p class="card-text">{{getStory($story->body)}}<br>
              <small class="text-muted">Created At:{{$story->getCreatedAt()}}</small></p>
              {{-- <p class="card-text"> --}}
                {{-- <small class="text-muted">{{$story->getCreatedAt()}}</small></p> --}}
                
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    
</div>
<ul class="pagination justify-content-center mt-4">
      {{$stories->withQueryString()->links()}}
  </ul>                        
</div>
@endsection