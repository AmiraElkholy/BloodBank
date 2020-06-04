@extends('layouts.app')



@section('page_title')
Contact Messages
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">List of all contact messages</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


              @include('flash::message')


            @if(count($records))
             <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Body</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Delete</th>
                  <!-- <th>Show Details</th> -->
                </tr>
                </thead>
                <tbody>
                 @foreach($records as $record)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->id}}</td>
                      <td>{{$record->name}}</td>
                      <td>{{$record->phone}}</td>
                      <td>{{$record->subject}}</td>
                      <td>{{$record->body}}</td>
                      <td>{{$record->created_at}}</td>
                      <td>{{$record->updated_at}}</td>
                      <td class="text-center">
                        {!! Form::open([
                              'action' => ['ContactMessageController@destroy', $record->id],
                              'method' => 'delete'
                          ]) !!}
                        <button type="submit" class="btn btn-danger btn-xs">
                          <i class="fas fa-trash"></i>
                        </button> 
                        {!! Form::close() !!}
                      </td>
                      <!-- <td>
                         <a href="{{url(route('contact-messages.show', $record->id))}}" class="btn btn-warning btn-xs"><i class="fas fa-list"></i></a>
                      </td> -->
                  </tr>       
                  @endforeach
              </table>
            @else
              <div class="alert alert-danger" role="alert">
                  No contact messages to display.
              </div>
            @endif 
            </div>
            <!-- /.card-body -->
          </div>

    </section>
    <!-- /.content -->

@endsection
