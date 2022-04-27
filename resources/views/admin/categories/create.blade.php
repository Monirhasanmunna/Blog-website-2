@extends('layouts.backend.app')

@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Add Category
                </h2>
            </div>
            <div class="body">
                <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="tag_name" class="form-control" name="name"
                                class="@error('name') is-invalid @enderror">
                            <label class="form-label">Category Name</label>
                        </div>
                        @error('name')
                            <b class="text-danger">{{ $message }}!</b>
                            @enderror
                        <br>
                        <div class="mb-3">      
                            <input class="form-control form-control-sm" id="formFileSm" type="file" name="image">
                          </div>

                        @error('image')
                        <b class="text-danger">{{ $message }}!</b>
                        @enderror
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary  waves-effect">Submit</button>
                    <a class="btn btn-danger mt-2" href="{{route('admin.category.index')}}">Back</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
