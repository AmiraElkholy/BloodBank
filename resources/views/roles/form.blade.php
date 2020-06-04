@inject('perm', 'App\Permission')

<?php $permissions = $perm->all(); ?>


	      <div class="form-group">
	        <label for="name">Name: </label>
	        {!! Form::text('name', null, [
	            'class' => 'form-control'
	        ])  !!}
	      </div>

	      <div class="form-group">
	        <label for="display_name">Display Name: </label>
	        {!! Form::text('display_name', null, [
	            'class' => 'form-control'
	        ])  !!}
	      </div>

	      <div class="form-group">
	        <label for="description">Description: </label>
	        {!! Form::text('description', null, [
	            'class' => 'form-control'
	        ])  !!}
	      </div>

	      <div class="form-group">
      		<label for="permissions_list">Allowed Permissions: </label>

      		<br>

      		<input id="selectAll" type="checkbox"> <label for="selectAll">Select All :</label>

	        <br>


	 		<div class="row">
	 				@foreach($permissions as $permission)
	        			<div class="col-sm-3">
							{!! Form::checkbox('permissions_list[]', $permission->id, $record->hasPermission($permission->name),['id' => $permission->name]) !!} 	
	        				{!! Form::label($permission->name, $permission->display_name) !!}			
	       				</div>
       				@endforeach
	 		</div>
	      </div>


         <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
         </div> 



@push('scripts')
	<script type="text/javascript">
		
		$("#selectAll").click(function() {
	    	$("input[type=checkbox]").prop("checked", $(this).prop("checked"));
		});

		$("input[type=checkbox]").click(function() {
		    if (!$(this).prop("checked")) {
		        $("#selectAll").prop("checked", false);
		    }
		});

		jackHarnerSig();

	</script>
@endpush