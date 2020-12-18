<link rel="stylesheet" href="{{asset('/css/style.css')}}">
          
@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="row col-md-12">
    <div class="col-md-3">
      <div class="card mb-4">      
      <span class="btn-group">
        <a href="{{route('dashboard.index') }}" class="btn btn-outline-info btn-sm">Read All</a>
        <a href="{{route('dashboard.index', ['type'=>'long']) }}" class="btn btn-outline-info btn-sm">Long</a>
        <a href="{{route('dashboard.index',['type'=>'short'])}}" class="btn btn-outline-info btn-sm">Short</a>
      </span>
      </div>

      {{-- <div class="card mb-4">
          <input type="text" class="form-control" placeholder="search...">
      </div> --}}

      <div class="card">
        <h4 class="card-title text-center mt-3">Latest Blog</h4>
        <ul class="list-group list-group-flush">
          @foreach($stories as $story)    
          <a href="{{route('dashboard.show', [$story])}}" class="text-dark"> 
            <li class="list-group-item border border-white">{{$story->title}}</li>
          </a>
          @endforeach
        </ul>
      </div>
      {{-- Tags --}}
      {{-- <div class="card mt-3">
        <h4 class="card-title text-center">Tags</h4>        
          @foreach($tags as $tag)    
              <label for="">
                #{{$tag->name ?? ''}}&nbsp;
              </label>
          @endforeach                        
      </div> --}}

    </div>{{-- "col-md-3" --}}
    
<div class="col-md-9">
  <div class="row cols-md-3">  
    @foreach($stories as $story)    
    <div class="card my-2 mx-2 h-100" style="width: 28rem">
        <a href="{{route('dashboard.show', [$story])}}">
       <img src="{{$story->getThumbnailAttribute()}}" class="img-fluid" width="100%" height="auto">
        </a> 
        <span class="text-secondary ml-2">
          @foreach($story->tags as $tag)
                  #{{$tag->name}}
          @endforeach
         <p class="float-right mr-2">{{$story->getCreatedAt()}}</p>
        </span>            
      <h5 class="card-title text-uppercase text-monospace ml-3">{{$story->title}}</h5>          
    </div>
    @endforeach  
  </div>
</div>      
    </div>
    <ul class="pagination justify-content-center mt-4">
      {{$stories->withQueryString()->links()}}
</ul>                        
    
    
    </div>
  </div>
  </div>
</div>


@endsection