@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

  <div class="container">

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">

      <!-- Example row of columns -->
      <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: #fff;">

        <form method="post" action="{{ route('users.update',[$user->id]) }}" enctype="multipart/form-data" data-toggle="validator">
          {{ csrf_field() }}

          <input type="hidden" name="_method" value="put">

          <div class="form-group">
            <label for="user-name">Name<span class="required">*</span></label>
            <input type="text" placeholder="Enter Name" id="user-name" required name="name" spellcheck="false" class="form-control" value="{{ $user->name }}">
            <span class="help-block with-errors"></span>
          </div>

          <div class="form-group">
            <label for="username">Username<span class="required">*</span></label>
            <input type="text" placeholder="Enter Username" id="username" required name="username" spellcheck="false" class="form-control" value="{{ $user->username }}">
            <span class="help-block with-errors"></span>
          </div>

          <div class="form-group">
            <label for="position">Position<span class="required">*</span></label>
            <input type="text" placeholder="Enter Position" id="position" required name="position" spellcheck="false" class="form-control" value="{{ $user->position }}">
            <span class="help-block with-errors"></span>
          </div>

          <div class="form-group">
            <label for="email">Email<span class="required">*</span></label>
            <input type="email" placeholder="Enter Email" id="email" name="email" spellcheck="false" class="form-control" value="{{ $user->email }}" required>
            <span class="help-block with-errors"></span>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea placeholder="Enter Description" style="resize: vertical" id="description" name="description" rows="5" spellcheck="false" class="form-control autosize-target text-left" required>{{ $user->description }}</textarea>
            <span class="help-block with-errors"></span>
          </div>

          {{-- <div class="form-group">
            <label for="avatar" class="control-label">Avatar</label>
            <div>
              <input type="file" id="avatar" name="avatar" class="form-control">
              <span class="help-block with-errors"></span>
            </div>
          </div> --}}

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
          </div>
          
        </form>
          

      </div>
    </div>

  </div> <!-- /container -->

@endsection
