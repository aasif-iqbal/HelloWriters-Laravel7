@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-8">
            <div class="card">
                <div class="card-header">
                Add Story   
                <a href="{{route('stories.index')}}" class="float-right">Back</a>
                </div>                
                <div class="card-body">  
                                    
                <form action="{{route('stories.store')}}" class="img-fluid" method="POST" enctype="multipart/form-data">     
                    @csrf                  
                    @include('stories.form')
                    <br><br><br><br>
                        <button type="submit" class="btn btn-primary float-right btn-lg">Add Story</button>
                    </form> 
                </div>            
            </div>
        </div>
    </div>
</div>
@endsection
