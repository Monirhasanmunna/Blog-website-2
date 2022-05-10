@extends('layouts.backend.app')

@section('content')
<div class="container_fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Settings
                    </h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home_with_icon_title" data-toggle="tab" aria-expanded="true">
                                <i class="material-icons">manage_accounts</i> USER PROFILE
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">pin</i> CHANGE PASSWORD
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="home_with_icon_title">
                            <div class="card" style="box-shadow: 0px 0px 0px">
                                <div class="body">
                                    <form class="form-horizontal" method="POST" action="{{route('admin.settings.update',[$user->id])}}" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="full_name">Full Name :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="full_name" name="fullname" class="form-control" value="{{$user->name}}" class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('fullname')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="user_name">User Name :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="user_name" name="username" class="form-control" value="{{$user->username}}" class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('username')
                                                    <div class="alert text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email">Email Address :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" id="email" name="email" class="form-control"  value="{{$user->email}}" class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('email')
                                                    <div class="alert text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="image">Image :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" id="image" name="image" class="form-control" class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('image')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="about">About :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <textarea name="about" id="about" class="md-textarea form-control" rows="3">{{$user->about}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                            <div class="card" style="box-shadow: 0px 0px 0px">
                                <div class="body">
                                    <form class="form-horizontal" method="POST" action="{{route('admin.password.update',[$user->id])}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="oldpassword">Old Password :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="oldpassword" placeholder="Enter old password" name="oldpassword" class="form-control" class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('fullname')
                                                    <span class="alert text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="user_name">New Password :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" placeholder="Enter new password" id="user_name" name="newpassword" class="form-control"  class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('username')
                                                    <div class="alert text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="email">Confirm Password :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="password" id="email" placeholder="Enter password confirmation"  name="password_confirmation" class="form-control"  class="@error('title') is-invalid @enderror">
                                                    </div>
                                                </div>
                                                @error('email')
                                                    <div class="alert text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Password Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

