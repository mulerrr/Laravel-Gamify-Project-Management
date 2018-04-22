@extends('layouts.app')

@section('title', 'User Page')

@section('content')

  <div class="container">

    {{-- PROGRAMMER --}}
    <section class="users">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="profile-card-container">
              <h1 style="margin-bottom: 20px;">Programmer</h1>
              <div class="row">
                @foreach ($userProgrammers as $userProgrammer)
                  <div class="col-md-4 col-sm-6">
                    <div class="profile-card">
                      <div class="profile-card-top">
                        <div class="profile-card-top-left">
                          <img src="{{ asset($userProgrammer->avatar) }}" alt="" class="profile-card-img">
                        </div>
                        <div class="profile-card-top-right">
                          <div class="profile-card-name">
                            <h2><a>{{$userProgrammer->name}}</a></h2>
                            <h3>{{$userProgrammer->position}}</h3>
                          </div>
                          <div class="profile-card-project-task">
                            <div class="profile-card-project">
                              <span class="profile-card-project-digit">{{ count($userProgrammer->tasks->groupBy('project_id')) }}</span>
                              <label class="project-task-label">projects</label>
                            </div>
                            <div class="profile-card-task">
                              <span class="profile-card-project-digit">{{ count($userProgrammer->tasks) }}</span>
                              <label class="project-task-label">tasks</label>
                            </div>
                            <div class="profile-card-task">
                              <span class="profile-card-project-digit">{{ count($userProgrammer->comments) }}</span>
                              <label class="project-task-label">comments</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="profile-card-desc">{{$userProgrammer->description}}</p>

                      <hr>

                      <div class="">
                        <button type="button" data-toggle="modal" data-target="#editUser{{$userProgrammer->id}}" class="btn btn-default" style="margin-right: 10px;">Edit</button>
                        <button type="button" data-toggle="modal" data-target="#userInactive{{$userProgrammer->id}}" class="btn btn-danger">Deactivate</button>
                      </div>
                    </div>
                  </div>

                  @include('modals.users.editUserProgrammer')
                  @include('modals.users.userDeactivateProgrammer')

                @endforeach

                <div class="col-md-4 col-sm-6">
                  <div class="profile-card pc-add-background">
                    <div class="row">
                      <div class="profile-card-add">
                        <img src="{{ asset('/images/avatar/dummy-profile-picture.jpg') }}" alt="add member">
                        <a href="{{ route('users.create') }}" class="btn btn-white" style="margin-top: 10px;">Add New Member</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- CLIENT --}}
    <section class="users">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="profile-card-container">
              <h1 style="margin-bottom: 20px;">Client</h1>
              <div class="row">
                @foreach ($userClients as $userClient)
                  <div class="col-md-4 col-sm-6">
                    <div class="profile-card">
                      <div class="profile-card-top">
                        <div class="profile-card-top-left">
                          <img src="{{ asset($userClient->avatar) }}" alt="" class="profile-card-img">
                        </div>
                        <div class="profile-card-top-right">
                          <div class="profile-card-name">
                            <h2><a>{{$userClient->name}}</a></h2>
                            <h3>{{$userClient->position}}</h3>
                          </div>
                        </div>
                      </div>

                      <p class="profile-card-desc">{{$userClient->description}}</p>

                      <hr>

                      <div class="">
                        <button type="button" data-toggle="modal" data-target="#editUser{{$userProgrammer->id}}" class="btn btn-default" style="margin-right: 10px;">Edit</button>
                        {{-- <button type="button" data-toggle="modal" data-target="#userInactive{{$userProgrammer->id}}" class="btn btn-danger">Deactivate</button> --}}
                      </div>
                    </div>
                  </div>

                  @include('modals.users.editUserProgrammer')
                  @include('modals.users.userDeactivateProgrammer')

                @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div> {{-- container --}}

@endsection