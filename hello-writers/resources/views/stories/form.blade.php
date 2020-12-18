<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="form-group">
    <label for="title">Blog Heading</label>
<input type="text" class="form-control @error('title') is-invalid @enderror"  name="title" id="" value="{{old('title', $story->title)}}">
    @error('title')
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
    @enderror
</div>
<div class="form-group">
    <label for="body">Blog Body</label>
    <textarea name="body" id="body"  rows="6" class="form-control @error('body') is-invalid @enderror  my-editor">{!! old('body', $story->body) !!}</textarea>
</textarea>
    @error('body')
<span class="invalid-feedback" role="alert">{{$message}}</span>
    @enderror
</div>

<div class="form-group">
    <label for="type">Read Type</label>
    <select name="type" class="form-control @error('type') is-invalid @enderror" value="">
        <option value="">--select--</option>
        <option value="short" {{'short' == old('type',$story->type)?'selected':''}}>Short</option>
        <option value="long" {{'long'== old('type',$story->type)?'selected':''}}>Long</option>
    </select>
    @error('type')
<span class="invalid-feedback" role="alert">{{$message}}</span>
    @enderror
    </div>  

    <div class="form-group">
      <label for="">Select Tags</label><br>
      @foreach ($tags as $tag)
      <div class="form-check form-check-inline  @error('tags') is-invalid @enderror"  data-toggle="tooltip" data-placement="top" title="Select Only One">
        <input class="form-check-input" type="checkbox" name="tags[]" id="tags" value="{{$tag->id}}"{{in_array($tag->id, old('tags',$story->tags->pluck('id')->toArray()) )? 'checked' : ""}}>
      <label class="form-check-label" for="">{{$tag->name}}</label>
      </div>
      @endforeach
      @error('tags')
        <span class="invalid-feedback" role="alert">{{$message}}</span>
    @enderror 
    </div>

    <div class="form-group">
        <label for="">Status</label>
        <div class="form-check @error('status') is-invalid @enderror">
            <input id="status" class="form-check-input" type="radio" name="status" value="1" 
            {{'1' == old('status', $story->status) ? 'checked':'' }} checked>
            <label for="my-input" class="form-check-label">Yes</label>
        </div>        
        <div class="form-check">
            <input id="status" class="form-check-input" type="radio" name="status" value="0"
            {{'0' == old('status', $story->status) ? 'checked':'' }}>
            <label for="my-input" class="form-check-label">No</label>
        </div>
        @error('status')
        <span class="invalid-feedback" role="alert">{{$message}}</span>
    @enderror 
    </div>

    <div class="form-group">
        <label for="image">Blog Image Upload</label>
        <div class="custom-file mb-3">          
          <input type="file" name="image" class="@error('image') is-invalid @enderror" id="file-input" data-toggle="tooltip" data-placement="top" title="*Upload Single Image*">
          {{ old('image', $story->image) }}
          {{-- Image output preview --}}
          <div id="thumb-output"></div>           
            @error('image')
        <div class="invalid-feedback" role="alert">{{$message}}</div>
        @enderror        
          </div>
        <img class="image-preview" src="{{$story->getThumbnailAttribute()}}">
          {{-- <div class="image-preview" id="imagePreview">
            <img height="270px;" src="" alt="Image Preview" class="image-preview__image">
            <span class="image-preview__default-text">Image Preview</span>
          </div> --}}
    </div>
      <script>
 //show upload image
 $(document).ready(function(){
  $('#file-input').on('change', function(){ //on file input change
     if (window.File) //check File API supported browser
     { 
         var data = $(this)[0].files; //this file data
          
         $.each(data, function(index, file){ //loop though each file
             if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                 var fRead = new FileReader(); //new filereader
                 fRead.onload = (function(file){ //trigger function on successful read
                 return function(e) {
                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
                     $('#thumb-output').append(img); //append image to output element
                     $('.image-preview').hide();
                 };
                 })(file);
                 fRead.readAsDataURL(file); //URL representing the file's data.
             }
         });
          
     }else{
         alert("Your browser doesn't support File API!"); //if File API is absent
     }
  });
 });  
 </script>
    
 {{-- <script src="../js/tinymce.min.js"></script> --}}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
   <script>
 var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",

    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "image code",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    //adding bootstrap class-'img-fluid' to make img responsive.
    image_class_list: [
    {title: 'Bootstrap', value: 'img-fluid'},
],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    //path
    relative_urls : false,
    remove_script_host : false,
    document_base_url : 'http://127.0.0.1:8000/',

    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    input.click();
  },

  //content_style: 'img { width: 100%;  height: auto; }'
// Prevent Bootstrap dialog from blocking focusin


/*
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";        
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }*/

 };
  tinymce.init(editor_config);
</script>


{{-- <script src="https://cdn.tiny.cloud/1/3dpytxub791mafosa34aqd8jxlyd6svc4tjuoyk6uz8zmzh4/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script>
//         tinymce.init({
//           selector: '#body'
//         });

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

{{-- for hosting:https://www.youtube.com/watch?v=skGZ8laUQco --}}