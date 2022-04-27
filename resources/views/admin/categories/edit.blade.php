@extends('layouts.backend.app')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add Tag
                </h2>
            </div>
            <div class="body">
                <form action="{{route('admin.tag.update',[$tag->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="tag_name" class="form-control" name="name"  class="@error('name') is-invalid @enderror">
                            <label class="form-label">{{$tag->name}}</label>
                        </div>
                        @error('name')
                            <b class="text-danger">{{ $message }}!</b>
                        @enderror
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary  waves-effect">Submit</button>
                    <a class="btn btn-danger mt-2" href="{{route('admin.tag.index')}}">Back</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
