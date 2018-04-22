@php
  use Carbon\Carbon;
  use App\Task;
@endphp

@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
  <div class="container">
    
    @if($review == null)
      <section class="add-review">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="review-form">
                <div class="row">
                  <h1 style="margin: 30px 0px;">Please Give Us Review To Improve Our Work</h1>
                  <form method="post" action="{{ route('reviews.store')}}">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                      <label for="review">Your Review</label>
                      <textarea placeholder="Enter Your Review" style="resize: vertical" id="review" name="review" rows="5" spellcheck="false" class="form-control autosize-target text-left"></textarea>
                    </div>

                    <div class="survey-answer-group" id="buying-selling-group" data-toggle="buttons">
                      <h4>How was our work?</h4>
                      @for ($i = 1; $i < 6; $i++)
                        <label class="btn btn-white-radio buying-selling">
                            <input type="radio" name="rating" autocomplete="off" value="{{$i}}">
                            <span class="radio-dot"></span>
                            <span class="buying-selling-word">{{$i}}</span>
                        </label>
                      @endfor
                    </div>

                    <div class="form-group">
                      <input type="submit" class="btn btn-default" style="margin-top: 20px;" value="Submit">
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
      </section>
    @else
      <section class="client-review-wrapper">
        <div class="col-md-12">
          <div class="row">
            <h1>Your Review</h1>
            <div class="client-review">
              <div class="row">
                <div class="col-md-12">
                  <div class="client-review-card">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="crc-avatar">
                          <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar">
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="crc-review">
                          <label for="">{{ Auth::user()->name }}</label>
                          <img src="{{ asset('/images/site/homeClient/quote-left.png') }}" alt="" class="quote-left">
                          <p>{{ $review->review }}</p>
                          <img src="{{ asset('/images/site/homeClient/quote-right.png') }}" alt="" class="quote-right">
                          <div class="rating">
                            @for ($i = 1; $i <= $review->rating; $i++)
                              <img src="{{ asset('/images/site/homeClient/star.jpg') }}" alt="">
                            @endfor
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type="button" data-toggle="modal" data-target="#editReview" class="btn btn-default" style="margin-right: 10px;">Edit Review</button>
            <button type="button" data-toggle="modal" data-target="#deleteReview" class="btn btn-danger">Delete Review</button>
          </div>
        </div>
      </section>
    @endif
    
    @if($review != null)
      @include('modals.clients.editReview')
      @include('modals.clients.deleteReview')
    @endif

  </div> <!-- /container -->
@endsection