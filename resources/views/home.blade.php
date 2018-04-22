@php
  use Carbon\Carbon;
  use App\Task;
@endphp

@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="container">

    {{-- top row input csv --}}
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hey, welcome {{ Auth::user()->name }}

                    <a onclick="eximForm()" class="btn btn-default pull-right" style="margin-top: -8px;">Export/Import</a>

                    @include('partials.form')

                </div>
            </div>
        </div>
    </div> --}}
    
    {{-- CSV IMPORT --}}
    <section class="csv-import" data-aos="fade-down" data-aos-duration="1000">
      <div class="row">
        <div class="col-md-12">
          <div class="csv-import-wrapper">
            <div class="row">

              <div class="col-md-8">
                <div class="ciw-text">
                  <div class="ciw-text-img">
                    <img src="{{ asset("/images/site/home/csv.png") }}">
                  </div>
                  <div class="ciw-texts">
                    <h2>CSV Import</h2>
                    <p>Import CSV File from taiga.io</p>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="ciw-upload" style="padding: 40px;">
                  <div class="row">
                    <button type="button" data-toggle="modal" data-target="#modal-exim" class="btn btn-upload">Import File</button>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>

    @include('partials.form')

    {{-- ALL COUNTER --}}
    <section class="all-counter">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="projec-task-summary">

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail"  data-aos="fade-down" data-aos-duration="1000">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-first">
                        <div class="pt-content-title">
                          <label>Total Employee</label>
                          <p>{{ $totalEmployee }}</p>
                        </div>
                        <img src="{{ asset("/images/site/home/user-icon.png") }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-second">
                        <div class="pt-content-title">
                          <label>Total Clients</label>
                          <p>{{ $totalClient }}</p>
                        </div>
                        <img src="{{ asset("/images/site/home/client-icon.png") }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail" data-aos="fade-down" data-aos-duration="1000">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-third">
                        <div class="pt-content-title">
                          <label>Total Projects</label>
                          <p>{{ $totalProject }}</p>
                        </div>
                        <img src="{{ asset("/images/site/home/project-icon.png") }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="">
                  <div class="pt-summary-detail" data-aos="fade-up" data-aos-duration="1000">
                    <div class="row">
                      <div class="pt-summary-content pt-summary-fourth">
                        <div class="pt-content-title">
                          <label>Total Tasks</label>
                          <p>{{ $totalTask }}</p>
                        </div>
                        <img src="{{ asset("/images/site/home/task-icon.png") }}">
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

    {{-- PRODUCTIVE PRESENCE --}}
    <section class="productive-presence-home">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="pph-wrapper">

              <div class="col-md-6 col-sm-6">
                <div class="productive-presence-content" data-aos="zoom-in-right" data-aos-duration="1000">
                  <h2>Employee Productivity</h2>
                  <div class="pp-list-detail">
                    <div class="row">
                      @if ($showPresence == 'show')

                        @foreach ($presences as $presence)
                          @php
                            //Total Points Done
                            $totalPoints  = $presence->lastMonthTaskSum($presence->user->id); //76

                            $totalDays    = $presence->days; //24
                            $targetPoints = $totalDays * 2; //48

                            $performance  = (int)(($totalPoints / $targetPoints) * 100);

                          @endphp
                          <a href="{{ url('performance-detail',$presence->user->id )}}">
                          <div class="pp-content-detail">
                            <div class="row">
                              <div class="col-md-2">
                                <div class="pp-user-avatar">
                                  <div class="row">
                                    <img src="{{ asset($presence->user->avatar) }}" alt="">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="pp-user-name">
                                  <label>{{ $presence->user->name }}</label>
                                  <p>{{ $presence->user->position }}</p>
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="pp-progress">
                                  <div class="row">
                                    <h3>{{ $performance }} %</h3>
                                    <div class="progress skill-bar">
                                      <div class="progress-bar progress-bar-productivity" role="progressbar" aria-valuenow="{{ $performance }}" aria-valuemin="0" aria-valuemax="100">
                                          {{-- <span class="score">100%</span> --}}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </a>
                        @endforeach

                      @else
                        <div class="please-input-presence">
                          <h4>You have not input previous presence data.</h4>
                          <a href="/presences/create" class="btn btn-default" style="margin-top: 10px; color: #fff;">Input Presence</a>
                        </div>
                      @endif

                      
                    </div> {{-- row --}}
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6">
                <div class="productive-presence-content" data-aos="zoom-in-left" data-aos-duration="1000">
                  <h2>Employee Presences</h2>
                  <div class="pp-list-detail">
                    <div class="row">
                      @if ($showPresence == 'show')

                        @foreach ($presences as $presence)
                        @php
                          //set presence in percent
                          $presencePercent = (int)(( $presence->days / $presence->max_days ) * 100);
                        @endphp
                        <div class="pp-content-detail">
                          <div class="row">
                            <div class="col-md-2">
                              <div class="pp-user-avatar">
                                <div class="row">
                                  <img src="{{ asset($presence->user->avatar) }}" alt="">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="pp-user-name">
                                <label>{{ $presence->user->name }}</label>
                                <p>{{ $presence->user->position }}</p>
                              </div>
                            </div>
                            <div class="col-md-5">
                              <div class="pp-presence">
                                <div class="row">
                                  <h3>{{ $presence->days }}/{{ $presence->max_days }}</h3>
                                  <div class="progress skill-bar">
                                    <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $presencePercent }}" aria-valuemin="0" aria-valuemax="100">
                                        {{-- <span class="score">100%</span> --}}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach

                      @else
                        <div class="please-input-presence">
                          <h4>You have not input previous presence data.</h4>
                          <a href="/presences/create" class="btn btn-default" style="margin-top: 10px; color: #fff;">Input Presence</a>
                        </div>
                      @endif

                    </div> {{-- row --}}
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- PRESENCE GRAPHIC --}}
    <section class="presence-graphic" data-aos="zoom-in-up" data-aos-duration="200" data-aos-once="true">
      <div class="row">
        <div class="col-md-12">
          <h2>Last 6 Months Presences</h2>
          <div class="chart-wrapper">
            <div class="row">
              <canvas id="myChart" width="30" height="10"></canvas>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- TASK TURNOVER --}}
    <section class="task-turnover">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="tt-wrapper">

              <div class="col-md-6 col-sm-6">
                <div class="task-percentage-box" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="tpb-image">
                          <img src="{{ asset('/images/site/home/task-percentage.png') }}" alt="" style="  width: 100%;">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="tpb-text">
                          <div class="tpb-tex-content">
                            <label>{{ $taskPercentage }}%</label>
                            <p>Tasks Completed!!</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6">
                <div class="employee-turnover-box" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-6">
                        <div class="tpb-text">
                          <div class="tpb-tex-content">
                            <label>{{ $guysMissing }} Guy(s)</label>
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
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- SURVEY RESULT --}}
    <section class="tasks-home" data-aos="zoom-out-down" data-aos-duration="200" data-aos-once="true">
      <div class="row">
        <div class="col-md-12">
          <h2>Survey Result</h2>
          <div class="tasks-summary-wrapper">
            <div class="row">
              <div class="col-md-12">

                  <div class="col-md-5 col-sm-5">
                    <div class="row">
                      <div class="survey-pie">
                        <div id="survey-pie-chart"></div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-7 col-sm-7">
                    <div class="survey-bar">

                      <div class="question">
                        <div class="qustion-color">
                          <div class="qc-palette question-1"></div>
                        </div>
                        <div class="question-result">
                          <p>1. On a scale of 1 to 10, how would you rate your work-life balance?</p>
                          <div class="progress skill-bar">
                            <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $q1p }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="question">
                        <div class="qustion-color">
                          <div class="qc-palette question-2"></div>
                        </div>
                        <div class="question-result">
                          <p>2. Do you feel like coworkers give each other respect here?</p>
                          <div class="progress skill-bar">
                            <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $q2p }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="question">
                        <div class="qustion-color">
                          <div class="qc-palette question-3"></div>
                        </div>
                        <div class="question-result">
                          <p>3. Does our executive team contribute to a positive work culture?</p>
                          <div class="progress skill-bar">
                            <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $q3p }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="question">
                        <div class="qustion-color">
                          <div class="qc-palette question-4"></div>
                        </div>
                        <div class="question-result">
                          <p>4. How challenged do you on a daily basis at work?</p>
                          <div class="progress skill-bar">
                            <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $q4p }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="question">
                        <div class="qustion-color">
                          <div class="qc-palette question-5"></div>
                        </div>
                        <div class="question-result">
                          <p>5. Do you have fun at work?</p>
                          <div class="progress skill-bar">
                            <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $q5p }}" aria-valuemin="0" aria-valuemax="100">
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

    {{-- CLIENT REVIEW --}}
    <section class="client-review" style="border-radius: 7px;" data-aos="fade-left" data-aos-duration="500" data-aos-offset="500" data-aos-once="true">
      <div class="row">
        <div class="col-md-12">
          <div class="review-wrapper" style="padding: 20px;">
            <h2 class="text-center">Client Review</h2>
            <div class="row">
              <div class="bxslider">
                
                  @foreach ($reviews as $review)
                  <div class="review-slider-card" style="width: 100%; background: #fff;">
                    <div class="rsc-top">
                      <img src="{{ $review->user->avatar }}">
                      <h3>{{ $review->user->name }}</h3>
                      <p>{{ $review->review }}</p>
                    </div>
                    <div class="rsc-bottom">
                      @for ($a = 1; $a <= $review->rating; $a++)
                        <img src="{{ asset('/images/site/homeClient/star.jpg') }}" alt="">
                      @endfor
                    </div>
                  </div>
                  @endforeach
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- TASK SUMMARY --}}
    <section class="tasks-home">
      <div class="row">
        <div class="col-md-12">
          <h2>Recent Update Tasks</h2>
          <div class="tasks-summary-wrapper">
            <div class="row">
              <div class="col-md-12">
                  {{-- TITLE --}}
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

                @foreach ($tasksSummaries->slice(0, 5) as $tasksSummary)
                  <div class="th-task-list">
                    <div class="row">
                      <div class="col-md-1">
                        <div class="th-date">
                          <div class="th-date-detail">
                            <label>{{ Carbon::parse($tasksSummary->updated_at)->format('d') }}</label>
                            <span>{{ Carbon::parse($tasksSummary->updated_at)->format('M') }} {{ Carbon::parse($tasksSummary->updated_at)->format('Y') }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="th-title">
                          <a href="/tasks/{{ $tasksSummary->id }}"><p>{{ $tasksSummary->name }}</p></a>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="th-status th-status-{{ str_replace( ' ', '', (strtolower($tasksSummary->status))) }}">
                          <label class="text-center">{{ $tasksSummary->status }}</label>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="th-project">
                          <label><span class="ti-briefcase"></span>&nbsp; {{ $tasksSummary->company->name }}</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="th-assign">
                          <label><span class="ti-user"></span>&nbsp; {{ $tasksSummary->user->name }}</label>
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
    </section>

    {{-- USERS HOME --}}
    <section class="users" style="margin-top: 0px;">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="profile-card-container">
                <h2>Employee</h2>
                @foreach ($users as $user)
                  <div class="col-md-4 col-sm-6">
                    <div class="profile-card profile-card-home">
                      <div class="profile-card-top">
                        <div class="profile-card-top-left">
                          <img src="{{ asset($user->avatar) }}" alt="" class="profile-card-img">
                        </div>
                        <div class="profile-card-top-right">
                          <div class="profile-card-name">
                            <h2><a href="/users/{{ $user->id }}">{{$user->name}}</a></h2>
                            <h3>{{$user->position}}</h3>
                          </div>
                          <div class="profile-card-project-task">
                            <div class="profile-card-project">
                              <span class="profile-card-project-digit">{{ count($user->tasks->groupBy('project_id')) }}</span>
                              <label class="project-task-label">projects</label>
                            </div>
                            <div class="profile-card-task">
                              <span class="profile-card-project-digit">{{ count($user->tasks) }}</span>
                              <label class="project-task-label">tasks</label>
                            </div>
                            <div class="profile-card-task">
                              <span class="profile-card-project-digit">{{ count($user->comments) }}</span>
                              <label class="project-task-label">comments</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <p class="profile-card-desc">{{$user->description}}</p>
                    </div>
                  </div>
                @endforeach
              
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- <ul>
      @foreach ($cumiTasks as $cumiTask)
        <li>{{ $cumiTask->name }}</li>
      @endforeach
    </ul> --}}

</div> {{-- container terluar --}}


@endsection

@section('javascript')

  <script type="text/javascript">

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        //borderWidth: 10,
        data: {
            labels: [
              @foreach ($months as $month)
                "{{ $month }}",
              @endforeach ],
            datasets: [
              {
                  label: 'Imam Prastio',
                  data: [
                    @foreach($mulers->reverse() as $muler)
                      {{$muler->days}},
                    @endforeach
                  ],
                  backgroundColor: [
                      'rgba(83, 222, 174, 0.2)',
                  ],
                  borderColor: [
                      '#53deae',
                  ],
                  borderWidth: 1
              },
              {
                  label: 'John Doe',
                  data: [
                    @foreach($cumis->reverse() as $cumi)
                      {{$cumi->days}},
                    @endforeach
                  ],
                  backgroundColor: [
                      'rgba(235, 95, 124, 0.2)',
                  ],
                  borderColor: [
                      'rgba(235, 95, 124, 1)',
                  ],
                  borderWidth: 1
              }
            ]
        },
        options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Last 6 Months Presences'
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

    $(document).ready(function() {
      AOS.init();
      //survey pie chart
      var width = 250,
      height = 250,
      offset = 100,
      radius = Math.min(width, height) / 2;

      var color = d3.scale.ordinal()
          .range(["#b971ea", "#53deae", "#eb5f7c", "#79a3f0", "#f2bd43"]);

      var arc = d3.svg.arc()
          .outerRadius(radius - 10)
          .innerRadius(radius - 50);

      // second arc for labels
      var arc2 = d3.svg.arc()
        .outerRadius(radius)
        .innerRadius(radius + 20);

      var pie = d3.layout.pie()
          .sort(null)
          .startAngle(1.1*Math.PI)
          .endAngle(3.1*Math.PI)
          .value(function(d) { return d.songs; });

      var data = [
        {genre: 'Work-Life Balance', songs: {{ $q1 }} },
        {genre: 'Respect Each Other', songs: {{ $q2 }} },
        {genre: 'Executive Contribution', songs: {{ $q3 }} },
        {genre: 'Challenged', songs: {{ $q4 }} },
        {genre: 'Fun', songs: {{ $q5 }} }
      ];

      var svg = d3.select("#survey-pie-chart").append("svg")
          .attr("id", "chart")
          .attr("width", width + offset)
          .attr("height", height + offset)
          .attr('viewBox', '0 0 ' + width + offset + ''+ width + offset +'')
          .attr('perserveAspectRatio', 'xMinYMid')
        .append("g")
          .attr("transform", "translate(" + (width+offset) / 2 + "," + (height + offset) / 2 + ")");

        data.forEach(function(d) {
          d.songs = +d.songs;
        });

        var g = svg.selectAll(".arc")
            .data(pie(data))
          .enter().append("g")
            .attr("class", "arc");

        g.append("path")
            .style("fill", function(d) { return color(d.data.genre); })
            .transition().delay(function(d, i) { return i * 500; }).duration(500)
            .attrTween('d', function(d) {
               var i = d3.interpolate(d.startAngle+0.1, d.endAngle);
               return function(t) {
                 d.endAngle = i(t);
                 return arc(d);
               };
            });

        g.append("text")
            .attr("transform", function(d) { return "translate(" + arc2.centroid(d) + ")"; })
            .attr("dy", ".35em")
            .attr("class", "d3-label")
            .style("text-anchor", "middle")
            .text(function(d) { return d.data.genre; });

      var aspect = width / height,
          chart = $("#chart");
      $(window).on("resize", function() {
          var targetWidth = Math.min(width + offset, chart.parent().width());
          chart.attr("width", targetWidth);
          chart.attr("height", targetWidth / aspect);
      }).trigger('resize');

      $('.progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
      )

      $('.bxslider').bxSlider({
        mode: 'horizontal',
        slideWidth: 1200,
        captions: true,
        auto: true,
        responsive: true,
        minSlides: 1,
        maxSlides: 5,
        moveSlides: 1,
        slideMargin: 30,  
        pager: true,
        autoHover: true,
        infiniteLoop: true,
      });

    });

  </script>

@endsection
