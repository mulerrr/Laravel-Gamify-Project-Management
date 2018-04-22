@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/company.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="company-show-jumbotron">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 company-jumbotron text-center">
          <h1>{{ $company->name }}</h1>
          <p class="lead">{{ $company->description }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3 company-jumbotron-btn">
          <div class="btn-group btn-group-custom" role="group">
            <a href="/projects/create/{{ $company->id }}" class="btn btn-default">Add Project</a>
            <a href="/companies/{{$company->id}}/edit" class="btn btn-default">Edit</a>
            <a href="#" class="btn btn-default"
                onclick="
                var result = confirm('Are you sure you wish to delete this Project?');
                if(result){
                  event.preventDefault();
                  document.getElementById('delete-form').submit();
                }">
              Delete
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

<section class="main-box">
  <div class="container">
    <div class="row">
      <div class="main-box-container">
        @foreach ($company->projects as $project)
        <div class="col-md-4 col-sm-6" style="display: table-cell;">
          <div class="col-md-12 company-card">
            <div class="row">
              <div class="company-project-cover">
              </div>
            </div>
            <div class="row">
              <div class="company-card-body">
                <a href="/projects/{{ $project->id }}"><h3>{{ $project->name }}</h3></a>
                <p>{{ $project->description }}</p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="company-card-footer">
                    <div class="row">
                      <ul>
                        @foreach ( $tasks->where('project_id', $project->id)->slice(0, 5) as $task)
                          <a href="/tasks/{{$task->id}}"><li>{{ $task->name }} &nbsp; <span class="ti-arrow-circle-right"></span></li></a>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="company-card-footer-btn">
                    <a href="/projects/{{ $project->id }}">VIEW PROJECT</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

@endsection
