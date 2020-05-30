@inject('model', 'App\Models\Post')


@extends('layouts.app')



@section('page_title')
New Post
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create A New Post</h3>
        </div>

        <div class="card-body">
           
          @include('_partials.errors')
        

           {!! Form::model($model, [
            'action' => 'PostController@store',
            'files'  =>  true
          ])!!}

          @include('posts.form')


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

