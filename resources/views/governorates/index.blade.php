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
              <h3 class="card-title">List of all governorates</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')

              
              <a href="{{url(route('governorates.create'))}}">
                <button type="button" class="btn btn-success" style="float: right; font-weight:bold;">Add   <i class="fas fa-plus"></i></button>
              </a>

              <br><br>

            @if(count($governorates))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Show Details</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($governorates as $governorate)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$governorate->id}}</td>
                      <td>{{$governorate->name}}</td>
                      <td>{{$governorate->created_at}}</td>
                      <td>{{$governorate->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('governorates.edit', $governorate->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
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
                      <td>
                         <a href="{{url(route('governorates.show', $governorate->id))}}" class="btn btn-warning btn-xs"><i class="fas fa-list"></i></a>
                      </td>
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No governorates to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection
