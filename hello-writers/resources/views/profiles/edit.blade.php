@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                Edit Profile
                <a href="" class="float-right">Back</a>
                </div>                
                <div class="card-body"> 
                   
                <form action="{{route('profiles.update', [$user])}}" method="POST" enctype="multipart/form-data">  
                    @csrf  
                    @method('PUT') 
                    
                    <div class="form-row">
                        <div class="col-md-6">
                    {{-- <img class="profile-pic img-fluid rounded-circle" src="/storage/profile_images.png" height="200" width="200" id="profile_pic_hide"/>  --}}

                <img src="{{ $user->editProfileImage() ?? ''}}"    class="profile-pic rounded-circle"  alt="image" height="200"width="200" id="profile_pic_show"/>                      
                        <div class="upload-button">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </div>
                        <br/>
                        <input type="file" class="file-upload @error('profile_image') is-invalid @enderror"  accept="image/*" name="profile_image">

                        @error('profile_image')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror 
                        </div>
                        <div class="col-md-6">
                            <label for="name">Author Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $user->name)}}" name="name" placeholder="Eg. John Deo">
                        <small class="form-text text-muted">Eg. John Deo</small>
                        @error('name')
                        <span class="invalid-feedback" role="alert">{{$message}}</span>
                            @enderror
                            <br/><br/>

                            <div class="form-group">
                                <label for="email">Email</label>
                                    <input type="email" class="form-control"  name="email" value="{{old('email', $user->email)}}" placeholder="Eg. JohnDeo_9@storify.com" readonly="readonly">
                                     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>    
                        </div>
                    </div>
                    <br/>
                    
                                   
                    <div class="form-group">
                        <label for="biography">Author Bio</label>
                    <textarea class="form-control @error('biography') is-invalid @enderror" rows="3" name="biography"  placeholder="">{{old('biography',     $user->profile->biography ?? '')}}</textarea>
                    <small class="form-text text-muted">Eg. John Deo is a freelance writer and content creator based from Portland.</small>
                    @error('biography')
                    <span class="invalid-feedback" role="alert">{{$message}}</span>    
                    @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="">Address</label>
                      <input type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address', $user->profile->address ?? '')}}">
                        <small class="form-text text-muted">Eg. Lawrence Moreno, Tortor Street ,Santa Rosa MN 98804</small>
                        @error('address')
                            <span class="invalid-feedback" role="alert">{{$message}}</span>    
                        @enderror
                      </div>
                    
                    
                    <button type="submit" class="btn btn-primary btn-lg float-right">Update Profile</button>
                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
 $(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });

   // var profile_pic_show = document.getElementById("profile_pic_show");
   // var profile_pic_hide = document.getElementById("profile_pic_hide");

  //if ($user.profile) {
   // profile_pic_hide.style.visibility = 'hidden';
  //} else {
    //profile_pic_show.style.visibility = 'visible';
  //}
});
</script>