<div class="modal fade" id="deleteReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <h4 class="modal-title">Are you sure want to delete your review?</h4>
	    </div>
	    <div class="modal-body">

		     <form method="post" action="{{ route('reviews.destroy', [$review->id]) }}" enctype="multipart/form-data" data-toggle="validator">
	          {{ csrf_field() }}

	          <input type="hidden" name="_method" value="delete">
	          <input type="hidden" name="id" value="{{ $review->id }}">


              <div class="form-group">
	            <input type="submit" class="btn btn-default" value="Yes" style="margin-right: 10px;">
	            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	          </div>
	          
	        </form>

	    </div>
	  </div>
	</div>
</div>