@extends('layouts.app')

@section('content')

  <div class="container">

    <div class="row col-md-9 col-lg-9 col-sm-9 pull-left">
      <!-- Jumbotron -->
      <div class="well well-lg">
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{ $project->description }}</p>
        {{-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> --}}
      </div>

      <!-- Example row of columns -->
      <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: #fff; margin: 10px;">
        {{-- <a href="/projects/create/{{ $project->id }}" class="pull-right btn btn-default btn-sm">Add Project</a> --}}

        <br>

        @include('partials.comments')

        <div class="row container-fluid">

          <form method="post" action="{{ route('comments.store')}}">
            {{ csrf_field() }}

            {{-- <div class="form-group">
              <label for="company-name">Url (proof of work done)<span class="required">*</span></label>
              <input type="text" placeholder="Enter url" id="company-name" required name="name" spellcheck="false" class="form-control">
            </div> --}}

            <input type="hidden" name="commentable_type" value="App\Project">
            <input type="hidden" name="commentable_id" value="{{$project->id}}">

            <div class="form-group">
              <label for="comment-content">Comment</label>
              <textarea placeholder="Enter Comment" style="resize: vertical" id="comment-content" name="body" rows="3" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <div class="form-group">
              <label for="comment-content">Proof of work done(Rrl/Photos)</label>
              <textarea placeholder="Enter url or screenshoot" style="resize: vertical" id="comment-content" name="url" rows="2" spellcheck="false" class="form-control autosize-target text-left"></textarea>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            
          </form>
        </div>

        {{-- @foreach( $project->projects as $project)
          <div class="col-lg-4">
            <h2>{{ $project->name }}</h2>
            <p class="text-danger">{{ $project->description }}</p>
            <p><a class="btn btn-primary" href="/projects/{{ $project->id }}" role="button">View project &raquo;</a></p>
          </div>
        @endforeach --}}
      </div>
    </div>

    <div class="col-md-3 col-lg-3 pull-right">
      {{-- <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div> --}}
      <div class="sidebar-module">
        <h4>Action</h4>
        <ol class="list-unstyled">
          <li><a href="/projects/{{$project->id}}/edit">Edit</a></li>
          <li><a href="/projects">My Projects</a></li>
          <li><a href="/projects/create">Create New project</a></li>

          <br>
          
          @if($project->user_id == Auth::user()->id)
            <li>
              <a href="#"
                  onclick="
                  var result = confirm('Are you sure you wish to delete this Project?');
                  if(result){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();
                  }">
                Delete
              </a>

              <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" method="POST" style="display: none;">
                <input type="hidden" name="_method" value="delete">
                {{ csrf_field() }}
              </form>
            </li>
          @endif

          {{-- <li><a href="#">Add New Team Member</a></li> --}}
        </ol>

        <hr>
        
        <h4>Add members</h4>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <form id="add-user" action="{{ route('projects.adduser') }}" method="POST"> {{-- atau bisa dengan action="projects.adduser" --}}
              {{ csrf_field() }}
              <div class="input-group">
                <input type="hidden" class="form-control" name="project_id" value="{{ $project->id }}">
                <input type="text" class="form-control" name="email" placeholder="Email">
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Add!</button>
                </span>
            </div><!-- /input-group -->
            </form>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        
        <br>

        <h4>Team Members</h4>
        <ol class="list-unstyled">
          @foreach($project->users as $user)
            <li><a href="#">{{ $user->email }}</a></li>
          @endforeach
        </ol>

      </div>

      {{-- <div class="sidebar-module">
        <h4>Teams</h4>
        <ol class="list-unstyled">
          <li><a href="#">March 2014</a></li>
        </ol>
      </div> --}}

    </div>

  </div> <!-- /container -->

@endsection
