@php
  use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('title', $project->name)

@section('content')

  <div class="container">
    
    {{-- PROJECT SHOW TOP --}}
    <section class="project-show-top">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="project-title-wrapper">
              
              <div class="col-md-12 col-sm-12">
                <div class="project-show-title">
                  <div class="row">
                    <div class="pst-top">
                      <div class="pst-top-img">
                        <img src="{{ $project->company->user->avatar }}" alt="">
                      </div>
                      <div class="pst-top-text">
                        <h1>{{ $project->company->user->name }}</h1>
                        <h2>{{ $project->name }}</h2>
                      </div>
                    </div>

                    <p>{{ $project->description }}</p>

                    <div class="pst-button">
                      <a href="/projects/{{$project->id}}/edit" class="btn btn-default" style="margin-right: 10px;">Edit</a>
                      @if($project->user_id == Auth::user()->id)
                        <a href="#" class="btn btn-danger"
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
                      @endif
                    </div>
                  </div> {{-- row --}}

                  <div class="row">
                    <div class="pst-bottom-wrapper">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="pst-bottom">

                            @php
                              $finishPercentage     = (int)(($totalTaskFinish/$totalTask) * 100);
                              $inProgressPercentage = (int)(($totalTaskInProgress/$totalTask) * 100);
                              $newPercentage        = (int)(($totalTaskNew/$totalTask) * 100);
                            @endphp

                            <div class="col-md-3 col-sm-6">
                              <div class="row">
                                <div class="pt-summary-detail summary-detail-project">
                                  <div class="row">
                                    <div class="pdt-summary-content">
                                      <div class="pdt-content-title">
                                        <label>Total Tasks</label>
                                        <p>{{ $totalTask }}</p>
                                      </div>
                                      <img src="{{ asset("/images/site/home/task-icons.png") }}">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                              <div class="row">
                                <div class="pt-summary-detail summary-detail-project">
                                  <div class="row">
                                    <div class="pdt-summary-content">
                                      <div class="pdt-content-title">
                                        <label>Finished Tasks</label>
                                        <div class="pdt-progress-wrapper">
                                          <p>{{ $totalTaskFinish }}</p>
                                          <div class="progress pdt-progress skill-bar">
                                            <div class="progress-bar progress-bar-finished" role="progressbar" aria-valuenow="{{ $finishPercentage  }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                              <div class="row">
                                <div class="pt-summary-detail summary-detail-project">
                                  <div class="row">
                                    <div class="pdt-summary-content">
                                      <div class="pdt-content-title">
                                        <label>On Progress Tasks</label>
                                        <div class="pdt-progress-wrapper">
                                          <p>{{ $totalTaskInProgress }}</p>
                                          <div class="progress pdt-progress skill-bar">
                                            <div class="progress-bar progress-bar-on-progress" role="progressbar" aria-valuenow="{{ $inProgressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                              <div class="row">
                                <div class="pt-summary-detail summary-detail-project sdp-last">
                                  <div class="row">
                                    <div class="pdt-summary-content">
                                      <div class="pdt-content-title">
                                        <label>New Tasks</label>
                                        <div class="pdt-progress-wrapper">
                                          <p>{{ $totalTaskNew }}</p>
                                          <div class="progress pdt-progress skill-bar">
                                            <div class="progress-bar progress-bar-new" role="progressbar" aria-valuenow="{{ $newPercentage  }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
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

    {{-- ALL COUNTER --}}
    <section class="all-counter">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="projec-task-summary">

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-first">
                        <div class="pt-content-title">
                          <label>Start Project</label>
                          <p>{{ $startDate->created_at->format('d M Y') }}</p>
                        </div>
                        <img src="{{ asset("/images/site/home/project-start.png") }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-second">
                        <div class="pt-content-title">
                          <label>End Project</label>
                          <p>--:--</p>
                        </div>
                        <img src="{{ asset("/images/site/home/project-end.png") }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-third">
                        <div class="pt-content-title">
                          <label>Total Days</label>
                          <p>{{ $startDate->created_at->diffInDays($lastDate->updated_at) }} Days</p>
                        </div>
                        <img src="{{ asset("/images/site/home/project-date.png") }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-fourth">
                        <div class="pt-content-title">
                          <label>Employee Involved</label>
                          <p>{{ $totalEmployee }} People</p>
                        </div>
                        <img src="{{ asset("/images/site/home/user-icon.png") }}">
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

    {{-- TASKS Last MONT & THIS WEEK --}}
  <section class="tasks-recap" style="margin-bottom: 50px;">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="task-recap-wrapper">
            
            <div class="col-md-12">
              <h4 style="margin-top: -40px;">List of Finished Tasks</h4>
              <div class="monthly-task-user">
                <div class="mtu-header">
                  <div class="mtu-progress-wrapper">
                    <p>{{ $totalTaskFinish }} task(s) done out of {{ $totalTask }}</p>
                    <div class="progress mtu-progress skill-bar">
                      <div class="progress-bar progress-bar-finished" role="progressbar" aria-valuenow="{{ $finishPercentage }}" aria-valuemin="0" aria-valuemax="100">
                          {{-- <span class="score">100%</span> --}}
                      </div>
                    </div>
                    <p>{{ $lastMonthName }}</p>
                  </div>
                </div>
                <div class="mtu-content">
                  <div class="mtu-list mtu-list-title">
                    <div class="mtu-title">
                      <p>Task Name</p>
                    </div>
                    <div class="mtu-points">
                      <p>Points</p>
                    </div>
                    <div class="mtu-start">
                      <p>Start</p>
                    </div>
                    <div class="mtu-finish">
                      <p>Finish</p>
                    </div>
                    <div class="mtu-late">
                      <p>Assigned To</p>
                    </div>
                  </div>
                  @foreach ($doneTasks as $doneTask)

                  @php
                    $targetDays = $doneTask->points / 2;
                  @endphp
                  
                    <div class="mtu-list">
                      <div class="mtu-title">
                        <p><a href="/tasks/{{ $doneTask->id }}">{{ $doneTask->name }}</a></p>
                        <label>Done ・ {{ $doneTask->created_at->diffInDays($doneTask->updated_at) }} Days / {{ $doneTask->created_at->diffInHours($doneTask->updated_at) }} Hours</label>
                      </div>
                      <div class="mtu-points">
                        <p>{{ $doneTask->points }} points</p>
                      </div>
                      <div class="mtu-start">
                        <p>{{ $doneTask->created_at->format('d M y') }}</p>
                      </div>
                      <div class="mtu-finish">
                        <p>{{ $doneTask->updated_at->format('d M y') }}</p>
                      </div>
                      <div class="mtu-late">
                        <p>{{ ($doneTask->user->name) }}</p>
                      </div>
                      
                    </div>
                  
                  @endforeach
                </div>
              </div>
            </div>

            <div class="col-md-12" style="margin-top: 30px; ">
              <h4>List of On Progress Tasks</h4>
              <div class="monthly-task-user">
                <div class="mtu-header">
                  <div class="mtu-progress-wrapper">
                    <p>{{ $totalTaskInProgress }} task(s) on progress out of {{ $totalTask }}</p>
                    <div class="progress mtu-progress skill-bar">
                      <div class="progress-bar progress-bar-on-progress" role="progressbar" aria-valuenow="{{ $inProgressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                          {{-- <span class="score">100%</span> --}}
                      </div>
                    </div>
                    <p>{{ $lastMonthName }}</p>
                  </div>
                </div>
                <div class="mtu-content">
                  <div class="mtu-list mtu-list-title">
                    <div class="mtu-title">
                      <p>Task Name</p>
                    </div>
                    <div class="mtu-points">
                      <p>Points</p>
                    </div>
                    <div class="mtu-start">
                      <p>Start</p>
                    </div>
                    <div class="mtu-finish">
                      <p>Update</p>
                    </div>
                    <div class="mtu-late">
                      <p>Assigned To</p>
                    </div>
                  </div>
                  @foreach ($inProgressTasks as $inProgressTask)

                    @php
                      $targetDays = $inProgressTask->points / 2;
                    @endphp

                    <div class="mtu-list">
                      <div class="mtu-title">
                        <p><a href="/tasks/{{ $doneTask->id }}">{{ $inProgressTask->name }}</a></p>
                        <label>On Progress ・ {{ $inProgressTask->created_at->diffInDays($inProgressTask->updated_at) }} Days / {{ $inProgressTask->created_at->diffInHours($inProgressTask->updated_at) }} Hours</label>
                      </div>
                      <div class="mtu-points">
                        <p>{{ $inProgressTask->points }} points</p>
                      </div>
                      <div class="mtu-start">
                        <p>{{ $inProgressTask->created_at->format('d M y') }}</p>
                      </div>
                      <div class="mtu-finish">
                        <p>{{ $inProgressTask->updated_at->format('d M y') }}</p>
                      </div>
                      <div class="mtu-late">
                        <p>{{ ($inProgressTask->user->name) }}</p>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

    {{-- TASK SUMMARY --}}
    {{-- <section class="tasks-home">
      <div class="row">
        <div class="col-md-12">
          <h2>Recent Update Tasks</h2>
          <div class="tasks-summary-wrapper">
            <div class="row">
              <div class="col-md-12">
                  <div class="th-task-list">
                    <div class="row">
                      <div class="col-md-1">
                        <div class="th-date">
                          <div class="th-title">
                            <p>Date</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="th-title">
                          <p>Task Name</p>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="th-status">
                          <label class="text-center" style="color: #636b6f;">Status</label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="th-project">
                          <label>Company</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="th-assign">
                          <label>Assigned To</label>
                        </div>
                      </div>
                    </div>
                  </div>

                @foreach ($tasks as $tasks)
                  <div class="th-task-list">
                    <div class="row">
                      <div class="col-md-1">
                        <div class="th-date">
                          <div class="th-date-detail">
                            <label>{{ Carbon::parse($tasks->updated_at)->format('d') }}</label>
                            <span>{{ Carbon::parse($tasks->updated_at)->format('M') }} {{ Carbon::parse($tasks->updated_at)->format('Y') }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="th-title">
                          <p>{{ $tasks->name }}</p>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="th-status th-status-{{ str_replace( ' ', '', (strtolower($tasks->status))) }}">
                          <label class="text-center">{{ $tasks->status }}</label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="th-project">
                          <label><span class="ti-briefcase"></span>&nbsp; {{ $tasks->company->name }}</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="th-assign">
                          <label><span class="ti-user"></span>&nbsp; {{ $tasks->user->name }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
  
  </div> {{-- end container --}}

@endsection

@section('javascript')

  <script type="text/javascript">
    $(document).ready(function() {
      $('.progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
      );
    });
  </script>
@endsection