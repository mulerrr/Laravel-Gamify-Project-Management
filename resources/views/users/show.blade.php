@extends('layouts.app')

@section('title', $user->name)

@section('content')

  <div class="container-fluid">

    <div class="col-md-8 col-md-offset-2 user-card-wrapper">
      <div class="row">
        <div class="col-md-5">
          <div class="row">
            <div class="user-card-left">
              <img class="user-avatar" src="{{ asset($user->avatar) }}">
              <button type="button" data-toggle="modal" data-target="#change-avatar-form" class="btn btn-white" style="margin-bottom: 30px;">Change Avatar</button>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="user-card-right">
            <h2>{{ $user->name }}</h2>
            <span class="user-card-username">{{ $user->username }}</span><br>
            <span class="user-card-position">{{ $user->position }}</span>
            <h3>About :</h3>
            <p>{{ $user->description }}</p>
            <p>{{ $user->email }}</p>

            <div class="user-card-right-btn">
              <a href="/users/{{$user->id}}/edit" class="btn btn-default" style="margin-right: 10px;">Edit Profile</a>
              <a href="/users/{{$user->id}}/edit" class="btn btn-success">Change Password</a>
            </div>
          </div>
        </div>
      </div>

      @include('partials.change-avatar')
    </div>
  </div> <!-- /container -->

@endsection

@section('javascript')

  <script type="text/javascript">

      

      $(document).ready(function() {
        function avatarForm(){
            $('#change-avatar-form').modal('show');
            $('#change-avatar-form form')[0].reset();
        }
      });

  </script>

@endsection
