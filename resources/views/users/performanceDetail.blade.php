@php
  use App\User;
@endphp

@extends('layouts.app')

@section('title', 'Performance Detail')

@section('content')

<div class="container">

  {{-- PERFORMANCE TOP --}}
  <section class="performance-detail-top">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="pdt-wrapper">
            <h1 style="margin-left: 15px;">Monthly Performance Report</h1>

            <div class="col-md-4 col-sm-4">
              <div class="performance-user">
                <div class="performance-user-img">
                  <img src="{{ $user->avatar }}" alt="">
                </div>
                <div class="performance-user-text">
                  <h2>{{ $user->name }}</h2>
                  <p>{{ $user->position }}</p>
                </div>
              </div>
            </div>

            {{-- <div class="col-md-6 col-sm-6">
              <div class="employee-turnover-box">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-6">
                      <div class="tpb-text">
                        <div class="tpb-tex-content">
                          <label>{{ $user->name }} Guy(s)</label>
                          <p>Are Missing!!</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="tpb-image">
                        <img src="{{ asset('/images/site/home/employee-turnover.png') }}" alt="" style="  width: 100%;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}

          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ALL COUNTER --}}
  <section class="performance-task-count">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="projec-task-summary">

            @php
              $finishPercentage     = (int)(($totalTaskFinish/$totalTask) * 100);
              $inProgressPercentage = (int)(($totalTaskInProgress/$totalTask) * 100);
              $newPercentage        = (int)(($totalTaskNew/$totalTask) * 100);
            @endphp

            <div class="col-md-3 col-sm-6">
              <div class="">
                <div class="pt-summary-detail">
                  <div class="row">
                    <div class="pdt-summary-content">
                      <div class="pdt-content-title">
                        <label>Assigned Tasks</label>
                        <p>{{ $totalTask }}</p>
                      </div>
                      <img src="{{ asset("/images/site/home/task-icons.png") }}">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="">
                <div class="pt-summary-detail">
                  <div class="row">
                    <div class="pdt-summary-content">
                      <div class="pdt-content-title">
                        <label>Finished Tasks</label>
                        <div class="pdt-progress-wrapper">
                          <p>{{ $totalTaskFinish }}</p>
                          <div class="progress pdt-progress skill-bar">
                            <div class="progress-bar progress-bar-finished" role="progressbar" aria-valuenow="{{ $finishPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                {{-- <span class="score">100%</span> --}}
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
              <div class="">
                <div class="pt-summary-detail">
                  <div class="row">
                    <div class="pdt-summary-content">
                      <div class="pdt-content-title">
                        <label>On Progress Tasks</label>
                        <div class="pdt-progress-wrapper">
                          <p>{{ $totalTaskInProgress }}</p>
                          <div class="progress pdt-progress skill-bar">
                            <div class="progress-bar progress-bar-on-progress" role="progressbar" aria-valuenow="{{ $inProgressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                {{-- <span class="score">100%</span> --}}
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
              <div class="">
                <div class="pt-summary-detail">
                  <div class="row">
                    <div class="pdt-summary-content">
                      <div class="pdt-content-title">
                        <label>New Tasks</label>
                        <div class="pdt-progress-wrapper">
                          <p>{{ $totalTaskNew }}</p>
                          <div class="progress pdt-progress skill-bar">
                            <div class="progress-bar progress-bar-new" role="progressbar" aria-valuenow="{{ $newPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                {{-- <span class="score">100%</span> --}}
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

  {{-- PERFORMANCE PRESENCE --}}
  <section class="performance-presence">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="performance-presence-wrapper">
            
            <div class="col-md-6 col-sm-6">
              <div class="monthly-performance-wrapper">
                <div class="mp-top">
                  <label>{{ $performancePercentage }}%</label>

                  <div class="progress mp-progress skill-bar">
                    <div class="progress-bar progress-bar-productivity" role="progressbar" aria-valuenow="{{ $performancePercentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{-- <span class="score">100%</span> --}}
                    </div>
                  </div>

                  <h3>Performance Percentage</h3>
                  <p>*Performance percentage is based on the comparison result between employee's points gained and presence.</p>
                </div>
                <div class="mp-bottom">
                  <div class="mp-bottom-left">
                    <div class="mbl-icon">
                      <span class="ti-stats-up"></span>
                    </div>
                    <div class="mbl-text">
                      <p>{{ $totalPoints }} Points</p>
                      <label>Points Gained</label>
                    </div>
                  </div>
                  <div class="mp-bottom-right">
                    <div class="mbl-icon">
                      <span class="ti-target"></span>
                    </div>
                    <div class="mbl-text">
                      <p>{{ $targetPoints }} Points</p>
                      <label>Target Points</label>
                    </div>
                  </div>
                </div>
                <div class="mp-bottom">
                  <div class="mp-bottom-left">
                    <div class="mbl-icon">
                      <span class="ti-alarm-clock"></span>
                    </div>
                    <div class="mbl-text">
                      <p>{{ $developmentDays }} Days</p>
                      <label>Development in Days</label>
                    </div>
                  </div>
                  <div class="mp-bottom-right">
                    <div class="mbl-icon">
                      <span class="ti-calendar"></span>
                    </div>
                    <div class="mbl-text">
                      <p>{{ $totalDays }} Days</p>
                      <label>Presence</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="performance-presence-graphic" style="background: #fff;">
                <canvas id="myChart" width="40" height="22"></canvas>
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
            
            <div class="col-md-6">
              <h4>List of Finished Tasks</h4>
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
                      <p>Late</p>
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
                        <p>{{ ($doneTask->created_at->diffInDays($doneTask->updated_at)) - $targetDays }} Days</p>
                      </div>
                      
                    </div>
                  
                  @endforeach
                </div>
              </div>
            </div>

            <div class="col-md-6">
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
                      <p>Late</p>
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
                        <p>{{ ($inProgressTask->created_at->diffInDays($inProgressTask->updated_at)) - $targetDays }} Days</p>
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
  
</div> <!-- /container -->

@endsection

@section('javascript')

  <script type="text/javascript">
    $(document).ready(function() {
      $('.progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
      )
      var $height1 = $('.monthly-performance-wrapper').height();
      $('.performance-presence-graphic').height($('.monthly-performance-wrapper').height());
    });

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        //borderWidth: 10,
        data: {
            labels: [ 
              @foreach ($months as $month)
                "{{ $month }}",
              @endforeach 
              ],
            datasets: [
              {
                  label: '{{ $user->name }}',
                  data: [
                    @foreach($presenseLists->reverse() as $presenseList)
                      {{$presenseList->days}},
                    @endforeach
                  ],
                  backgroundColor: [
                      'rgba(118,221,233, 0.2)',
                  ],
                  borderColor: [
                      '#00c6ff',
                  ],
                  borderWidth: 1
              }
            ]
        },
        options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Last 4 Months Presences'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
    });
  </script>

@endsection