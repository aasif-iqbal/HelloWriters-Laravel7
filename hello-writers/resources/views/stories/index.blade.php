@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Storify') }}
                    @can('create', App\Story::class)
                    <a href="{{route('stories.create')}}" class="float-right">Add Story</a>    
                    @endcan
                </div>                    
                <div class="card-body">
                    <div class="table-responsive">
               <table class="table">
                   <thead>
                   <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Tags</th>
                    <th>Status</th>
                    <th>Action</th>
                   </tr>
                   </thead>
                   <tbody>
                    @foreach ($stories as $story)
                        <tr>
                            <td><img src="{{$story->thumbnail}}" class="img-fluid"  alt="image" width="200"></td>
                            <td>{{$story->title}}</td>
                            <td>{{$story->type}}</td>
                            <td>
                                @foreach($story->tags as $tag)
                                #{{$tag->name}}
                                @endforeach
                            </td>
                            <td>{{$story->status == 1 ? 'Yes' : 'No'}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                @can('view', $story)
                                     <a href="{{route('stories.show', [$story->id]) }}" class="btn btn-primary mx-1">View</a>
                                @endcan
                                @can('update', $story)
                                    <a href="{{route('stories.edit', [$story->id])}}" class="btn btn-success mx-1">Edit</a>
                                @endcan
                                @can('delete', $story)
                                    <form action="{{route('stories.destroy',[$story])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                @endcan
                                    </div>
                                    
                               </form>
                            </td>
                        </tr>                        
                    @endforeach
                   </tbody>
               </table>   
                    </div>
               <ul class="pagination justify-content-center">
                        {{$stories->links()}}
                <ul>                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

