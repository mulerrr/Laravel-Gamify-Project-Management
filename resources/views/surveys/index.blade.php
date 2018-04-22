@extends('layouts.app')

@section('content')

  <div class="container">

    {{-- SURVEY --}}
    <section class="survey">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="row">
            <h1>Survey Result</h1>

            <div class="survey-wrapper">
              <div class="row">

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

  </div> {{-- container --}}

@endsection

@section('javascript')

  <script type="text/javascript">
  $(document).ready(function(){
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

  });

  </script>

@endsection