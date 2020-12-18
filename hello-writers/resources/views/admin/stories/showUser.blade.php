@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Show All Users') }}
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
                    <th>Author</th>
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
                            <td>{{$story->user->name}}</td>
                            <td>{{$story->status == 1 ? 'Yes' : 'No'}}</td>
                            <td>
                                <form action="{{route('admin.stories.delete',[$story])}}" method="POST" style="display: inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
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

