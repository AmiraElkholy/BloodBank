@extends('layouts.app')



@section('page_title')
Roles
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of all User Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')

              
              <a href="{{url(route('roles.create'))}}">
                <button type="button" class="btn btn-success" style="float: right; font-weight:bold;">Add   <i class="fas fa-plus"></i></button>
              </a>

              <br><br>

            @if(count($records))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Display Name</th>
                  <th>Description</th>
                  <th>Permissions</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  <th>Show Details</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($records as $record)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->id}}</td>
                      <td>{{$record->name}}</td>
                      <td>{{$record->display_name}}</td>
                      <td>{{$record->description}}</td>
                      <td>
                        <ul>
                          @foreach($record->permissions as $permission)
                            <li>{{$permission->display_name}}</li>
                          @endforeach
                        </ul>
                      </td>
                      <td class="text-center">
                        <a href="{{url(route('roles.edit', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                       
                        <!-- Button HTML (to Trigger Modal) -->
                        <a href="#myModal" data-toggle="modal">
                          <button type="submit" class="btn btn-danger btn-xs">
                            <i class="fas fa-trash"></i>
                          </button> 
                        </a>

                      </td>
                      <td>
                         <a href="{{url(route('roles.show', $record->id))}}" class="btn btn-warning btn-xs"><i class="fas fa-list"></i></a>
                      </td>
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No roles to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection


@include('categories.modal')