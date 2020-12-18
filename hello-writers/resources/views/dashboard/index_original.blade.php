<link rel="stylesheet" href="{{asset('/css/style.css')}}">
          
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('dashboard.header')
    <div class="row justify-content-center">        
        <div class="col-md-6">
            <div class="card">                
                <div class="card-header">{{ __('Storify') }}   
                    <div class="float-right">
                        <span class="btn-group">
                        <a href="{{route('dashboard.index') }}" class="btn btn-outline-info btn-sm">All</a>
                        <a href="{{route('dashboard.index', ['type'=>'long']) }}" class="btn btn-outline-info btn-sm">Long</a>
                        <a href="{{route('dashboard.index',['type'=>'short'])}}" class="btn btn-outline-info btn-sm">Short</a></span>
                    </div>                    
                </div>  
            </div>  
            @foreach($stories as $story)                
                <div class="card mt-5">
               
                    <div class="text-center">
                        <h3 class="text-monospace">
                            <a href="{{route('dashboard.show', [$story])}}" class="text-info"> 
                            {{$story->title}}</a>
                            </h3>
                        
                        <a href="{{route('dashboard.show', [$story])}}">
                    <img src="{{$story->thumbnail}}" class="img-fluid mt-2 pl-4"  alt="image" height="auto" width="100%"></a>
                
                           <br>
                           <span class="text-muted">
                               {{$story->getCreatedAt()}}
                            </span>&nbsp;&#8226;&nbsp; 
                            <span class="text-secondary">Read:{{$story->type}}</span> 
                            &nbsp;&#8226;&nbsp; 
                            <span class="text-secondary">Tags:@foreach($story->tags as $tag)
                                #{{$tag->name}}
                                @endforeach</span>  
                                <br><br>   
                                <label class="text-dark"><svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-pen" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                  </svg></label>
                                       
                                <span class="text-dark font-italic" style="font-size: 1em"> {{$story->user->name}}</span>                           
                            </div>
                
            </div>
            @endforeach
             <ul class="pagination justify-content-center mt-4">
                        {{$stories->withQueryString()->links()}}
               </ul>                        

        </div>
    </div>
</div>
@endsection

{{-- {{dd(DB::getQueryLog())}} --}}
