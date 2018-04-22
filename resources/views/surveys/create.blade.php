@extends('layouts.app')

@section('content')

  <div class="container">

    @if ($showSurvey == 'show') {{-- show result --}}
      <div class="container-fluid">
        <h1 class="text-center">Thank you, you already answer survey for this month.</h1>
      </div>
    @else
      <section class="surveey-answer" style="background: white; border-radius: 7px; margin: 20px 0px 30px 0px;">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="answer-form-wrapper" style="padding: 0px 30px;">
              <div class="row">
                <h1 style="margin: 30px 0px;">Please Answer This Monthly Survey</h1>
                <form method="post" action="{{ route('companies.store')}}">
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
                          <input type="radio" name="q1" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>3. Does our executive team contribute to a positive work culture?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q1" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>4. How challenged do you on a daily basis at work?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q1" autocomplete="off" value="{{$i}}">
                          <span class="radio-dot"></span>
                          <span class="buying-selling-word">{{$i}}</span>
                      </label>
                    @endfor
                  </div>

                  <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                    <h4>5. Do you have fun at work?</h4>
                    @for ($i = 1; $i < 6; $i++)
                      <label class="btn btn-white-radio buying-selling">
                          <input type="radio" name="q1" autocomplete="off" value="{{$i}}">
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

  </div> <!-- /container -->

@endsection