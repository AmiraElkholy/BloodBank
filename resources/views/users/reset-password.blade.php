
@extends('layouts.app')


@section('page_title')
Reset Password
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Hello {{auth()->user()->name}}, would you like to reset your old password?</h3>
        </div>

        <div class="card-body">
           
          @include('_partials.errors')

          @include('flash::message')
        

          {!! Form::open([
            'action' => 'UserController@updatePassword',
            'method' => 'POST'
          ])!!}

          <div class="form-group">
            <label for="old_password">Old Password: </label>
            {!! Form::password('old_password', [
                'class' => 'form-control'
            ])  !!}
          </div>


          <div class="form-group">
            <label for="new_password">New Password: </label>
            {!! Form::password('new_password', [
                'class' => 'form-control'
            ])  !!}
          </div>

          <div class="form-group">
            <label for="new_passworrd_confirmation">New Password Confirmation: </label>
            {!! Form::password('new_password_confirmation', [
                'class' => 'form-control'
            ])  !!}
          </div>



          <div class="form-group">
             <button type="submit" class="btn btn-success">Submit</button>
          </div>


          {!! Form::close() !!}


        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->


      <div class="text-right back-btn">
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> &nbsp;Back &nbsp;</a>
      </div>  

    </section>
    <!-- /.content -->

@endsection

