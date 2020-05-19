@inject('model', 'App\Models\Governorate')


@extends('layouts.app')



@section('page_title')
New Governorate
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create A New Governorate</h3>
        </div>

        <div class="card-body">
           
          {!! Form::model($model, [
              'action' => 'GovernorateController@store'
          ])!!}

                <div class="form-group">
                  <label for="name">Name: </label>
                  {!! Form::text('name', null, [
                      'class' => 'form-control'
                  ])  !!}
                </div>

               <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div> 

          {!! Form::close() !!}

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection
