@extends('layouts.app')



@section('page_title')
Cities
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of all cities</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')

              
              <a href="{{url(route('cities.create'))}}">
                <button type="button" class="btn btn-success" style="float: right; font-weight:bold;">Add   <i class="fas fa-plus"></i></button>
              </a>

              <br><br>

            @if(count($cities))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Governorate</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Show Details</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($cities as $city)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$city->id}}</td>
                      <td>{{$city->name}}</td>
                      <td>{{$city->governorate->name}}</td>
                      <td>{{$city->created_at}}</td>
                      <td>{{$city->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('cities.edit', $city->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                       
                       <!-- Button HTML (to Trigger Modal) -->
                        <button type="button" class="btn btn-danger btn-xs" id="{{$city->id}}" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-trash"></i>
                        </button> 

                      </td>
                      <td>
                         <a href="{{url(route('cities.show', $city->id))}}" class="btn btn-warning btn-xs"><i class="fas fa-list"></i></a>
                      </td>
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No cities to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection


@include('cities.modal')
