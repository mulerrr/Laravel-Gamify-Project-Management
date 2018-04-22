@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
    <div class="panel panel-primary">
      <div class="panel-heading">My Tasks <a class="pull-right btn btn-primary btn-sm" href="/projects/create">Create New</a></div>
      <div class="panel-body">

        <ul class="list-group">
          @foreach ($tasks as $task)
            <li class="list-group-item">
              <a href="/projects/{{ $task->id }}">{{ $task->name }}</a> - {{ $task->company->name }} - {{ $task->project->name }} - {{ $task->user->name }}
            </li>
          @endforeach
        </ul>

      </div>
    </div>
  </div>
</div>

@endsection
