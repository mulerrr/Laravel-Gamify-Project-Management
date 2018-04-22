<div class="modal fade" id="editReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <h4 class="modal-title">Edit Review</h4>
	    </div>
	    <div class="modal-body">

		     <form method="post" action="{{ route('reviews.update', [$review->id]) }}" enctype="multipart/form-data" data-toggle="validator">
	          {{ csrf_field() }}

	          <input type="hidden" name="_method" value="put">

	          <input type="hidden" name="id" value="{{ $review->id }}">

				<div class="form-group">
					<label for="review">Your Review</label>
					<textarea placeholder="Enter Your Review" style="resize: vertical" id="review" name="review" rows="5" spellcheck="false" class="form-control autosize-target text-left">{{ $review->review }}</textarea>
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
	            <input type="submit" class="btn btn-default" value="Submit" style="margin-top: 20px;">
	          </div>
	          
	        </form>

	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>