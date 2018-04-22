@php
  use Carbon\Carbon;
  use App\Task;
@endphp

@extends('layouts.app')

@section('title', 'Home Page')


@section('content')
    <div class="container">

    @if ($showSurvey == 'show') {{-- show result --}}
	    <section class="survey-result">
			<div class="row">
		      <div class="col-md-12">
		      	<div class="survey-result-wrapper">
			  		<div class="row">
			  			<div class="col-md-2">
			  				<div class="srw-img">
			  					<img src="{{ asset('images/site/homeProgrammer/survey-checked.jpg') }}" alt="">
			  				</div>
			  			</div>
						<div class="col-md-10">
							<div class="srw-text">
					        	<h1>Thank you!</h1>
					        	<h2>You already answer survey for this month.</h2>
					        </div>
				        </div>
				    </div>
			    </div>
		      </div>
		  	</div>
	  	</section>
    @else
      <section class="surveey-answer">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="answer-form-wrapper" style="padding: 0px 30px;">
              <div class="row">
                <h1 style="margin: 30px 0px;">Please Answer This Monthly Survey</h1>
                <form method="post" action="{{ route('surveys.store')}}">
                  {{ csrf_field() }}
                  
                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>1. On a scale of 1 to 10, how would you rate your work-life balance?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q1" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>2. Do you feel like coworkers give each other respect here?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q2" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>3. Does our executive team contribute to a positive work culture?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q3" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>4. How challenged do you on a daily basis at work?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q4" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>5. Do you have fun at work?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q5" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="form-group">
                    <label for="suggestion">Suggestion</label>
                    <textarea placeholder="Enter Suggestion" style="resize: vertical" id="suggestion" name="suggestion" rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-default" value="Submit">
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

    {{-- TASK SUMMARY --}}
    <section class="tasks-home">
      <div class="row">
        <div class="col-md-12">
          <h2>Your Tasks</h2>
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

                @foreach ($tasksSummaries as $tasksSummary)
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

  </div> <!-- /container -->
@endsection