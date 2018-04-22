@php
  use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('title', $task->name)

@section('content')

  <div class="container">
  
    {{-- TASK DETAIL --}}
    <section class="task-detail">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="task-detail-wrapper">
              
              <div class="col-md-6 col-sm-6">
                <div class="task-contant-wrapper" style="background: white; padding: 20px 40px; border-radius: 7px;">
                  <div class="row">
                    <div class="task-content-top">
                      <div class="tct-title">
                        <h1>{{ $task->name }}</h1>
                        <p>{{ $task->description }}</p>
                      </div>
                      <div class="tct-img">
                        <img src="{{ asset($task->user->avatar) }}" alt="">
                      </div>
                    </div>
                    <div class="task-content-bottom">
                      <div class="col-md-12">
                        
                      </div>
                    </div>
                  </div> {{-- row --}}
                </div>
              </div>

              <div class="col-md-6 col-sm-6">
                <div class="project-show-title" style="background: white; padding: 0 20px; border-radius: 7px;">
                  <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12" style="background-color: #fff; margin: 10px;">

                      @include('partials.comments')

                      <div class="row container-fluid">

                        <form method="post" action="{{ route('comments.store')}}">
                          {{ csrf_field() }}

                          {{-- <div class="form-group">
                            <label for="company-name">Url (proof of work done)<span class="required">*</span></label>
                            <input type="text" placeholder="Enter url" id="company-name" required name="name" spellcheck="false" class="form-control">
                          </div> --}}

                          <input type="hidden" name="commentable_type" value="App\Task">
                          <input type="hidden" name="commentable_id" value="{{$task->id}}">
                          <input type="hidden" name="task_owner_id" value="{{$task->user->id}}">

                          <div class="form-group">
                            <label for="comment-content">Discuss</label>
                            <textarea placeholder="" style="resize: vertical" id="comment-content" name="body" rows="3" spellcheck="false" class="form-control autosize-target text-left"></textarea>
                          </div>

                          <div class="form-group">
                            <label for="comment-content">Related Link</label>
                            <textarea placeholder="Enter url" style="resize: vertical" id="comment-content" name="url" rows="2" spellcheck="false" class="form-control autosize-target text-left"></textarea>
                          </div>

                          <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Submit">
                          </div>
                          
                        </form>
                      </div>
                    </div>
                  </div> {{-- row --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="task-comment">
      
    </section>

  </div> {{-- end container --}}

@endsection
