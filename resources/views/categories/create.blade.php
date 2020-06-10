@inject('model', 'App\Models\Category')


@extends('layouts.app')



@section('page_title')
New Category
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create A New Category</h3>
        </div>

        <div class="card-body">
           
          @include('_partials.errors')
        

           {!! Form::model($model, [
            'action' => 'CategoryController@store'
          ])!!}

          @include('categories.form')


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

