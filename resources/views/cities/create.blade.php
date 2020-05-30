@inject('model', 'App\Models\City')


@extends('layouts.app')



@section('page_title')
New City
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create A New City</h3>
        </div>

        <div class="card-body">
           
          @include('_partials.errors')
        

           {!! Form::model($model, [
            'action' => 'CityController@store'
          ])!!}

          @include('cities.form')


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

