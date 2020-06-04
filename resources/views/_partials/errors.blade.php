@if ($errors->any())
	<div class="">
		<div class="alert alert-danger" style="margin-left: 50px; margin-right: 50px;">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
    	</div>
	</div> 
@endif