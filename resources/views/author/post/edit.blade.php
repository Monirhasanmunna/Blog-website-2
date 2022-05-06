@extends('layouts.backend.app')

@section('css')
<!-- Bootstrap Select Css -->
<link href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="row clearfix">
    <form action="{{route('author.post.update',[$post->id])}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Post
                    </h2>
                </div>
                <div class="body">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="title" class="form-control" name="title"
                                class="@error('name') is-invalid @enderror" value="{{$post->title}}">
                            <label class="form-label">Title</label>
                        </div>
                        @error('title')
                        <b class="text-danger">{{ $message }}!</b>
                        @enderror
                    </div>

                    <div class="from-group">
                        <label class="image">Fetured Image :</label>
                        <input type="file" name="image">
                    </div>
                    <br>
                    <div class="from-group">
                        <input class="filled-in" type="checkbox" id="publish" name="status" value="1" @if ($post->status == true)
                            checked
                        @endif>
                        <label for="publish">Publish</label>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Category and Tag
                    </h2>
                </div>
                <div class="body">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <p><strong>Select Category :</strong> </p>
                            <select name="categories[]" id="category" class="selectpicker" form-control show-tick
                                multiple>
                                @foreach ($categories as $category)
                                <option

                                @foreach($post->categories as $postCategory)
                                    {{$postCategory->id == $category->id ? 'selected' : ''}}
                                @endforeach
                                value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        
                        <div class="form-line">
                            <p><strong>Select Tag :</strong> </p>
                            <select name="tags[]" id="tag" class="selectpicker" form-control show-tick
                                multiple>
                                @foreach ($tags as $tag)
                                <option
                                
                                @foreach ($post->tags as $postTag)
                                    {{$postTag->id == $tag->id ? 'selected' : ''}}
                                @endforeach
                                
                                value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @error('tags[]')
                    <b class="text-danger">{{ $message }}!</b>
                    @enderror

                    <br>

                    <button type="submit" class="btn btn-primary  waves-effect">Update</button>
                    <a class="btn btn-danger mt-2" href="{{route('author.post.index')}}">Back</a>

                </div>
            </div>
        </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Edit Body
                </h2>
            </div>
            <div class="body">
                
                <textarea name="body" id="tinymce">{{$post->body}}</textarea>

            </div>
        </div>
    </div>
    </form>
</div>
@endsection

@section('script')
<!-- Select Plugin Js -->
<script src="{{asset('backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- TinyMCE -->
<script src="{{asset('backend/plugins/tinymce/tinymce.js')}}"></script>
<script>
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{asset('backend/plugins/tinymce')}}';
</script>
@endsection
