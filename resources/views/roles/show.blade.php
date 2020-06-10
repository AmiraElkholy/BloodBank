@extends('layouts.app')



@section('page_title')
Categories
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of "{{$record->name}}" category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')
              <br><br>

            @if($record)
             <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Display Name</th>
                  <th>Description</th>
                  <th>Permissions</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
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
                  </tr>  
              </table> 

              @endif

            </div>
            <!-- /.card-body -->
          </div>


          <div class="text-right back-btn">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> &nbsp;Back &nbsp;</a>
          </div>  

    </section>
    <!-- /.content -->

@endsection


@include('categories.modal')
