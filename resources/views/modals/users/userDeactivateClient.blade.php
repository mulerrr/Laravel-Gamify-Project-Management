<div class="modal fade" id="userInactive{{$userProgrammer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <h4 class="modal-title">Are you sure want to inactivate {{$userProgrammer->name}}</h4>
	    </div>
	    <div class="modal-body">

		     <form method="post" action="{{ route('users.userInactive',[$userProgrammer->id]) }}" enctype="multipart/form-data" data-toggle="validator">
	          {{ csrf_field() }}

	          <input type="hidden" name="_method" value="post">
	          <input type="hidden" name="id" value="{{ $userProgrammer->id }}">
	          <input type="hidden" name="status" value="inactive">


              <div class="form-group">
	            <input type="submit" class="btn btn-default" value="Yes">
	          </div>
	          
	        </form>

	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

	    </div>
	  </div>
	</div>
</div>