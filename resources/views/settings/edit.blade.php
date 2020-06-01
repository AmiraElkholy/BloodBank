
@extends('layouts.app')



@section('page_title')
Edit Settings
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Settings</h3>
        </div>

        <div class="card-body">

          @include('_partials.errors')

          @include('flash::message')

        
          {!! Form::model($record, [
            'action' => ['SettingController@update', $record->id],
            'method' => 'PUT',

          ])!!}

              @include('settings.form')


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
