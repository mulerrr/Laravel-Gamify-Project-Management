@extends('layouts.app')

@section('title', 'Edit ' . $project->name)

@section('content')

  <div class="container">

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">

      <!-- Example row of columns -->
      <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: #fff;">

        <form method="post" action="{{ route('projects.update',[$project->id]) }}">
          {{ csrf_field() }}

          <input type="hidden" name="_method" value="put">

          <div class="form-group">
            <label for="project-name">Name<span class="required">*</span></label>
            <input type="text" placeholder="Enter Name" id="project-name" required name="name" spellcheck="false" class="form-control" value="{{ $project->name }}">
          </div>

          <div class="form-group">
            <label for="project-name">Project Nickname<span class="required">*</span></label>
            <input type="text" placeholder="Enter Project Nickname" id="project-nickname" required name="project_nickname" spellcheck="false" class="form-control" value="{{ $project->project_nickname }}">
          </div>

          <div class="form-group">
            <label for="project-content">Description</label>
            <textarea placeholder="Enter Description" style="resize: vertical" id="project-content" name="description" rows="5" spellcheck="false" class="form-control autosize-target text-left">{{ $project->description }}</textarea>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
          </div>
          
        </form>
          

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
          <li><a href="/projects/{{$project->id}}">View project</a></li>
          <li><a href="/projects">All project</a></li>
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
