@extends('layouts.app')

@section('title', 'Create New User')

@section('content')

  <div class="container">

    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-1 col-lg-offset-1 col-sm-offset-1" style="background-color: #fff;">
      <h1 class="text-center">Create New User</h1>

      <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('users.store')}}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Name</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username" class="col-md-4 control-label">Username</label>

                  <div class="col-md-6">
                      <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                      @if ($errors->has('username'))
                          <span class="help-block">
                              <strong>{{ $errors->first('username') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                  <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                <label for="description" class="col-md-4 control-label">Description</label>
                <div class="col-md-6">
                  <textarea placeholder="Nullable" style="resize: vertical" id="description" name="description" rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="position" class="col-md-4 control-label">Position</label>
                <div class="col-md-6">
                  <input type="text" id="position" class="form-control" name="position" placeholder="Nullable, eg: Front End Developer">
                </div>
              </div>

              <div class="form-group">
                <label for="role" class="col-md-4 control-label">Role</label>
                <div class="col-md-6">
                  <select class="form-control" id="role" name="role">
                    <option>Select Role</option>
                    <option value="2">Programmer</option>
                    <option value="3">Client</option>
                  </select> {{-- month picker --}}
                </div>
              </div>

              <input type="hidden" name="status" value="active">

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-md-4 control-label">Password</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                  <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-default">
                          Submit
                      </button>
                  </div>
              </div>
          </form>
      </div>
    </div>

  </div> <!-- /container -->

@endsection
