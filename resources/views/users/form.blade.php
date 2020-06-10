@inject('role', 'App\Role')

<?php $roles = $role->pluck('display_name', 'id')->toArray(); ?>


  @push('styles')

   <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

 @endpush


          <div class="form-group">
            <label for="name">Name: </label>
            {!! Form::text('name', null, [
                'class' => 'form-control'
            ])  !!}
          </div>

           <div class="form-group">
            <label for="email">Email: </label>
            {!! Form::text('email', null, [
                'class' => 'form-control'
            ])  !!}
          </div>

          <div class="form-group">
            <label for="password">Password: </label>
            {!! Form::password('password', [
                'class' => 'form-control'
            ])  !!}
          </div>

          <div class="form-group">
            <label for="password_confirmation">Password Confirmation: </label>
            {!! Form::password('password_confirmation', [
                'class' => 'form-control'
            ])  !!}
          </div>


          <div class="form-group">
            <label for="roles_list">Roles: </label>
            {!! Form::select('roles_list[]', $roles, null, [
                'class' => 'form-control select2bs4',
                'multiple' => 'multiple'
            ])  !!}
          </div>


         <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
         </div> 



@push('scripts')
  <!-- Select2 -->
  <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
  
  <script type="text/javascript">

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  </script>
@endpush
