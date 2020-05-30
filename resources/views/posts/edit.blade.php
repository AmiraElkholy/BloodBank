
@extends('layouts.app')



@section('page_title')
Edit Post
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Post</h3>
        </div>

        <div class="card-body">

          @include('_partials.errors')

          @include('flash::message')

        
          {!! Form::model($record, [
            'action' => ['PostController@update', $record->id],
            'method' => 'PUT',
            'files'  => true
          ])!!}

              @include('posts.form')


          {!! Form::close() !!}


          <div>
              <a  target="_blank" href="{{ URL::to('/') }}/images/{{$record->image}}" >
              <img src="{{ URL::to('/') }}/images/{{$record->image}}" style="max-height: 280px; max-width: 500px;">
              </a>
          </div>


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
