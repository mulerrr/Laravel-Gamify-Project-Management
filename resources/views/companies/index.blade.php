@extends('layouts.app')

@section('title', 'Companies Page')

@section('css')
  <link href="{{ asset('css/company.css') }}" rel="stylesheet">
  <link href="{{ asset('css/project.css') }}" rel="stylesheet">
@endsection

@section('content')

<section class="jumbotron-custom companies-jumbotron" data-aos="fade-up" data-aos-duration="1000">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1>All The Company</h1>
        <div class="btn-group btn-group-custom" role="group">
          <a href="/companies/create" class="btn btn-default">Create New Company</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="main-box" data-aos="fade-down" data-aos-duration="1000">
  <div class="container">
    <div class="row"">
      <div class="main-box-container">
        @foreach ($companies as $company)
        <div class="col-md-4 col-sm-6">
          <div class="col-md-12 company-card">
            <div class="row">
              <div class="company-card-cover">
                <img src="{{ $company->user->avatar }}" alt="">
              </div>
            </div>
            <div class="row">
              <div class="company-card-body">
                <a href="/companies/{{ $company->id }}"><h2>{{ $company->name }}</h2></a>
                <p>{{ $company->description }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="company-card-footer">
                    <div class="row">
                      <div class="col-md-4 col-xs-4">
                        <div class="company-card-footer-detail">
                          <label>Project(s)</label>
                          <p>{{ count($company->projects) }}</p>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-4">
                        <div class="company-card-footer-detail">
                          <label>Task(s)</label>
                          <p>{{ count($tasks->where('company_id', $company->id) ) }}</p>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-4">
                        <a href="/companies/{{ $company->id }}">
                          <div class="company-card-footer-detail company-card-footer-hover">
                            View <br> Company
                          </div>
                        </a>
                      </div>
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
