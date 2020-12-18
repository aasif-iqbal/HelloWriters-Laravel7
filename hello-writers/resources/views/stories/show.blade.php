@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $story->title }}
                    <a href="{{route('stories.index') }}" class="float-right">Back</a>
                </div>
                
                <div class="card-body">
                    {!!$story->body!!}
                    <p class="font-weight-bolder">
                        Status : {{$story->status == 1 ? 'Yes':'No'}}
                        Type : {{$story->type}}
                    </p>
                    <label for="">Created by:</label>
                <span class="font-italic text-info"><strong>{{$story->user->name}}</strong></span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
