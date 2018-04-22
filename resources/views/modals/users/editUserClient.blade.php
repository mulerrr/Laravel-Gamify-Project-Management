<div class="modal fade" id="editUser{{$userProgrammer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      <h4 class="modal-title">Edit {{$userProgrammer->name}}</h4>
	    </div>
	    <div class="modal-body">

		     <form method="post" action="{{ route('users.userUpdate',[$userProgrammer->id]) }}" enctype="multipart/form-data" data-toggle="validator">
	          {{ csrf_field() }}

	          <input type="hidden" name="_method" value="post">

	          <input type="hidden" name="id" value="{{ $userProgrammer->id }}">

	          <div class="form-group">
                <label for="role" class="col-md-3 control-label">Role</label>
                <div class="col-md-6">
                  <select class="form-control" id="role" name="role">
                    <option>Select Role</option>
                    <option value="2">Programmer</option>
                    <option value="3">Client</option>
                  </select> {{-- month picker --}}
                </div>
              </div>

              <div class="form-group">
	            <input type="submit" class="btn btn-default" value="Submit">
	          </div>
	          
	        </form>

	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>