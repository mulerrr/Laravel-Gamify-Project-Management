@extends('layouts.app')

@section('title', 'Projects Page')

@section('css')
  <link href="{{ asset('css/company.css') }}" rel="stylesheet">
  <link href="{{ asset('css/project.css') }}" rel="stylesheet">
@endsection

@section('content')

  <section class="jumbotron-custom project-jumbotron">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h1>All The Project</h1>
          <div class="btn-group btn-group-custom" role="group">
            <a href="/projects/create" class="btn btn-default">Create New Project</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="main-box">
  <div class="container">
    <div class="row"">
      <div class="main-box-container">
        @foreach ($companies as $company)
        <div class="col-md-4 col-sm-6">
          <div class="col-md-12 company-card">
            <div class="row">
              <div class="company-project-cover">
              </div>
            </div>
            <div class="row">
              <div class="company-card-body">
                <a href="/companies/{{ $company->id }}"><h3>{{ $company->name }}</h3></a>
                <p></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="company-card-footer">
                    <div class="row">
                      <ul>
                        @foreach ( $projects->where('company_id', $company->id) as $project )
                          <a href="/projects/{{ $project->id }}"><li>{{ $project->name }} &nbsp; <span class="ti-arrow-circle-right"></span></li></a>
                        @endforeach
                      </ul>
                    </div>
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
