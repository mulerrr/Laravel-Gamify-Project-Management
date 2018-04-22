@extends('layouts.app')

@section('title', 'Create New Presence')

@section('content')

  <div class="container"">

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2" style="margin-top: 20px;">

      <!-- Example row of columns -->
      <div class="row col-md-12 col-lg-12 col-sm-12" style="background-color: #fff; style="border-radius: 5px;">
        <h1 style="margin-bottom: 30px;">Input Absen {{ date('Y') }}</h1>

        <div class="row">
          <div class="col-md-6">
            <div class="input-group">
              <label>Input Max Presences</label>
              <input type="number" class="form-control" placeholder="Max Presence" id="input-max-presence" min="1">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4" style="margin-top: 20px;">
            <div class="input-group">
              <label>Month</label>
              <select class="form-control" id="select-month">
                <option>Select Month</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
              </select> {{-- month picker --}}
            </div>
          </div>
          <div class="col-md-4" style="margin-top: 20px;">
            <div class="input-group">
              <label>Year</label>
              <select class="form-control" id="select-year">
                <option>Select Year</option>
              </select>
            </div>
          </div>
        </div>

        <hr>

        <form method="post" action="{{ route('presences.store')}}" class="row">
          {{ csrf_field() }}

          <div class="input_fields_wrap">

            {{-- @if($users != null)
              <div class="form-group">
                <label for="project-content">Select Company</label>
                <select name="company_id" class="form-control">
                  @foreach($users as $user)
                    <option value="{{ $user->id }}"> {{ $user->name }} </option>
                  @endforeach
                </select>
              </div>
            @endif --}}

            @foreach ($users as $key => $user)
              <div class="form-group">
                  {{-- <span class="col-md-3 control-label">{{ $user->name }}</span> --}}

                  <div class="col-md-6" class="form-group">
                    <input type="hidden" name="entities[{{ $key }}][user_id]" class="form-control" value="{{ $user->id }}">
                    <p>{{ $user->name }}</p>
                    <input type="hidden" name="user_name" class="form-control" value="{{ $user->name }}" disabled>
                   {{--  @if($users != null)
                      <select name="entities[{{ $key }}][user_id]" class="form-control">
                        @foreach($users as $user)
                          <option value="{{ $user->id }}"> {{ $user->name }} </option>
                        @endforeach
                      </select>
                    @endif --}}
                  </div>

                  <div class="col-md-6">
                      <div class="form-group row">
                          <div class="col-md-6">
                              <input type="number" class="form-control current-presence" name="entities[{{ $key }}][days]" placeholder="Days">
                          </div>
                          <div class="col-md-6">
                              <input type="text" name="entities[{{ $key }}][max_days]" class="form-control max-presence">
                          </div>
                      </div>
                  </div>
                  {{-- <div class="col-md-2">
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-add add_field_button" type="button">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </span>
                  </div> --}}
              </div>
              
              {{-- Hidden Input --}}
              <input type="hidden" name="entities[{{ $key }}][month]" class="presence-month">
              <input type="hidden" name="entities[{{ $key }}][year]" class="presence-year">
              <div style="display: none;">{{ $key++ }}</div>
            @endforeach
          
            {{-- <button class="add_field_button">Add</button> --}}

          </div>

          <div class="form-group col-md-4" style="display: block;">
            <input type="submit" class="btn btn-default" value="Submit">
          </div>
          
        </form>
          

      </div>
    </div>

  </div> <!-- /container -->

@endsection

@section('javascript')

<script type="text/javascript">
  $(document).ready(function() {

    $('#input-max-presence').change(function() {
      $('.max-presence').val($(this).val());
    });

    $('#select-month').change(function() {
      $('.presence-month').val($(this).val());
    });

    $('#select-year').change(function() {
      $('.presence-year').val($(this).val());
    });

    //year function
    var currentTime = new Date()
    var year = currentTime.getFullYear();
    var tahun = year-1;

    for (i = 0; i <= 2 ; i++){
        $("#select-year").append(new Option(tahun, tahun));
        tahun++;
    }


    // // dynamic fields
    // var max_fields      = ' count($users)'; //maximum input boxes allowed
    // var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    // var add_button      = $(".add_field_button"); //Add button ID
    // var x = 1; //initial text box count

    // $(add_button).click(function(e){ //on add input button click
    //     e.preventDefault();
    //     if(x < max_fields){ //max input box allowed
    //         x++; //text box increment
    //         $(wrapper).append('<div><input class="form-control" type="text" name="ingredient_names[]"/><a href="#" class="remove_field">Supprimer</a></div>'); //add input box
    //     }
    // });

    // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    //     e.preventDefault(); 
    //     $(this).parent('div').remove(); x--;
    // })

  });
</script>

@endsection