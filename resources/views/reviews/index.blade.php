@php
  use Carbon\Carbon;
  use App\Task;
@endphp

@extends('layouts.app')

@section('content')
  <div class="container">

    <section class="client-review-wrapper">
      <div class="col-md-12">
        <div class="row">
          <h1>All Review</h1>
          @foreach ($reviews as $review)
            <div class="client-review">
              <div class="row">
                <div class="col-md-12">
                  <div class="client-review-card">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="crc-avatar">
                          <img src="{{ asset($review->user->avatar) }}" alt="avatar">
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="crc-review">
                          <label for="">{{ $review->user->name }}</label>
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
          @endforeach
        </div>
      </div>
    </section>

  </div> <!-- /container -->
@endsection