<div class="modal" id="change-avatar-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg-6 modal-lg-offset-3">
		<div class="modal-content">
			<form method="post" action="{{ route('users.changeAvatar',[$user->id]) }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"> &times; </span>
					</button>
					<h3 class="modal-title">Change Avatar</h3>
				</div>

				<div class="modal-body">
					<input type="hidden" id="id" name="id">
					<input type="hidden" id="name" name="name" spellcheck="false" class="form-control" value="{{ $user->name }}">

					<div class="form-group col-md-12">
						<label for="avatar" class="control-label">Avatar</label>
						<div>
						  <input type="file" id="avatar" name="avatar" class="form-control">
						  <span class="help-block with-errors"></span>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-default">Submit</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>

			</form>
		</div>
	</div>
</div> {{-- form modal --}}
