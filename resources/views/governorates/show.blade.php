@extends('layouts.app')



@section('page_title')
Governorates
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Governorate Details of "{{$governorate->name}}" Governorate</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')
              <br><br>

            @if($governorate)
             <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>{{$governorate->id}}</td>
                      <td>{{$governorate->name}}</td>
                      <td>{{$governorate->created_at}}</td>
                      <td>{{$governorate->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('governorate.edit', $governorate->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                        {!! Form::open([
                              'action' => ['GovernorateController@destroy', $governorate->id],
                              'method' => 'delete'
                          ]) !!}
                        <button type="submit" class="btn btn-danger btn-xs">
                          <i class="fas fa-trash"></i>
                        </button> 
                        {!! Form::close() !!}

                      </td>
                  </tr>  
              </table> 

              @endif

            </div>
            <!-- /.card-body -->
          </div>


      <div class="text-right back-btn ">
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> &nbsp;Back &nbsp;</a>
      </div>   

    </section>
    <!-- /.content -->

@endsection
