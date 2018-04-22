@extends('layouts.app')

@section('title', 'Presence Page')

@section('content')

  <div class="container">
    <div class="col-md-12">
      <div class="row">
        <div class="chart-wrapper">
          <div class="row">
            <canvas id="myChart" width="30" height="10"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="presence-wrapper">
      <h1>{{ $previousMonth }} 2018</h1>
      <div class="presence-detail">

        @foreach ($presences as $presence)

          @php
            //set presence in percent
            $presencePercent = ( $presence->days / $presence->max_days ) * 100;
          @endphp

          <div class="presence-card">
            <div class="presence-card-left">
              <img src="{{ asset( $presence->user->avatar ) }}" alt="" class="presence-card-img">
            </div>
            <div class="presence-card-right">
              <label>{{ $presence->user->name }} - {{ $presence->days }}/{{ $presence->max_days }}</label>

              <div class="progress skill-bar">
                <div class="progress-bar progress-bar-presence" role="progressbar" aria-valuenow="{{ $presencePercent }}" aria-valuemin="0" aria-valuemax="100">
                    {{-- <span class="score">100%</span> --}}
                </div>
              </div>
            </div>
            <a href="/presences/{{$presence->id}}/edit" class="btn btn-success" style="margin-right: 10px;">Edit</a>
          </div>

        @endforeach
        
      </div>
    @if ($addPresence == 'show')
      <a href="/presences/create" class="btn btn-default" style="margin-top: 30px;">Add Presence for {{ $previousMonth }} 2018</a>
    @endif

    </div>
  </div>


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
      $('.progress .progress-bar').css("width",
        function() {
            return $(this).attr("aria-valuenow") + "%";
        }
      )
    });
  </script>

@endsection