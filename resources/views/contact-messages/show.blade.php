@extends('layouts.app')



@section('page_title')
Contact Message Details
@endsection


@section('content')

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->                 
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Details of message</h3>
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
                  <th>Phone</th>
                  <th>Subject</th>
                  <th>Body</th>
                  <th>Created_at</th>
                  <th>Updated_at</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
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
