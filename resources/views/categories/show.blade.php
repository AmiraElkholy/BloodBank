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
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>{{$record->id}}</td>
                      <td>{{$record->name}}</td>
                      <td>{{$record->created_at}}</td>
                      <td>{{$record->updated_at}}</td>
                      <td class="text-center">
                        <a href="{{url(route('categories.edit', $record->id))}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                        
                        <!-- Button HTML (to Trigger Modal) -->
                        <button type="button" class="btn btn-danger btn-xs" id="{{$record->id}}" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-trash"></i>
                        </button> 

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
