@extends('layouts.app')

@section('content')

 @if(Session::has('flash_message'))
    <div class="alert-box {{ Session::get('flash_class') }} pos-top" >
     <a href="#" class="close">&times;</a>
        <span> {{ Session::get('flash_message') }} </span>
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile settings </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" 
                    action="{{ url('/admin/profile' ) }}/{{ Auth::user()->id }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }} " required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }} " disabled>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


              <div class="panel panel-default">
                <div class="panel-heading"> Change Password </div>
                <div class="panel-body">
                  <form action="{{ url('/admin/profile') }}/change-password/{{ Auth::user()->id }}" method="post">
                      <div class="form-group" style="margin-left:10px;margin-right:10px;">
                        <label>Enter Old Password </label>
                        <input type="password" name="oldPassword" class="form-control" required>
                      </div>
                      <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                          <label>Enter New password</label>
                          <input type="password" name="newPassword" class="form-control" required>
                        </div>

                        <div class="col-sm-6">
                          <label>Confirm New password</label>
                          <input type="password" name="confirmPassword" class="form-control" required>
                        </div>
                      </div>

                    <footer class="panel-footer text-right bg-light lter">
                      <button type="submit" class="btn btn-success btn-s-xs">Change password</button>
                    </footer>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
